
var c = angular.module('HomeControllers', [
		'OrderServices',
		'ProductServices'
	]);

c.config([
	'$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {

		$urlRouterProvider.otherwise("/");

		var templatePath;

		templatePath = 'app/partials/';

		return $stateProvider.state('home', {
				url: "/",
				template: JST[templatePath + 'customer/home'],
				controller : 'HomeCtrl'
			});
	}
]);

c.controller('HomeCtrl', [

		'$scope', 'Orders', 'Products', function($scope, Orders, Products) {
			
		$scope.order = 'created_at';
		$scope.orderOptions = [
			{v: 'product.category.category', k: 'Category'},
			{v: 'product_name', k: 'Product Name'},
			{v: 'created_at', k: 'Date'},
			{v: 'price', k: 'Price'}
		];
			
			$scope.latest_purchases = Orders.myOrderList();
			$scope.featured_product = Products.featuredProduct();
		}
]);