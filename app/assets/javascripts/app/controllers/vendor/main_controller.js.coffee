main = angular.module "MainController", [
	'UserServices'
]

main.controller "MainVendorCtrl", [
	'$scope', 'Users'
	($scope, Users) ->
		$scope.currentUser = Users.get(id: 'me')

		$scope.navs = [
			# {state: 'vendor', text: 'Dashboard', active: true}
			{state: 'products', text: 'Products', active: false}
			{state: 'sales', text: 'Sales', active: false}
			{state: 'orders', text: 'Purchases', active: false}
			{state: 'commisions', text: 'Commissions', active: false}
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

