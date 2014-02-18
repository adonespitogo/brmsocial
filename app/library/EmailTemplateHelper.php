<?php
	class EmailTempplateHelper{

		public function qualifyToPremiumEmail($email) {
			$htmlMessage = '
                        Hi '.$email.'!

                        <br /><br />Thank you for doing business with us. We am happy to inform you that you have met the requirements to qualify as one of our Premium Users. Congratulations!
                        <br /><br />As a Premium User, you have access to the following benefits:
                        <br /><br />1. Access to a tool that allows you to conduct all business for all services from one convenient location.
                        <br />2. 20% discount on all orders.
                        <br />3. Chance to be accepted as a VIP where instead of getting a 20% discount on all services, we raise the discount to 30%.
                        <br />4. Eligibility to avail of reseller-exclusive promos and more.
                        <br />5. Order prioritization.
                        <br />6. Free services every month.
                        <br /><br />To remain a Premium User, we will however require $300 worth of orders every month.
                        <br /><br />If you are interested, kindly reply to this message and we will finalize your promotion as soon as possible. We hope to hear from you soon.
                        <br /><br />Cheers!
                        <br />BRM Team
                ';
            return $htmlMessage;
		}

	}
?>