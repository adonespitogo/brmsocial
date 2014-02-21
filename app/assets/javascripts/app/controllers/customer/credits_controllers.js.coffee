c = angular.module("CreditControllers", [
	'ReferralServices'
])

.config([
	'$stateProvider',
	($stateProvider) ->
		tpl = 'app/partials/customer/'
		$stateProvider.state "credits",
			url: '/credits'
			template: JST[tpl+'credits']
			controller: 'CreditCtrl'
])

.controller("CreditCtrl", [
	'$scope', 'Referrals'
	($scope, Referrals) ->
		

		$scope.currentUser.$promise.then (u) ->
			$scope.currentUser = u
			$scope.totalEarned = Referrals.totalEarned user_id: u.id
			$scope.totalJoined = Referrals.totalJoined user_id: u.id
			$scope.spentCredits = Referrals.spentCredits user_id: u.id
		
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