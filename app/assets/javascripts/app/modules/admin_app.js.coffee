

module = angular.module 'AdminApp', [
	'ui.router',
	'MainController',
	'HomeControllers',
	'ProductControllers',
	'CategoryControllers',
	'OrderControllers',
	'UserControllers',
	'mgcrea.ngStrap', #angular-strapFormValidation
	'FormValidation', #custom form validations
	'EvenListeners',#custom event listeners directive
]

module.config [

	'$stateProvider', '$urlRouterProvider','$locationProvider',

	($stateProvider, $urlRouterProvider, $locationProvider) ->
	  
		# For any unmatched url, redirect to /state1
		$urlRouterProvider.otherwise("/admin")
		#template base path
		templatePath = 'app/partials/'


		# // Now set up the states
		$stateProvider
		.state('admin', {
			url: "/admin",
			template: JST[ templatePath + "admin/home"]
			controller: 'HomeAdminCtrl'
		})

		$locationProvider.html5Mode false
]

module.config [
	'$alertProvider',
	($alertProvider)->
		angular.extend($alertProvider.defaults, {
			container : '#alerts-container'
		})
]


