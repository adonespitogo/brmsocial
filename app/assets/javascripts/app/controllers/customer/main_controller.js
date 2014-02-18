
var c = angular.module('MainController', [
		'UserServices'
	]);

c.controller('MainCustomerCtrl', [

		'$scope', 'Users', function($scope, Users) {

			$scope.currentUser = Users.get( { id: 'me'} );
		}
	]);