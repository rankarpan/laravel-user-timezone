<?php namespace App\Laravel\Mailer;

class UserBanMailer extends Mailer
{

	public function user_ban_notification($user)
	{
		$view = 'emails.user-banned-email';
		$subject = 'Notify '.$user->name.', You have been banned!';
		$data = array('user' => $user, 'subject' => $subject);
		return $this->sendQueueTo($user, $subject, $view, $data);	
	}
}