var e = angular.module('PreferencesControllers', [
		'InterestServices'
	]);

e.config([
		'$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {

			$urlRouterProvider.otherwise('/');

			var templatePath = 'app/partials/';

			$stateProvider.state('preferences', {
				url: '/preferences',
				template: JST[templatePath + 'customer/preferences'],
				controller: 'PreferencesCtrl'
			});
		}
]);

e.controller('PreferencesCtrl', [
	'$scope', 'Interests', function($scope, Interests) {

		$scope.interests = Interests.query();
		$scope.my_interests = Interests.myInterests();
		$scope.hasInterest = function(i){
			var has = _.findWhere($scope.my_interests, {id: i.id});
			console.log(has);
			return (typeof has == 'undefined') ? false : true;
		}

	}
]);