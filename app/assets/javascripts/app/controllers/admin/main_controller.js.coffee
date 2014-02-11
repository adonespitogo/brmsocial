main = angular.module "MainController", [
	'UserServices'
]

main.controller "MainAdminCtrl", [
	'$scope', 'Users','$state',
	($scope, Users, $state) ->

		$scope.state = $state;

		$scope.navs = [
					   {state:'products', label: 'Products'},
					   {state: 'categories' ,label: 'Categories'},
					   {state: 'users', label:'Users'}	
					  ]
						

		$scope.currentUser = Users.get(id: 'me')

		$scope.alert = {
			"title": "Holy guacamole!",
			"content": "Best check yo self, you're not looking too good.",
			"type": "info"
		}
]