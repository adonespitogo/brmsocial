(function(){
	
	c = angular.module("ProfileControllers", [
		'angularFileUpload'
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
		'$scope', '$location', '$anchorScroll', '$upload',
		function($scope, $location, $anchorScroll, $upload){
			
			$scope.countries = [
				'USA', 'Canada', 'Australia', 'Philippines', 'Germany'
			]
			
			$scope.toggleGender = function(){
				$scope.currentUser.gender = ($scope.currentUser.gender == "0")? "1" : "0";
			}
			
			$scope.scrollTo = function(id){
				$location.hash(id);
				$anchorScroll();
			}
			
			
			$scope.onFileSelect = function($files){
				$scope.file = $files[0];
			}
			
			$scope.updateProfile = function(){
				$scope.currentUser.$update(function(res){
					
					if($scope.file){
						$upload.upload({
							url: 'users/add-image',
							data: {id: $scope.currentUser.id},
							file: $scope.file
						}).success(function(data){
							$scope.$parent.currentUser.pic = data;
							alert("Profile has been updated successfully.");
						})
					}
					else{
						alert("Profile has been updated successfully.");
					}
					
				})
			}
		}
	])
}).call(this);