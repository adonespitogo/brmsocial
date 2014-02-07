
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
	'$scope', '$location', 'Category',
	($scope, $location, Category) ->

		$scope.categories = Category.query()	

		$scope.editSubmit = (id) ->
			category = $('[name="category"]').val()

			Category.update(
				{id: id},
				{category: category},
				()->
					alert('category successfully updated')
					$location.path('/categories')
				)
		$scope.delete = (id)->

			Category.delete(
				{},
				{id: id},
				()->
					alert('successfully deleted')
					$scope.categories = Category.query()
				)
]


c.controller 'EditCategoryCtrl', [
	'$scope', '$location', '$stateParams', 'Category',
	($scope, $location, $stateParams, Category) ->

		id = $stateParams.id;

		$scope.category = Category.get({id: id});

		$scope.editSubmit = (id) ->
			category = $scope.category.category

			Category.update(
				{id: id},
				{category: category},
				()->
					alert('category successfully updated')
					$location.path('/categories')
				)
]
		
c.controller 'AddCategoryCtrl',[
	'$scope', '$location', '$stateParams', 'Category',
	($scope, $location, $stateParams, Category)->

		$scope.submitted = false;

		$scope.addSubmit = ()->
			cat_name = $scope.category_name;

			Category.save({},
				{category: cat_name},
				()->
					alert('category successfully added')
					$location.path('/categories')
			)
]