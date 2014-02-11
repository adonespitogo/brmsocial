traffic = angular.module "TrafficControllers", [
	'TrafficServices',
	'ui.router'
]

traffic.config [

	'$stateProvider', '$urlRouterProvider',

	($stateProvider, $urlRouterProvider) ->
		#template base path
		templatePath = 'app/partials/'


		# // Now set up the states
		$stateProvider
		.state('traffic', {
			url: "/product/:id/traffic",
			template: JST[ templatePath + "vendor/producttraffic"],
			controller: 'VendorTrafficCtrl'
		})
]

traffic.controller 'VendorTrafficCtrl', [
	'$scope', 'ProductTraffic', '$stateParams'
	($scope, ProductTraffic, $stateParams) ->

		ProductTraffic.fetch $stateParams.id, (traffics)->
			
			$scope.traffics = traffics.traffic
			$scope.product_name = traffics.product_name.name

			# console.log($scope.traffics)
			# console.log($scope.traffics.length)

			if not $scope.traffics instanceof Array
				$scope.traffics.length = [ {"elapsed": 0, "value": 0} ]

		# day_data = [
		#     {"elapsed": "I", "value": 34},
		#     {"elapsed": "II", "value": 24},
		#     {"elapsed": "III", "value": 3},
		#     {"elapsed": "IV", "value": 12},
		#     {"elapsed": "V", "value": 13},
		#     {"elapsed": "VI", "value": 22},
		#     {"elapsed": "VII", "value": 5},
		#     {"elapsed": "VIII", "value": 26},
		#     {"elapsed": "IX", "value": 12},
		#     {"elapsed": "X", "value": 19}
		# ]

		# #console.log day_data

			new Morris.Line {
			    element: 'graph-line',
			    data: $scope.traffics,
			    xkey: 'elapsed',
			    ykeys: ['value'],
			    labels: ['Visits'],
			    lineColors:['#1FB5AD'],
			    parseTime: false
			}

]