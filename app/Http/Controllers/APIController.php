<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as IlluminateResponse;
use Config;
use Corcel\Database;

class APIController extends Controller
{
    /**
     * @var array
     */
    protected $config;

	protected $statusCode = IlluminateResponse::HTTP_OK;

    public function getStatusCode()
    {
    	return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
    	$this->statusCode = $statusCode;
    	return $this;
    }

    public function respond($data, $header=[])
    {
        return \Response::json($data, $this->getStatusCode(), $header);
    }

    protected function responseWithPagination($articles, $data)
    {
        $data = array_merge($data, [
            'paginate' => [
                'total_count' => $articles->total(),
                'total_pages' => ceil($articles->total() / $articles->perPage()),
                'current_page' => $articles->currentPage(),
                'limit' => $articles->perPage()
            ]
        ]);

        return $this->respond($data);
    }

    public function respondNotFound($message = 'Not Found!')
    {
    	return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    protected function respondCreated($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond([
            'message' => $message
        ]);
    }

    public function respondValidationFailed($message = 'Validation Failed!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function defaultTitle()
    {
        $title = config('seotools.opengraph.defaults.title');
        $separator = config('seotools.meta.defaults.separator');

        return $separator.$title;
    }

    public function wordpress_db_connection()
    {
        $wordpressDB = Config::get('database.connections')[Config::get('database.wordpress')];
        
        $params = array(
        'database' => $wordpressDB['database'],
        'username' => $wordpressDB['username'],
        'password' => $wordpressDB['password'],
        'prefix' => 'wp_'
        );
        
        return Database::connect($params);
    }
}