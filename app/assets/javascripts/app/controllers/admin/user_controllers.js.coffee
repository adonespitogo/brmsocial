c = angular.module 'UserControllers',[
	'ui.router',

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
		.state('newUser', {
			url: '/user/new',
			template: JST[templatePath+'admin/users/user_new'],
			controller: 'NewUserCtrl'
		})

]

c.controller 'UserListCtrl', [
	'$scope','$alert', 'Users',
	($scope, $alert, Users)->

		$scope.users =  Users.query {id: 'all'}

		$scope.deleteUser = (u)->
							if confirm "Are you sure you want to delete this product?"
								u.$delete ->
									$alert
										title : "User has been deleted successfully."
										type: 'success'

									$scope.users = _.reject $scope.users, (user)-> user.id == u.id 
]

c.controller 'NewUserCtrl',[
	'$scope', '$alert', '$stateParams', 'Users',
	($scope, $alert, $stateParams, Users)->
		id = $stateParams.id
		$scope.user = Users.get {id: 'create'}

		$scope.userTypes = ['admin', 'vendor', 'customer']

		$scope.createuser = (u)->
							u.$save ->
								$alert
										title : "User has been created successfully."
										type: 'success'
								
							 
]