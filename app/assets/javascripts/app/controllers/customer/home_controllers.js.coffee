c = angular.module "HomeControllers", [

]



c.config [

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
			template: JST[ templatePath + "customer/home"]
			controller: 'HomeCtrl'
		})
]

c.controller "HomeCtrl", [
	'$scope',
	($scope) ->
		console.log 'HomeCtrl'
]

