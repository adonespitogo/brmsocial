main = angular.module "MainController", [
	'UserServices'
]

main.controller "MainAdminCtrl", [
	'$scope', 'Users'
	($scope, Users) ->
		$scope.currentUser = Users.get(id: 'me')
]

main.controller "MainVendorCtrl", [
	'$scope', 'Users'
	($scope, Users) ->
		$scope.currentUser = Users.get(id: 'me')
]


