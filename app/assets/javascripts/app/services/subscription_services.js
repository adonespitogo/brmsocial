(function(){
	
	var s = angular.module('SubscriptionServices', [
		'ngResource'
	])
	.factory("Subscriptions", function($resource){
		return $resource("user/subscriptions/:id", {id:'@id', userId: '@user_id'}, {
			update: {method: "PUT", params: {}, isArray: false}
		});
	});
	
}).call(this);