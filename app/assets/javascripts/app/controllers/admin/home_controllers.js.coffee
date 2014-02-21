con = angular.module "HomeControllers", [
	'ProductServices',
	'OrderServices',
	'ProductServices',
	'CategoryServices',
	'UserServices',
]


con.controller 'HomeAdminCtrl', [
	'$scope','Users','Orders','Products','Category',
	($scope,Users,Orders,Products,Category) ->
		$scope.countUsers = Users.get id: 'count'
		$scope.countOrders = Orders.get id:'count'
		$scope.countProducts = Products.get id: 'count'
		$scope.countCategories = Category.get id: 'count'
	
]
