var p = angular.module('PurchasesControllers', [

	'OrderServices'

	]);

p.config([
		'$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {

			$urlRouterProvider.otherwise('/');

			var templatePath = 'app/partials/';

			return $stateProvider.state('purchases', {
				url: '/purchases',
				template: JST[templatePath + 'customer/purchases'],
				controller: 'PurchaseCtrl'
			});

		}
]);

p.controller('PurchaseCtrl', [
	'$scope', 'Orders', function($scope, Orders) {
		$scope.purchases = Orders.myOrderList();
	}
]);