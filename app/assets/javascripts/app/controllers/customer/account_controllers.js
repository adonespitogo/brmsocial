c = angular.module("AccountControllers", [
	'UserServices'		
])

.config([
	'$stateProvider',
	function($stateProvider){
		
		var tpl = "app/partials/customer/"
		
		$stateProvider.state("account", {
			url: "/account",
			template: JST[tpl + "account"],
			controller: 'AccountCtrl'
		})
	}	
])

.controller("AccountCtrl", [
	'$scope', 'Users',
	function($scope, Users){
		$scope.currentUser.$promise.then(function(u){
			$scope.tmpUser = angular.copy(u);
		});
	}
])
