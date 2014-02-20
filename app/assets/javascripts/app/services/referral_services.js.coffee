s = angular.module "ReferralServices", [
	'ngResource'
]

s.factory "Referrals", ($resource) ->
	$resource "referrals/:endpoint", {},{
		send : 
			method: 'POST'
			params:
				endpoint: 'send'
			isArray: false
	}