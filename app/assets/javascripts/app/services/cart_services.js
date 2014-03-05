cart = angular.module('CartServices',['ngResource'])

.factory('Cart', function($resource){
	return $resource("cart/:id", {
      id: '@id'
    }, {
      update: {
        method: 'PUT',
        id: '@id'
      }
    });
 });