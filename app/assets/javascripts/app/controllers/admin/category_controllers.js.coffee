
c = angular.module 'CategoryControllers', [
	'ui.router',
	'CategoryServices'
]

c.config [

	'$stateProvider', '$urlRouterProvider',

	($stateProvider, $urlRouterProvider) ->
	  
		# For any unmatched url, redirect to /
		$urlRouterProvider.otherwise("/")
		#template base path
		templatePath = 'app/partials/'

		# // Now set up the states
		$stateProvider
		.state('categories',{
			url: "/categories",
			template: JST[templatePath + 'admin/categories/category_list'],
			controller: 'CategoryListCtrl'
		})
		.state('categories.edit',{
			url: '/:id',
			template: JST[templatePath + 'admin/categories/category_edit']
		})
]

c.controller 'CategoryListCtrl', [
	'$scope', '$location', 'Category',
	($scope, $location, Category) ->

		$scope.categories = Category.query()	

		$scope.editSubmit = (id) ->
			category = $('[name="category"]').val()

			Category.update({},{},
				()->
					alert('category successfully updated')
					$location.path('/categories')
				)
		
]


		