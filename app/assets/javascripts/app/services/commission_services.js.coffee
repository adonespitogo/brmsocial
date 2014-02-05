c = angular.module 'CommissionServices', [
	'ngResource'
]

c.factory 'Commissions', ($resource) ->
	$resource "commissions/:id", {id: '@id'}, {
		recievableComission: { method: 'GET', params: { id: 'my-receivable-commissions' }, isArray: false }
	}