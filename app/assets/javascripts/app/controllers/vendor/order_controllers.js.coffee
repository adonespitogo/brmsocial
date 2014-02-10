
o = angular.module "OrderControllers", [
	'OrderServices',
	'SaleServices'
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
		.state('sales', {
			url: "/sales",
			template: JST[ templatePath + 'vendor/sales' ],
			controller: 'VendorSalesListCtrl'
		})
]

o.controller 'VendorOrderListCtrl', [
	'$scope', 'Orders',
	($scope, Orders) ->		
		$scope.orders = Orders.myOrderList()
]

o.controller 'VendorSalesListCtrl', [
	'$scope', 'Sales',
	($scope, Sales) ->
		$scope.sales = Sales.query()

]