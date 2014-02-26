
c = angular.module 'ProductControllers', [
	'ui.router',
	'ProductServices',
	'CategoryServices',
	'UserServices',
	'ProductTypeServices',
	'angularFileUpload',
	'ngSanitize',
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
	'$scope', 'Products', 'Category', '$alert', '$location','Users','$upload','ProductTypes',
	($scope, Products, Category, $alert, $location, Users, $upload, ProductTypes) ->
		$('textarea#wysihtml5-textarea').wysihtml5()

		Category.query().$promise.then (categories) -> 
				$scope.categories = categories
				Products.get({ id:"create" }).$promise.then (d)->
					$scope.product = d
					$scope.product.terms.push('') 


		$scope.vendors = Users.query id:'vendor'
		$scope.produc_types = ProductTypes.query()

		$scope.pics = []
		$scope.pfiles = []

		$scope.onFileSelect = ($files)->
			 file_types = new Array('image/jpeg', 'image/gif', 'image/png');
			 
			 not_allowed_files= '' 
			 error = false

			 $.each $files, (i, file)-> 
			 	if(file_types.indexOf(file.type)!=-1)
			 		$scope.pics.push(file) 
			 	else
			 		error = true
			 		not_allowed_files +=file.name+", "
			 		
			 if error 
			 	$alert
			 		type: 'danger'
			 		title : not_allowed_files+": not allowed files" 

		$scope.onPFileSelect = ($files)->
			$scope.pfiles = $files

		$scope.createProduct = (p)->
			
			p.product_image = true if $scope.pics.length> 0
			p.product_file = true if $scope.pfiles.length>0

			p.overview = $('#wysihtml5-textarea').val()
			p.$save (res)->
				$.each($scope.pics, (i,pic)->
						$scope.upload = $upload.upload(
							url: "product/add-image"
							data:
								id: res.id
							file: pic
						)
						.error (data, status)->
							uploadSuccess = false
							$alert
								title : "System encounter errors on uploading the product pictures "+data.error.message
								type: 'warning'
						.success ()->
							uploadSuccess = true
					)

				$.each($scope.pfiles, (i,file)->
						$scope.upload = $upload.upload(
							url: "product/add-file"
							data:
								id: res.id
							file: file
						)
						.error (data, status)->
							uploadSuccess = false
							$alert
								title : "System encounter errors on uploading the files "+data.error.message
								type: 'warning'
						.success ()->
							uploadSuccess = true
					)

				$alert
					title : "Product has been created successfully."
					type: 'success'
					
				$location.path('/products')	
					  
]

c.controller 'EditProductCtrl', [
	'$scope', 'Products', '$stateParams', 'Category', '$alert', 'Users','$location','$upload','ProductTypes',
	($scope, Products, $stateParams, Category, $alert, Users, $location,$upload, ProductTypes) ->
		
		Category.query().$promise.then (categories) ->
				$scope.categories = categories
				Products.get({id: $stateParams.id}).$promise.then (d)->
					$scope.product = d 

					$('#wysihtml5-textarea').val($scope.product.overview)
					$('textarea#wysihtml5-textarea').wysihtml5()
					
					$scope.product.terms.push('') 

		$scope.produc_types = ProductTypes.query()
		$scope.vendors = Users.query id:'vendor'

		$scope.pics = []
		$scope.pfiles = []
		
		$scope.onFileSelect = ($files)->
			 file_types = new Array('image/jpeg', 'image/gif', 'image/png');
			 
			 not_allowed_files= '' 
			 error = false

			 $.each $files, (i, file)-> 
			 	if(file_types.indexOf(file.type)!=-1)
			 		$scope.pics.push(file) 
			 	else
			 		error = true
			 		not_allowed_files +=file.name+", "
			 		
			 if error 
			 	$alert
			 		type: 'danger'
			 		title : not_allowed_files+": not allowed files" 

		$scope.onPFileSelect = ($files)->
			$scope.pfiles = $files
			
		$scope.updateProduct = (p)->

			p.product_image =$scope.pics.length> 0 ? true : false 
			p.product_file = $scope.pfiles.length>0 ? true : false

			p.overview = $('#wysihtml5-textarea').val()

			p.$update (res)->

				uploadSuccess = false
			
				$.each($scope.pics, (i,pic)->
						$scope.upload = $upload.upload(
							url: "product/add-image"
							data:
								id: res.id
							file: pic
						)
						.error (data, status)->
							uploadSuccess = false 
						
							$alert
								title : "System encounter errors on uploading the product picture "+data.error.message
								type: 'warning'
						.success ()->
							uploadSuccess = true
					)

				$.each($scope.pfiles, (i,file)->
						$scope.upload = $upload.upload(
							url: "product/add-file"
							data:
								id: res.id
							file: file
						)
						.error (data, status)->
							uploadSuccess = false 
						
							$alert
								title : "System encounter errors on uploading the files "+data.error.message
								type: 'warning'
						.success ()->
							uploadSuccess = true
					)

				$alert
					title : "Product has been updated successfully."
					type: 'success'
				$location.path('/products') 		

				
		
]

