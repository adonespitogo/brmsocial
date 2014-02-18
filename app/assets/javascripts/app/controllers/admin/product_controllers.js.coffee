
c = angular.module 'ProductControllers', [
	'ui.router',
	'ProductServices',
	'CategoryServices',
	'UserServices',
	'angularFileUpload',
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
	'$scope', 'Products', 'Category', '$alert', '$location','Users','$upload',
	($scope, Products, Category, $alert, $location, Users, $upload) ->
				
		Category.query().$promise.then (categories) -> 
				$scope.categories = categories
				Products.get({ id:"create" }).$promise.then (d)->
					$scope.product = d
					$scope.product.terms.push('') 


		$scope.vendors = Users.query id:'vendor'

		$scope.files = []

		$scope.onFileSelect = ($files)->
			 $scope.files = $files	 	
		
		$scope.createProduct = (p)->
			
			p.product_image = true if $scope.files.length> 0

			p.$save (res)->
				$.each($scope.files, (i,file)->
						$scope.upload = $upload.upload(
							url: "product/add-image"
							data:
								id: res.id
							file: file
						).progress((evt) ->
							console.log "percent: " + parseInt(100.0 * evt.loaded / evt.total)
							return
						).success((data, status, headers, config) ->
							console.log data
							return
						)
					)

				$alert
					title : "Product has been created successfully."
					type: 'success'
					
					$location.path('/products')
					  
]

c.controller 'EditProductCtrl', [
	'$scope', 'Products', '$stateParams', 'Category', '$alert', 'Users','$location','$upload',
	($scope, Products, $stateParams, Category, $alert, Users, $location,$upload) ->
		Category.query().$promise.then (categories) ->
				$scope.categories = categories
				Products.get({id: $stateParams.id}).$promise.then (d)->
					$scope.product = d
					$scope.product.terms.push('') 

		$scope.vendors = Users.query id:'vendor'

		$scope.files = []

		$scope.onFileSelect = ($files)->
			 $scope.files = $files	

		$scope.updateProduct = (p)->

			p.product_image = if $scope.files.length> 0 then true else false  
			 
			p.$update (res)->
				$.each($scope.files, (i,file)->
					$scope.upload = $upload.upload(
						url: "product/add-image"
						data:
							id: res.id
						file: file
					).progress((evt) ->
						console.log "percent: " + parseInt(100.0 * evt.loaded / evt.total)
						return
					).success((data, status, headers, config) ->
						console.log data
						return
					)
				)

				$alert
					title : "Product has been updated successfully."
					type: 'success'

				$location.path('/products')
		
]

