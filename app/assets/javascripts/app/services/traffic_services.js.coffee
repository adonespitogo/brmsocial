t = angular.module 'TrafficServices', [
	'ngResource'
]

t.factory 'ProductTraffic', ($resource) ->
	$resource "product/:id/traffic", {id: '@id'}, {
		productTraffic: { method: 'GET', params: {}, isArray: false }
	}