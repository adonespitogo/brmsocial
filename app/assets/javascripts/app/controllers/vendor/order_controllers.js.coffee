
o = angular.module "OrderControllers", [
	'OrderServices'
]

o.config [
	'$stateProvider', '$urlRouterProvider',
	($stateProvider, $urlRouterProvider) ->
		templatePath = 'app/partials/'

		$stateProvider
		.state('orders', {
			url: "/orders",
			template: JST[ templatePath + 'vendor/orders' ],
			controller: 'VendorOrderListCtrl'
		})
]

o.controller 'VendorOrderListCtrl', [
	'$scope', 'Orders',
	($scope, Orders) ->
		console.log 'aw'
		$scope.orders = Orders.myOrderList()
]