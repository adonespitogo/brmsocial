<?php

class ReferralController extends BaseController{
	
	public function postSend()
	{
		$emails = Input::get('emails');
		foreach ($emails as $e) {
			MailHelper::referralMessage($e, Auth::user());
		}
	}
}