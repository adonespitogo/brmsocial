

module = angular.module 'AdminApp', [
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
			controller: 'HomeAdminCtrl'
		})
]
    

