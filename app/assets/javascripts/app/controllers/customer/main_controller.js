
var c = angular.module('MainController', [
		'UserServices',
		'CategoryServices',
		'ProductServices'
	]);

c.controller('MainCustomerCtrl', [

		'$scope', 'Users', 'Category', 'Products', '$http',
		function($scope, Users, Category, Products, $http) {

			$scope.navs = [
				{state: "home", text: "Dashboard", icon: "fa-home"},
				{state: "account", text: "My Account", icon: "fa-gear"},
				{state: "profile", text: "My Profile", icon: "fa-user"},
				{state: "purchases", text: "Purchases", icon: "fa-shopping-cart"},
				{state: "preferences", text: "Email Preferences", icon: "fa-envelope"},
				{state: "credits", text: "Earn Credits", icon: "fa-money"}
			];
			
			
			$scope.currentUser = Users.get( { id: 'me'} );
			$scope.categories = Category.query();
			$scope.best_seller_products = Products.query();
			
			$scope.referFriend = function(){
				$http.post('referrals/send', {emails: [$scope.friend_email]}).success(function(){
					alert("Referral has been sent to " + $scope.friend_email + ".");
					$scope.friend_email = "";
				});
			}
		}
	]);