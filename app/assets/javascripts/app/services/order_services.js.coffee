o = angular.module 'OrderServices', [
	'ngResource'
]

o.factory 'Orders', ($resource) ->
	$resource "orders/:id", { id: '@id' }, {
		update: { method: 'PUT', id: '@id' },
		myOrdersSoldTodayCount: { method: 'GET', params: { id: 'myordersoldtodaycount' }, isArray:false }
	}