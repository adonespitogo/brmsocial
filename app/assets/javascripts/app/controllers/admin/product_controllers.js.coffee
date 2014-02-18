
c = angular.module 'ProductControllers', [
	'ui.router',
	'ProductServices',
	'CategoryServices',
	'UserServices',
]

c.config [

	'$stateProvider', '$urlRouterProvider',

	($stateProvider, $urlRouterProvider) ->
		#template base path
		templatePath = 'app/partials/'

		# // Now set up the states
		$stateProvider
		.state('products', {
			url: "/products",
			template: JST[ templatePath + "admin/products/products_list"],
			controller : 'ProductListCtrl'
		})
		.state('newProduct', {
			url: "/products/new",
			template: JST[ templatePath + "admin/products/new_product"],
			controller : 'NewProductCtrl'
		})
		.state('editProduct', {
			url: "/products/:id/edit",
			template: JST[ templatePath + "admin/products/edit_product"],
			controller : 'EditProductCtrl'
		})
]

c.controller 'ProductListCtrl', [
	'$scope', 'Products', '$alert'
	($scope, Products, $alert) ->

		$scope.products = Products.query()

		$scope.deleteProduct = (p)->
			if confirm "Are you sure you want to delete this product?"
				p.$delete ->
					$alert
						title : "Product has been deleted successfully."
						type: 'success'

					$scope.products = _.reject $scope.products, (product)-> product.id == p.id 
]

c.controller 'NewProductCtrl', [
	'$scope', 'Products', 'Category', '$alert', '$location','Users',
	($scope, Products, Category, $alert, $location, Users) ->
				
		Category.query().$promise.then (categories) -> 
				$scope.categories = categories
				Products.get({ id:"create" }).$promise.then (d)->
					$scope.product = d
					$scope.product.terms.push('hello')
					$scope.product.terms.push('world')


		$scope.vendors = Users.query id:'vendor'

		$scope.createProduct = (p)->
			console.log(p)
			p.$save ->
				console.log $scope.product
				$alert
					title : "Product has been created successfully."
					type: 'success'
				
				$location.path('/products')
]

c.controller 'EditProductCtrl', [
	'$scope', 'Products', '$stateParams', 'Category', '$alert', 'Users','$location',
	($scope, Products, $stateParams, Category, $alert, Users, $location) ->
		Category.query().$promise.then (categories) ->
				$scope.categories = categories
				$scope.product = Products.get id: $stateParams.id

		$scope.vendors = Users.query id:'vendor'

		$scope.updateProduct = (p)->
			p.$update ->
				$alert
					title : "Product has been updated successfully."
					type: 'success'
				$location.path('/products')
		
]