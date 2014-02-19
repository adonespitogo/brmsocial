var e = angular.module('PreferencesControllers', []);

e.config([
		'$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {

			$urlRouterProvider.otherwise('/');

			var templatePath = 'app/partials/';

			$stateProvider.state('preferences', {
				url: '/preferences',
				template: JST[templatePath + 'customer/preferences'],
				conroller: 'PreferencesCtrl'
			});
		}
]);

e.controller('PreferencesCtrl', [
	'$scope', function($scope) {
		
	}
]);