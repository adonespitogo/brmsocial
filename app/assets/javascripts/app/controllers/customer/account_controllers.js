c = angular.module("AccountControllers", [
	'UserServices',
	'SubscriptionServices'
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
	'$scope', 'Users', 'Subscriptions',
	function($scope, Users, Subscriptions){
		$scope.valueKey = [
			{v: "0", k: "No"}, {v: '1', k: 'Yes'}
		];
		
		$scope.currentUser.$promise.then(function(u){
			$scope.tmpUser = angular.copy(u);
			$scope.subscriptions = Subscriptions.get({userId : u.id});
		});
		
		$scope.tab = 0;
		
		$scope.changeTab = function(n){$scope.tab = n}
		
		$scope.updateUser = function(tmpUser){
			tmpUser.$update({id:'me'}, 
				function(){
					$scope.$parent.currentUser = angular.copy(tmpUser);
					alert("Account has been updated successfully.");
				},
				function(res){
					var errors = "";
					for (var i = res.data.length - 1; i >= 0; i--) {
						errors += res.data[i];
					};
					alert(errors);
				});
		}
		
		$scope.updateSubscriptions = function(){
			$scope.subscriptions.$update({userId: $scope.currentUser.id}, function(s){
				alert('Notification preferences has been updated successfully.');
			})
		}
	}
])
