u = angular.module 'UserServices', [
	'ngResource'
]

u.factory 'Users', ($resource)->
	$resource "users/index/:id", {id: '@id'}, {
		update: {method: 'PUT', id:'@id', isArray:false}
	}