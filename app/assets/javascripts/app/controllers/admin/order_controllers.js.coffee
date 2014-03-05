# Name Module
#
# @abstract Description
#
o = angular.module('OrderControllers', ['ui.router','OrderServices', 'CommissionServices'])

.config([
	'$stateProvider','$urlRouterProvider', 
	($stateProvider, $urlRouterProvider)->
		
		templatePath = 'app/partials/admin/orders/'

		$stateProvider
			.state 'orders',
				url: '/orders',
				template: JST[templatePath+"list_orders"],
				controller: 'OrderCtrl'

])
	# configuration handler

.controller('OrderCtrl',[
	'$scope','Orders', 'Commissions'
	($scope, Orders, Commissions)->
		$scope.orders = Orders.all()
		
		$scope.markCommissionPaid = (order) ->
			Commissions.markPaid id: order.commission.id, (commission)->
				order.commission = commission
])