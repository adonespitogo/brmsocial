

module = angular.module 'AdminApp', [
	'ui.router',
	'MainController',
	'HomeControllers',
	'ProductControllers',
	'CategoryControllers',
	'UserControllers',
	'mgcrea.ngStrap', #angular-strapFormValidation
	'FormValidation', #custom form validations
	'EvenListeners',#custom event listeners directive
]

module.config [

	'$stateProvider', '$urlRouterProvider',

	($stateProvider, $urlRouterProvider) ->
	  
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
]

module.config [
	'$alertProvider',
	($alertProvider)->
		angular.extend($alertProvider.defaults, {
			container : '#alerts-container'
		})
]


