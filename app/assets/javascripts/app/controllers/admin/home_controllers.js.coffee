con = angular.module "HomeControllers", [
	'ProductServices',
	'OrderServices'
]


con.controller 'HomeAdminCtrl', [
	'$scope',
	($scope) ->
]

con.controller 'HomeCtrl', [
	'$scope', 'Products', 'Orders',
	($scope, Products, Orders) ->
		$scope.productCount = Products.myActiveProductsCount()
		$scope.ordersSoldToday = Orders.myOrdersSoldTodayCount()

]