con = angular.module "HomeControllers", [
	'ProductServices',
	'OrderServices',
	'CommissionServices'
]


con.controller 'HomeCtrl', [
	'$scope', 'Products', 'Orders', 'Commissions',
	($scope, Products, Orders, Commissions) ->
		$scope.productCount = Products.myActiveProductsCount()
		$scope.ordersSoldToday = Orders.myOrdersSoldTodayCount()
		$scope.receivablecommision = Commissions.recievableComission()
		$scope.salesToday = Orders.mysalesToday()

]