(function() {

	var p = angular.module('InterestServices', [
			'ngResource'
		])
		.factory('Interests', function($resource) {
			return $resource('interests/:id', { id: '@id' }, {
				myInterests: { method: 'GET', params: { id: 'my-interests' }, isArray: true }
			
			});
		});

}).call(this);