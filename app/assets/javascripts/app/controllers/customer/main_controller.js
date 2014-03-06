
var c = angular.module('MainController', [
		'UserServices',
		'CategoryServices',
		'ProductServices',
		'ReferralServices',
		'facebook'					//used for referral
	]);

c.config([
	'$stateProvider','FacebookProvider',
	function($stateProvider, FacebookProvider){
				
		// define state
		tpl = 'app/partials/customer/';
		$stateProvider.state(
			"credits", 
			{
				url: '/credits',
				template: JST[tpl+'credits'],
				controller: 'CreditCtrl'
			}
		);
			
			
		// configure facebook sdk api-key
		FacebookProvider.init('641816635878156');
	}
]);

c.controller('MainCustomerCtrl', [

		'$scope', 'Users', 'Category', 'Products', '$http', 'Facebook', 'Referrals',
		function($scope, Users, Category, Products, $http, Facebook, Referrals) {

			$scope.navs = [
				{state: "home", text: "Dashboard", icon: "fa-home"},
				{state: "account", text: "My Account", icon: "fa-gear"},
				{state: "profile", text: "My Profile", icon: "fa-user"},
				{state: "purchases", text: "Purchases", icon: "fa-shopping-cart"},
				{state: "preferences", text: "Email Preferences", icon: "fa-envelope"},
				{state: "credits", text: "Earn Credits", icon: "fa-money"}
			];
			
			
			$scope.currentUser = Users.get( { id: 'me'}, function(u){
				$scope.referral_token = Referrals.referralToken({user_id: u.id})
			} );
			
			$scope.categories = Category.query();
			$scope.best_seller_products = Products.query();
			
			$scope.referFriend = function(){
				$http.post('referrals/send', {emails: [$scope.friend_email]}).success(function(){
					alert("Referral has been sent to " + $scope.friend_email + ".");
					$scope.friend_email = "";
				});
			}
			
			
		
			$scope.referViaFacebook = function(){
				
					Facebook.ui({
						method: 'feed',
						name: 'Check out BRM Social, a cool new deals site for online marketers',
						link: $scope.referral_token.referral_url,
						picture: 'http://brmsocial.com/images/brmsocial-icon.png',
						caption: 'Save up to 90% on popular online marketing tools and training courses. Get $10 to spend just for signing up!',
						description: ' '
					}, function(){} );
			}
			
		}
	]);