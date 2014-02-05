p = angular.module 'ProductServices', [
	'ngResource'
]

p.factory 'Products', ($resource) ->
	$resource "products/:id", {id: '@id'}, {
		update: {method: 'PUT', id:'@id'},
		myProducts : {method: 'GET', params: {id: 'my-products'}, isArray: true},
		myActiveProducts : {method: 'GET', params: {id: 'my-active-products'}, isArray: true},
		myActiveProductsCount : {method: 'GET', params: {id: 'my-active-products-count'}, isArray: false}
	}