c = angular.module 'CommisionControllers', [
	'CommissionServices'
]

c.config [


	'$stateProvider', '$urlRouterProvider',

	($stateProvider, $urlRouterProvider) ->
		#template base path
		templatePath = 'app/partials/'


		# // Now set up the states
		$stateProvider
		.state('commisions', {
			url: "/commisions",
			template: JST[ templatePath + "vendor/commissions"],
			controller : 'CommissionMainCtrl'
		})
]

c.controller "CommissionMainCtrl", [
	'$scope', 'Commissions'
	($scope, Commissions) ->
		$scope.myReceivableCommission = Commissions.recievableComission()
		$scope.myReceivedCommission = Commissions.recievedComission()
		$scope.unpaidCommissions = Commissions.unpaidCommissions()
		$scope.paidCommissions = Commissions.paidCommissions()
]