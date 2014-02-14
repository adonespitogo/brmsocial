c = angular.module "MainController", [

]

c.controller "MainCtrl", [
	'$scope',
	($scope) ->
		console.log 'main ctrl'
]