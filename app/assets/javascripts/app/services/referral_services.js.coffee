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
			
		totalEarned:
			method: 'GET'
			params:
				endpoint: 'total-earned'
			isArray: false
			
		totalJoined:
			method: 'GET'
			params:
				endpoint: 'total-joined'
			isArray: false
			
		spentCredits:
			method: 'GET'
			params:
				endpoint: 'spent-credits'
			isArray: false
				
		friendsWhoJoined:
			method: 'GET'
			params:
				endpoint: 'friends-who-joined'
			isArray: true
	}