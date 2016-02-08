<?php namespace App\Laravel\Mailer;

abstract class Mailer
{
 
	public function sendTo($user, $subject, $view, $data=[])
	{
		\Mail::send($view, $data, function($message) use($user, $subject){
			$message->to($user->email, $user->fname.' '.$user->lname)->subject($subject);
		});
	}
	
	public function sendEmailTo($email, $subject, $view, $data=[])
	{
		\Mail::send($view, $data, function($message) use($email, $subject){
			$message->to($email, '')->subject($subject);
		});
	}

	public function sendQueueTo($user, $subject, $view, $data=[])
	{
		\Mail::queue($view, $data, function($message) use($user, $subject){
			$message->to($user->email, $user->name)->subject($subject);
		});
	}
}
