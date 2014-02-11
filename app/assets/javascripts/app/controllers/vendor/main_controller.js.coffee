main = angular.module "MainController", [
	'UserServices'
]

main.controller "MainVendorCtrl", [
	'$scope', 'Users'
	($scope, Users) ->
		$scope.currentUser = Users.get(id: 'me')

		$scope.navs = [
			# {state: 'vendor', text: 'Dashboard', active: true}
			{state: 'products', text: 'Products', active: true}
			{state: 'sales', text: 'Sales', active: false}
			{state: 'traffic', text: 'Traffic', active: false}
			# {state: 'orders', text: 'Orders', active: false}
		]

		$scope.activateNav = (nav) ->
			$scope.navs = _.map $scope.navs, (n)->
				if n.state == nav.state then n.active = true else n.active = false
				n
]


