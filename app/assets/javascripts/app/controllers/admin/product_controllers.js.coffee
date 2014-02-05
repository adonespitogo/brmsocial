
c = angular.module 'ProductControllers', [
	'ui.router',
	'ProductServices',
	'CategoryServices'
]

c.config [

	'$stateProvider', '$urlRouterProvider',

	($stateProvider, $urlRouterProvider) ->
		#template base path
		templatePath = 'app/partials/'

		# // Now set up the states
		$stateProvider
		.state('products', {
			url: "/products",
			template: JST[ templatePath + "admin/products/products_list"],
			controller : 'ProductListCtrl'
		})
		.state('editProduct', {
			url: "/products/:id",
			template: JST[ templatePath + "admin/products/edit_product"],
			controller : 'EditProductCtrl'
		})
]

c.controller 'ProductListCtrl', [
	'$scope', 'Products'
	($scope, Products) ->

		$scope.products = Products.query()
		
		
]

c.controller 'EditProductCtrl', [
	'$scope', 'Products', '$stateParams', 'Category'
	($scope, Products, $stateParams, Category) ->
		Category.query().$promise.then (categories) ->
				$scope.categories = categories
				$scope.product = Products.get id: $stateParams.id

		$scope.updateProduct = (p)->
			p.$update()
		
		
]