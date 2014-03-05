o = angular.module 'OrderServices', [
	'ngResource'
]

o.factory 'Orders', ($resource) ->
	$resource "orders/:id", { id: '@id' }, {
		all: {method: 'GET', params: {id: 'all'}, isArray: true}
		update: { method: 'PUT', id: '@id' },
		myOrdersSoldTodayCount: { method: 'GET', params: { id: 'myordersoldtodaycount' }, isArray:false },
		mysalesToday: { method: 'GET', params: { id: 'mysalestoday' }, isArray:false },
		myOrderList: { method: 'GET', params: { id: 'my-orders' }, isArray: true }		
	}