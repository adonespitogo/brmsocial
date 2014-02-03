
c = angular.module 'ProductControllers', [
	'ProductServices',
	'ngGrid'
]

c.controller 'ProductListCtrl', [
	'$scope', 'Products'
	($scope, Products) ->

		$scope.products = Products.myProducts()

		$scope.productGrid =
			data : 'products'
			columnDefs : [
				{field: 'product_name', displayName: 'Product Name', sortable: true},
				{field: 'product_name', displayName: 'Product Name', sortable: true}
			]
        

		$scope.getTableStyle= ->

			rowHeight=30;
			headerHeight=45;
			
			height: ($scope.products.length * rowHeight + headerHeight) + "px"
		
		
]