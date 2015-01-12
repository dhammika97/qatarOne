
controllers.categoryController = function($scope, categoryFactry){
	$scope.categories = categoryFactry.getCategory();	
	$scope.deleteCategory = function(id){	
		if(id!=''){
			var r = confirm("Do you want to delete this Category!");
			if (r == true) {
				categoryFactry.deleteCategory($scope,id)
			}
		}
	}
	
}
controllers.addCategoryController = function($scope, categoryFactry, FileUploader){
	$scope.parentCategory = categoryFactry.getCategory({'category_parentId':0,'category_status':1})
        
        var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
        
	$scope.addCategory = function(){
            if(uploader.queue.length !=0){
                uploader.uploadAll()
                uploader.onCompleteItem = function(fileItem, response, status, headers) {
                    if(response.error==false){
					$scope.category.category_image = response.image
					categoryFactry.saveCategory($scope)
				}else{
					alert('image upload failed!')
				}
                }
               
            }else{
                alert('image should be selected')
            }
		
	}
}

controllers.categoryDetailsController = function($scope, categoryFactry, $routeParams){
	$scope.parentCategory = categoryFactry.getCategory({'category_parentId':0,'category_status':1})
	$scope.categoryDetails = categoryFactry.getCategoryDetails($routeParams.id)
	
	$scope.updateCategory = function(id){
		categoryFactry.updateCategory($scope,id)	
	}
}