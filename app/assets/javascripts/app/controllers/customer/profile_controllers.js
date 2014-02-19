(function(){
	
	c = angular.module("ProfileControllers", [
		
	])
	.config([
		'$stateProvider',
		function($stateProvider) {

			var templatePath;

			templatePath = 'app/partials/customer/';

			$stateProvider.state('profile', {
				url: "/profile",
				template: JST[templatePath + 'profile'],
				controller : 'ProfileCtrl'
			})
		}
	])
	.controller('ProfileCtrl', [
		'$scope', '$location', '$anchorScroll',
		function($scope, $location, $anchorScroll){
			$scope.scrollTo = function(id){
				$location.hash(id);
				$anchorScroll();
			}
		}
	])
}).call(this);