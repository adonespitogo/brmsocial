# Name Module
#
# @abstract Description
#
o = angular.module('OrderControllers', ['ui.router','OrderServices'])

.config([
	'$stateProvider','$urlRouterProvider', 
	($stateProvider, $urlRouterProvider)->
		
		templatePath = 'app/partials/orders/'

		$stateProvider
			.state 'orders',
				url: '/orders',
				template: templatePath+"list_orders",
				controller: 'OrderCtrl'
			.state 'orders.new',
				url: '/new',
				template: templatePath+"new_order",
				controller: 'NewOrderCtrl'
			.state 'orders.edit',
				url: 'edit',
				template: templatePath+'edit_order',
				controller: 'EditOrderCtrl'

])
	# configuration handler

.controller('OrderCtrl',[
	'$scope','Orders',
	($scope, Orders)->
		$scope.orders = Orders.get 
])