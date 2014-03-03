c = angular.module("CreditControllers", [
	'ReferralServices',
	'facebook'					#used for referral
])

.config([
	'$stateProvider','FacebookProvider',
	($stateProvider, FacebookProvider) ->
		
		# define state
		tpl = 'app/partials/customer/'
		$stateProvider.state "credits",
			url: '/credits'
			template: JST[tpl+'credits']
			controller: 'CreditCtrl'
			
			
		# configure facebook sdk api-key
		FacebookProvider.init '641816635878156'
])

.controller("CreditCtrl", [
	'$scope', 'Referrals', 'Facebook',
	($scope, Referrals, Facebook) ->
		
		#check if facebook is loaded
		# $scope.$watch ->
		# 	return Facebook.isReady()
		# , ->
		# 	$scope.facebookReady = true
		
		$scope.referral_token = ""
		
		$scope.referViaFacebook = ->
			
				Facebook.ui({
					method: 'feed',
					name: 'Check out BRM Social, a cool new deals site for online marketers',
					link: 'http://www.brmsocial.com/signup/ref/' + $scope.referral_token.token,
					picture: 'http://brmsocial.com/images/brmsocial-icon.png',
					caption: 'Save up to 90% on popular online marketing tools and training courses. Get $10 to spend just for signing up!',
					description: ' '
				}, (res)-> )


		$scope.currentUser.$promise.then (u) ->
			$scope.currentUser = u
			$scope.referral_token = Referrals.referralToken user_id: u.id
			
			$scope.totalEarned = Referrals.totalEarned user_id: u.id
			$scope.totalJoined = Referrals.totalJoined user_id: u.id
			$scope.spentCredits = Referrals.spentCredits user_id: u.id
			$scope.friendsWhoJoined = Referrals.friendsWhoJoined user_id: u.id
		
		$scope.alerts = 
			show: false
			
		$scope.emails = []
		
		$scope.sendReferrals = ->
			if $scope.emails.length > 0
				Referrals.send emails: $scope.emails, ->
					$scope.alerts.show = true
					
					$scope.emails = _.map $scope.emails, (e) -> ''
					
			else
				alert "Please enter your friends emails."
])