c = angular.module 'CommissionServices', [
	'ngResource'
]

c.factory 'Commissions', ($resource) ->
	$resource "commissions/:id", {id: '@id'}, {
		recievableComission: { method: 'GET', params: { id: 'my-receivable-commissions' }, isArray: false }
		recievedComission: { method: 'GET', params: { id: 'my-received-commissions' }, isArray: false }
		unpaidCommissions: { method: 'GET', params: { id: 'my-unpaid-commissions' }, isArray: true }
		paidCommissions: { method: 'GET', params: { id: 'my-paid-commissions' }, isArray: true }
		markPaid: {method: 'PUT', params:{}, isArray: false}
	}