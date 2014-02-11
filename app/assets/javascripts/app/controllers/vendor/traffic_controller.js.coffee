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

		$scope.product = {}

		ProductTraffic.get id: $stateParams.id, (productWithTraffic)->
			
			$scope.product = productWithTraffic

			getDates = ->
				last_date = moment(new Date()).subtract('days', 30)

				dates = []

				date = moment(new Date()).endOf 'day'

				while last_date <= date
					dates.push last_date.format 'YYYY-MM-DD'
					last_date = last_date.add 'days', 1
				

				dates

			formatTrafficCreatedAt = ->
				$scope.product.traffic = _.map $scope.product.traffic, (traffic)->
												traffic.created_at_date = moment(traffic.created_at).format 'YYYY-MM-DD'
												traffic

			getMorrisData = ->
				data = []
				dates = getDates()
				formatTrafficCreatedAt()

				i = 0

				for d in dates
					datum = {}
					datum.date = moment(d).format 'MMM-D'
					datum.traffic = (_.where $scope.product.traffic, ({created_at_date : d})).length
					data[i] = datum
					i++

				console.log data
				data

			data = getMorrisData()
				

			new Morris.Line {
			    element: 'graph-line',
			    data: data,
			    xkey: 'date',
			    ykeys: ['traffic'],
			    labels: ['Visits'],
			    lineColors:['#1FB5AD'],
			    parseTime: false
			}

]