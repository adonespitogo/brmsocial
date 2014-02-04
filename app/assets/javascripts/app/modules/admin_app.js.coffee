

module = angular.module 'VendorApp', [
	'ui.router',
	'MainController',
	'HomeControllers',
	'ProductControllers',
]

module.config [

	'$stateProvider', '$urlRouterProvider',

	($stateProvider, $urlRouterProvider) ->
	  
		# For any unmatched url, redirect to /state1
		$urlRouterProvider.otherwise("/")
		#template base path
		templatePath = 'app/partials/'


		# // Now set up the states
		$stateProvider
		.state('home', {
			url: "/",
			template: JST[ templatePath + "admin/home"]
			controller: 'HomeCtrl'
		})
		.state('products', {
			url: "/products",
			template: JST[ templatePath + "admin/products"],
			controller : 'ProductListCtrl'
		})
		.state('user', {
			url: "/user",
			template: JST[ templatePath + "admin/user"],
			controller : 'ProductListCtrl'
		})
]
    

