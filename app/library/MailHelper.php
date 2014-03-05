<?php
	class MailHelper {

		public static function qualifyToPremiumMessage($user)
		{
			Mail::send('emails.qualify_to_premium', array('email' => $user->email), function($message) use ($user)
			{
			    $message->to($user->email)->subject('Congratulations! You\'ve Qualified to Become a Premium User');
			    $message->from('hello@buyrealmarketing.com', 'Buy Real Marketing');

				$qualified_to_premium = new EmailSentQualifiedToPremium();
				$qualified_to_premium->user_id          = $user->id;
				$qualified_to_premium->email_content    = View::make('emails.qualify_to_premium', array('email' => $user->email));
				$qualified_to_premium->save();
				
			});
		}
		

		public static function afterPurchaseMessage($cartItems, $orderItems)
		{
			Mail::send('emails.after_purchase', array('cartItems' => $cartItems, 'orderItems'=>$orderItems), function($message) use ($cartItems)
			{   
				$recepient = Auth::user() ? Auth::user()->email : $cartItems[0]->buyer_email;
			    $message->to($recepient)->subject('We have received your Order');
			    $message->from('hello@buyrealmarketing.com', 'Buy Real Marketing');
			});
		}

		public static function helpMessage($data) {

			$msg = nl2br($data['message']);
			$name = $data['name'];
			$email = $data['email'];


			Mail::send('emails.help_message', array('msg' => $msg), function($message) use ($name, $email)
			{
			    $message->to('support@buyrealmarketing.com')->subject('Buy Real Marketing -Portal - Need Help');
			    $message->from($email, $name);
			});

			// self::sendHtmlEmail('support@buyrealmarketing.com', 'Buy Real Marketing -Portal - Need Help',	$message, $data['email']);
		}

		public static function feedbackMessage($name, $email, $feedback)
		{

			Mail::send('emails.feedback', array('feedback' => $feedback), function($message) use ($name, $email)
			{
			    $message->to('support@buyrealmarketing.com')->subject('Buy Real Marketing - Portal - Feedback');
			    $message->from($email, $name);
			});

			// self::sendHtmlEmail('support@buyrealmarketing.com', 'Buy Real Marketing - Portal - Feedback',	$feedback, Auth::user()->email);
		}

		public static function afterPurchaseFeedback($name, $email, $feedback)
		{
			Mail::send('emails.after_purchase_feedback', array('feedback' => $feedback), function($message) use ($name, $email)
			{
			    $message->to('support@buyrealmarketing.com')->subject('Buy Real Marketing - Portal - Feedback After Purchase');
			    $message->from($email, $name);
			});

			// self::sendHtmlEmail('support@buyrealmarketing.com', 'Buy Real Marketing - Portal - Feedback',	$feedback, Auth::user()->email);
		}

		public static function referralMessage($email, $sender)
		{

			Mail::send('emails.referral', array(), function($message) use ($email, $sender)
			{
			    $message->to($email)->subject('Wicked cool stuff I\'ve tried.');
			    $message->from($sender->email, $sender->getFullname());
			});
		}

		public static function forgotPasswordMessage($email, $password) {


			Mail::send('emails.forgot_password', array('email' => $email, 'password' => $password), function($message) use ($email)
			{
			    $message->to($email)->subject('Newly generated password - Buy Real Marketing');
			    $message->from('hello@buyrealmarketing.com', 'Buy Real Marketing');
			});

		}

		public static function signupMessage($name, $email, $password)
		{

			Mail::send('emails.signup', array('email' => $email, 'password' => $password, 'name' => $name), function($message) use($name, $email)
			{
			    $message->to($email, $name)->subject('Welcome!');
			    $message->from('hello@brmsocial.com', 'BRM Social');
			});
		}

	}
?>