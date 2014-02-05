main = angular.module "MainController", [
	'UserServices'
]

main.controller "MainAdminCtrl", [
	'$scope', 'Users'
	($scope, Users) ->
		$scope.currentUser = Users.get(id: 'me')

		$scope.alert = {
			"title": "Holy guacamole!",
			"content": "Best check yo self, you're not looking too good.",
			"type": "info"
		}
]