
c = angular.module 'VendorControllers', [
	'ProductServices'
]

c.controller 'ProductListCtrl', [
	'$scope', 'Products'
	($scope, Products) ->

		$scope.products = Products.query()
        

		$scope.getTableStyle= ->

			rowHeight=30;
			headerHeight=45;
			
			height: ($scope.products.length * rowHeight + headerHeight) + "px"
		
		
]