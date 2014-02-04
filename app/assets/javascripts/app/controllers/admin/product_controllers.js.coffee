
c = angular.module 'ProductControllers', [
	'ProductServices'
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
			controller : 'AdminProductListCtrl'
		})
]

c.controller 'AdminProductListCtrl', [
	'$scope', 'Products'
	($scope, Products) ->

		$scope.products = Products.query()
		
		
]