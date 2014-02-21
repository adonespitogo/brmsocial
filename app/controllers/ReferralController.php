<?php

class ReferralController extends BaseController{
	
	public function postSend()
	{
		$emails = Input::get('emails');

		foreach ($emails as $e) {
			MailHelper::referralMessage($e, Auth::user());
		}

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
	
	public function getSpentCredits()
	{
		$user = User::find(Input::get('user_id'));
		return Response::json(array('count' => $user->getSpentCredits() ));
	}
	
	public function getFriendsWhoJoined()
	{
		$user = User::find(Input::get('user_id'));
		return $user->getFriendsWhoJoined();
	}
}