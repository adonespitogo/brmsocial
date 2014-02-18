
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
			$scope.latest_purchases = Orders.myOrderList();
			$scope.featured_product = Products.featuredProduct();
		}
]);