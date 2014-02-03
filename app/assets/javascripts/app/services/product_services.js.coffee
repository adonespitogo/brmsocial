p = angular.module 'ProductServices', [
	'ngResource'
]

p.factory 'Products', ($resource) ->
	$resource "products/:id", {id: '@id'}, {
		update: {method: 'PUT', id:'@id'}
		myProducts : {method: 'GET', params: {id: 'my-products'}, isArray: true}
	}

			