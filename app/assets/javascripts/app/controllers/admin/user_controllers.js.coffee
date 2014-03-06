c = angular.module 'UserControllers',[
	'ui.router',
	'FormValidation'
]

c.config [
	'$stateProvider', '$urlRouterProvider',
	($stateProvider, $urlRouterProvider)->
		#template base path
		templatePath = 'app/partials/'

		#now setup the states
		$stateProvider
		.state('users',{
			url: '/users',
			template: JST[templatePath+'admin/users/user_list'],
			controller: 'UserListCtrl'
		})
		.state('editUser',{
			url: '/user/:id/edit',
			template: JST[templatePath+'admin/users/user_edit'],
			controller: 'EditUserCtrl'
		})
		.state('newUser', {
			url: '/user/new',
			template: JST[templatePath+'admin/users/user_new'],
			controller: 'NewUserCtrl'
		})

]

c.controller 'UserListCtrl', [
	'$scope','$alert', 'Users',
	($scope, $alert, Users)->

		Users.query id: 'all', (users)->
			$scope.users = _.reject users, (user)-> user.id == $scope.currentUser.id
		

		$scope.deleteUser = (u)->
							if confirm "Are you sure you want to delete this user?"
								u.$delete ->
									$scope.users = Users.query id: 'all'
									$alert
										title : "User has been deleted successfully."
										type: 'success'
		
		$scope.updateCurrentUser = (tmpUser)->
			alert 'fox is here'
]

c.controller 'NewUserCtrl',[
	'$scope', '$alert', '$stateParams', 'Users','$location',
	($scope, $alert, $stateParams, Users, $location)->
		id = $stateParams.id
		$scope.user = Users.get {id: 'create'}

		$scope.countries = [
			'USA', 'Canada', 'Australia', 'UK', 'Germany'
		]
		$scope.genders = [
			{k:'Male', v: '1'}
			{k:'Female', v: '0'}
		]
		$scope.userTypes = ['admin', 'vendor', 'customer']

		$scope.createuser = (u)->
							u.$save ->
								$alert
									title : "User has been added successfully."
									type: 'success'	
								$location.path('/users')
]
c.controller 'EditUserCtrl',[
	'$scope', '$alert', '$stateParams', 'Users', '$location',
	($scope, $alert, $stateParams, Users, $location)->
		id = $stateParams.id
		$scope.user = Users.get {id: id}, (data)->
							$scope.oldEmail = data.email 								 
		
		$scope.userTypes = ['admin', 'vendor', 'customer']

		$scope.updateUser = (u)->
							u.$update ->
								$alert
									title : "User has been updated successfully."
									type: 'success'		
							$location.path '/users'
							$scope.users =  Users.query id: 'all'
]				