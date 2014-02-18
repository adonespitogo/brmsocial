
var c = angular.module('HomeControllers', [
		'OrderServices'
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

		'$scope', 'Orders', function($scope, Orders) {
			$scope.latest_purchases = Orders.myOrderList();
		}
]);