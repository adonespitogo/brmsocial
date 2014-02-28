
var c = angular.module('MainController', [
		'UserServices',
		'CategoryServices',
		'ProductServices'
	]);

c.controller('MainCustomerCtrl', [

		'$scope', 'Users', 'Category', 'Products', '$http',
		function($scope, Users, Category, Products, $http) {

			$scope.navs = [
				{state: "home", text: "Dashboard", icon: "fa-home", active: false},
				{state: "account", text: "My Account", icon: "fa-gear", active: false},
				{state: "profile", text: "My Profile", icon: "fa-user", active: false},
				{state: "purchases", text: "Purchases", icon: "fa-shopping-cart", active: false},
				{state: "preferences", text: "Email Preferences", icon: "fa-envelope", active: false},
				{state: "credits", text: "Earn Credits", icon: "fa-money", active: false}
			];
			
			

			$scope.activateNav = function(nav) {
				$scope.navs = _.map( $scope.navs, function(n) {
					n.active = n.state == nav.state; 
					return n;
				});	
			}
			
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