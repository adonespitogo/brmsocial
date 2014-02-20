c = angular.module("CreditControllers", [])

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
	'$scope',
	($scope) ->
		console.log 'credits'
])