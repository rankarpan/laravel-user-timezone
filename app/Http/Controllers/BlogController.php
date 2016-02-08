<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Jobs\SendReminderEmail;

use App\Article;
use App\InterventionImage;
use App\ExpiryUrl;
use Carbon\Carbon;
use UrlSigner;
use URL;
use SEO;
use Corcel\Post;
use Anam\PhantomMagick\Converter;
use PDF;
//use Search;
use NumberFormatter;

use App\Events\UserWasBanned;

use App\Contracts\Search;
use GeoIP;
use DateTime;
use DateTimeZone;
use Input;

class BlogController extends APIController {

    public function getBlog()
    {
        $timezone = Carbon::now('Europe/London');
        //$this->wordpress_db_connection();

        //$posts = Post::published()->get();
        //$post = Post::taxonomy('category', 'wordpress')->get();

        //dd($posts->toArray());

        $limit = \Input::get('limit') ?: 7;

        $articles = Article::with('user')->paginate($limit);

        $default = $this->defaultTitle();

        $url = ['1', '2', '3'];

        SEO::setTitle('Blog');
        SEO::setDescription('Blog description');

        SEO::opengraph()->setTitle('Blog'.$default);
        SEO::opengraph()->setUrl(URL::to('blog'));
        SEO::opengraph()->addProperty('type', 'articles');
        SEO::opengraph()->addProperty('locale', 'pt-br');
        SEO::opengraph()->addProperty('locale:alternate', ['pt-pt', 'en-us']);
        SEO::opengraph()->addImage(URL::to('blog').'/39');
        SEO::opengraph()->addImage(URL::to('blog').'/15');
        SEO::opengraph()->addImage(URL::to('blog').'/24');
        SEO::opengraph()->addImage(['url' => 'http://image.url.com/cover.jpg', 'size' => 300]);

        SEO::twitter()->setTitle('Blog'.$default);
        SEO::twitter()->setSite('@rankarpan39');
        SEO::twitter()->addImage('1730');
        SEO::twitter()->setImages($url);

        return view('articles', compact('articles', 'timezone'));
    }

    public function generateExpiryUrl()
    {
        return view('pages.expiry-url');
    }

    public function postExpiryUrl()
    {
        $input = \Input::all();

        $expiry_url = new ExpiryUrl;
        $expiry_url->title = $input['title'];
        $expiry_url->duration = $input['duration'];
        $expiry_url->save();

        $real_url = URL::to($expiry_url->url);

        $duration = $expiry_url->duration;

        //$data = Carbon::createFromFormat('Y-m-d', '1975-05-21')->addDays('3');
        $sign = UrlSigner::sign($real_url, Carbon::now()->addMinutes($duration));

        $query = parse_url($sign, PHP_URL_QUERY);

        parse_str($query, $params);

        $expiry_url->expires = $params['expires'];

        $expiry_url->signature = $params['signature'];

        $expiry_url->save();
    }

    public function getExpiryUrl($url)
    {
        //$main_url = $url.'?'.$_SERVER['QUERY_STRING'];
        $expiry_url = ExpiryUrl::where('url',$url)->first();

        $real_url = URL::to($expiry_url->url);

        $params = '?expires='.$expiry_url->expires.'&signature='.$expiry_url->signature;

        $url = $real_url.$params;

		$validate = UrlSigner::validate($url);
		//dd($validate);
		return view('laravel-4_2', compact('validate'));
	}

    public function getInterventionImage()
    {
        return view('pages.intervention-image');
    }

    /*
    public function postInterventionImage()
    {
        $input = \Input::all();

        $sha_image = $input['sha_image'];
        $image = $input['image'];

        $sha_image = sha1_file($sha_image);
        $image = sha1_file($image);

        if ($sha_image == $image)
        {
            return "The File is OK.";
        }
        else
        {
            return "The file has been changed.";
        }
    }
    */

    public function postInterventionImage()
    {
        $input = \Input::all();

        $intervention = New InterventionImage;

        $intervention->title = $input['title'];

        if(\Input::file())
        {
            $file = \Input::file('image');
            $dest = env('UPLOAD_IMAGE');
            $cache = env('CACHE_UPLOAD_IMAGE');
            $type = $file->getClientOriginalExtension();
            $filename  = time().'.'.$file->getClientOriginalExtension();
            $imagedata = \Image::make(file_get_contents($file))->fit(600,300)->insert('watermark.png')->greyscale()->save($cache.$filename);

            /*
            $imagedata = \Image::cache(function($image) use ($file, $cache, $filename) {
                $image->make(file_get_contents($file))->fit(200,200)->greyscale()->save($cache.$filename);
            }, 10, true);
            */

            $base64 ='data:image/' . $type . ';base64,' .base64_encode($imagedata);
            $intervention->base64_images = $base64;
            $file->move($dest, $filename);
            $intervention->images = $dest.$filename;
            $intervention->save();
        }
        $intervention->save();
        return \Response::make($imagedata, 200, array('Content-Type' => 'image/jpeg'));
        //return redirect('/');
    }

    public function getAutoMailContent()
    {
        return view('pages.mail-content');
    }

    public function postAutoMailContent()
    {
        $input = \Input::all();

        /*
        if(\Input::file())
        {
            $file = \Input::file('attachment');
            $dest = env('UPLOAD_ATTACHMENT');
            $type = $file->getClientOriginalExtension();
            $filename  = $input['filename'].'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move($dest, $filename);
            $attachment = URL::to($dest.$filename);
        }
        */

        //dd($attachment);

        $updated_at = '2015-12-18 15:30:15';
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $updated_at)->addDays('3');
        $time = Carbon::now()->diffInSeconds($date);

        \Mail::send('emails.demo-mail', ['user' => $input], function ($message) use ($input) {
            $message->to($input['email'], $input['name'])->subject($input['subject'])->attach('http://git.laravel-5.com/attachment/Attachment PDF.pdf', ['as' => $input['filename']]);
        });

        \Mail::later($time, 'emails.demo-mail', ['user' => $input], function ($message) use ($input) {
            $message->to($input['email'], $input['name'])->subject($input['subject']);
        });

        return redirect('auto-mail')->with('status', 'Thank You For Completed Mail Demo Integration');
    }

    public function getIDCard()
    {
        return view('pages.id-card');
    }

    public function getDownloadPDF()
    {
        $limit = \Input::get('limit') ?: 7;

        $articles = Article::with('user')->paginate($limit);

        $pdf = PDF::loadView('articles', compact('articles'));
        //$pdf = PDF::loadHTML('<h1>Test</h1>');
        //dd($pdf);
        return $pdf->download('download.pdf');
    }

    public function sendReminderEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        //dd($user->toArray());

        $job = (new SendReminderEmail($user))->onQueue('emails');

        $this->dispatch($job);
    }

    public function getAlgoliaSearch(Search $search, Request $request)
    {
        $results = $search->index('xxxxxxxxxx')->get($request->name);
        return $results;

        $number2word = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        return ucwords($number2word->format(5650)).' Only';

        $user = User::find($id=3);

        //\Event::fire(new UserWasBanned($user));
        event(new UserWasBanned($user));

        return $user->toArray();
    }

    public function postData()
    {
        $data = new Article;
        //$data = Article::find(145);
        $data->title = \Input::get('title');
        $data->save();
        return $data;
    }

    public function getTimeZone()
    {
        return view('timezone', compact('timezone', 'session', 'timezone_utc'));
    }

    public function postTimeZone()
    {
        //$datetime = '2016-02-07 23:39:00';
        $datetime = Input::get('datetime');

        $userTimezone = $this->getUserTimeZone();

        $session = Carbon::createFromFormat('Y-m-d H:i:s', $this->convertTimeToUTCzone($datetime))->format('Y-m-d H:i:s');
        $timezone_utc = Carbon::createFromFormat('Y-m-d H:i:s', $this->convertTimeToUTCzone($datetime))->format('D j F Y H:i:s e');
        $timezone = Carbon::createFromFormat('Y-m-d H:i:s', $this->convertTimeToUSERzone($session), $userTimezone)->format('D j F Y H:i:s e');

        $content = view('sections.timezone-ajax', compact('timezone', 'timezone_utc'))->render();

        return json_encode(array(
            'status'    =>  'success',
            'data'      =>  $datetime,
            'updateExtra' => true, 
            'content' => $content,
            'affectedElement' => '.panel-footer'
        ));
    }

    //Current User timezone to UTC timezone
    private function convertTimeToUTCzone($datetime, $format = 'Y-m-d H:i:s')
    {
        $userTimezone = $this->getUserTimeZone();

        if($datetime && isset($userTimezone))
        {
            $new_datetime = new DateTime($datetime, new DateTimeZone($userTimezone));
            $new_datetime->setTimeZone(new DateTimeZone('UTC'));
            return $new_datetime->format($format);
        }
        else
        {
            return abort(503);
        }
    }

    //UTC timezone to Current user timezone
    private function convertTimeToUSERzone($datetime, $format = 'Y-m-d H:i:s')
    {
        $userTimezone = $this->getUserTimeZone();

        if($datetime && isset($userTimezone))
        {
            $new_datetime = new DateTime($datetime, new DateTimeZone('UTC'));
            $new_datetime->setTimeZone(new DateTimeZone($userTimezone));
            return $new_datetime->format($format);
        }
        else
        {
            return abort(503);
        }
    }

    private function getUserTimeZone()
    {
        $ip = $this->getClientIP();

        $location = GeoIP::getLocation($ip);

        $userTimezone = $location['timezone'];

        return $userTimezone;
    }

    // Get Client IP Address
    private function getClientIP()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if (isset($_SERVER['HTTPX_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if (isset($_SERVER['HTTPX_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }
        else if (isset($_SERVER['HTTPFORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        else if (isset($_SERVER['HTTPFORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }
        else {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipaddress;
    }

}