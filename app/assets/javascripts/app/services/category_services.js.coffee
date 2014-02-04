p = angular.module 'CategoryServices', [
	'ngResource'
]

p.factory 'Category', ($resource) ->
	$resource "categories/:id", {id: '@id'}, {
		update: {method: 'PUT', id:'@id'} 
	}