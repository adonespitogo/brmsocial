cart = angular.module('Cart',['CartServices', function(){

}] )

.controller('cartCtrl', ['$scope','Cart', '$http', function ($scope, Cart, $http) {
	$scope.cartItems = Cart.query({id: 'items'}); 

 $scope.$watch('cartItems', function(data){
        $scope.totalPrice = 0;
        $scope.numItem = 0; 
       $.each(data, function(i, datum){
            $scope.totalPrice += datum.product.discounted_price*1;
            $scope.numItem +=1*1;
       });
  }, true);

 	$scope.remove = function(item){
 		Cart.delete({id: item.id},{}, function(){
 			$scope.cartItems = Cart.query({id: 'items'});
 		});
 		
 	}

 	if($('[name="email"]').length>0){
	 	email = $('[name="email"]').val();
	 	$scope.hasValidEmail = emailChecker(email);
 	}else
 		$scope.hasValidEmail = true;

 $scope.saveEmail = function(email){ 
	 $scope.hasValidEmail = emailChecker(email);

	 if(!$scope.hasValidEmail)
	 	return false;

  	 baseUrl = $('base').attr('href');
  	 $http.post(baseUrl+'/cart/update-buyer-email', {email: email})
  	 .success(function(data){
  	 	$('[name="email"]').css({border: '1px solid green'});
  	 });

}
}]);


function emailChecker(email){
	var EMAIL_REGEXP = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;

  if(email==''){
  	$('[name="email"]').css({border: '1px solid red'});
  	alert('Please don\'t forget your email!');
  	return false;
  }
  else if (!EMAIL_REGEXP.test(email)) { 
  	alert('Please input your valid email');
  	$('[name="email"]').css({border: '1px solid red'});
  	return false;
  	 }

  	 return true;
}