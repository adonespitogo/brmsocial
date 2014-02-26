p = angular.module 'ProductTypeServices', [
	'ngResource'
]

p.factory 'ProductTypes', ($resource) ->
	$resource "product-types/:id", {id: '@id'}, {
		update: {method: 'PUT', id:'@id'}, 
	}

