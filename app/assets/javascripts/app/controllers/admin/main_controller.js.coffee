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
					   {state: 'users', label:'Users'},
					   # {state: 'orders', label: 'Orders'}
					  ]
						

		$scope.currentUser = Users.get(id: 'me')

		$scope.copyCurrentUser = ()->
			$scope.tmpUser = angular.copy $scope.currentUser

		$scope.alert = {
			"title": "Holy guacamole!",
			"content": "Best check yo self, you're not looking too good.",
			"type": "info"
		}

		$scope.updateCurrentUser = ->
			$scope.tmpUser.$update({id:'me'},
				(user)->
					$scope.currentUser = angular.copy $scope.tmpUser
					alert 'Account has been updated successfully.'
					$("#account-settings").modal 'hide'
				, 
				(res)->
					errors = ""
					for e in res.data
						errors += e
						
					alert errors
				)	
]