
c = angular.module 'ProductControllers', [
	'ProductServices'
]

c.controller 'ProductListCtrl', [
	'$scope', 'Products'
	($scope, Products) ->

		$scope.products = Products.query()
		
		
]