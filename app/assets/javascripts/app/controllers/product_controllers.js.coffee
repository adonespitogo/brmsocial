c = angular.module 'ProductControllers', [
	'ProductServices',
	'ngGrid'
]

c.controller 'ProductListCtrl', [
	'$scope', 'Products'
	($scope, Products) ->

		$scope.products = Products.query()

		$scope.productGrid =
			data : 'products'
			pagingOptions: {
            pageSizes: [250, 500, 1000], 
            pageSize: 250,
            totalServerItems: 0,
            currentPage: 1
        }

		$scope.getTableStyle= ->

			rowHeight=30;
			headerHeight=45;
			
			height: ($scope.products.length * rowHeight + headerHeight) + "px"
		
		
]