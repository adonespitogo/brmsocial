<?php

class ReferralController extends BaseController{
	
	public function postSend()
	{
		$emails = Input::get('emails');
		Auth::user()->sendReferrals($emails);
	}
	
	public function getTotalEarned()
	{
		$uid = Input::get('user_id');
		$user = User::find($uid);
		return Response::json(array('count' => $user->getTotalReferralEarned()));
	}
	
	public function getTotalJoined()
	{
		$user = User::find(Input::get('user_id'));
		return Response::json(array('count' => $user->getTotalReferral()));
	}
}