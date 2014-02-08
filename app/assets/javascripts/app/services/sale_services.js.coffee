s = angular.module 'SaleServices', ['ngResource']

s.factory 'Sales', ($resource) ->
	$resource "sales/:id", {
		
	}