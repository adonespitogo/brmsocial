main = angular.module "MainController", [
	'UserServices'
]

main.controller "MainCtrl", [
	'$scope', 'Users'
	($scope, Users) ->
		$scope.currentUser = Users.get(id: 'me')
]


