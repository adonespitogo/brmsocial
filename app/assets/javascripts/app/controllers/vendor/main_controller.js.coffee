main = angular.module "MainController", [
	'UserServices'
]

main.controller "MainVendorCtrl", [
	'$scope', 'Users'
	($scope, Users) ->
		$scope.currentUser = Users.get(id: 'me')

		$scope.navs = [
			{state: 'products', text: 'Products'}
			{state: 'sales', text: 'Sales'}
			{state: 'commisions', text: 'Commissions'}
		]

		$scope.copyCurrentUser = ->
			$scope.tmpUser = angular.copy $scope.currentUser

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

		$scope.activateNav = (nav) ->
			$scope.navs = _.map $scope.navs, (n)->
				if n.state == nav.state then n.active = true else n.active = false
				n


		$scope.navsOff = ->
			$scope.navs = _.map $scope.navs, (n)->
							n.active = false
							n
]

