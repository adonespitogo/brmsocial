
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
		.state('addCategories',{
			url: '/category/add',
			template: JST[templatePath + 'admin/categories/add'],
			controller: 'AddCategoryCtrl'
			})
		.state('editCategory',{
			url: '/category/:id/edit',
			template: JST[templatePath + 'admin/categories/category_edit'],
			controller: 'EditCategoryCtrl'
		})
]

c.controller 'CategoryListCtrl', [
	'$scope', '$location', 'Category','$alert',
	($scope, $location, Category, $alert) ->

		$scope.categories = Category.query()	

		$scope.delete = (c)->
			if confirm "Are you sure you want to delete this product?"
				c.$delete ->
					$alert
						title : "Category has been deleted successfully."
						type: 'success'
					$scope.categories = Category.query()
				
]


c.controller 'EditCategoryCtrl', [
	'$scope', '$location', '$stateParams', 'Category','$alert',
	($scope, $location, $stateParams, Category, $alert) ->

		id = $stateParams.id;

		$scope.category = Category.get({id: id});

		$scope.editSubmit = (category) ->
			
			category.$update ()->
					$alert
						title : "Category has been updated successfully."
						type: 'success'
					$location.path('/categories')
]
		
c.controller 'AddCategoryCtrl',[
	'$scope', '$location', '$stateParams', 'Category','$alert',
	($scope, $location, $stateParams, Category, $alert)->

		$scope.category = Category.get id:'create'

		$scope.submitted = false;

		$scope.addSubmit = (category)->
			category.$save ()->
					$alert
						title : "Category has been added successfully."
						type: 'success'
					$location.path '/categories'
]