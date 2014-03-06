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
		$scope.order = 'created_at';
		$scope.orderOptions = [
			{v: 'product.category.category', k: 'Category'},
			{v: 'product_name', k: 'Product Name'},
			{v: 'created_at', k: 'Date'},
			{v: 'price', k: 'Price'}
		]
		$scope.purchases = Orders.myOrderList();
	}
]);