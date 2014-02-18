
var c = angular.module('MainController', [
		'UserServices',
		'CategoryServices'
	]);

c.controller('MainCustomerCtrl', [

		'$scope', 'Users', 'Category', function($scope, Users, Category) {

			$scope.currentUser = Users.get( { id: 'me'} );
			$scope.categories = Category.query();
		}
	]);