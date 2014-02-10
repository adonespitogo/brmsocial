t = angular.module 'TrafficServices', [
	'ngResource'
]

t.factory 'ProductTraffic', ($resource) ->
	# $resource "product/:id/traffic", { id: '@id' }, {
	# 	productTraffic: { method: 'GET', params: {  }, isArray: true }
	# }

	{
		fetch: (product_id, cb)->
			$.get("product/"+product_id+"/traffic").success (traffics) ->
				cb(traffics)
	}