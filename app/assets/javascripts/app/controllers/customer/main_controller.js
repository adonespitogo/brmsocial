
var c = angular.module('MainController', [
		'UserServices'
	]);

c.controller('MainCustomerCtrl', [

		'$scope', 'Users', function($scope, Users) {

			$scope.navs = [
				{state: "home", text: "Dashboard", icon: "fa-home", active: true},
				{state: "account", text: "My Account", icon: "fa-gear", active: false},
				{state: "profile", text: "My Profile", icon: "fa-user", active: false},
				{state: "cart", text: "Purchases", icon: "fa-shopping-cart", active: false},
				{state: "email", text: "Email Preferences", icon: "fa-envelope", active: false},
				{state: "credits", text: "Earn Credits", icon: "fa-money", active: false}
			];
			
			$scope.currentUser = Users.get( { id: 'me'} );
			
		}
	]);