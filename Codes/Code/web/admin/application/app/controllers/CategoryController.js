
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
controllers.addCategoryController = function($scope, categoryFactry){
	$scope.parentCategory = categoryFactry.getCategory({'category_parentId':0,'category_status':1})
	
	$scope.addCategory = function(){
		categoryFactry.saveCategory($scope)
	}
}

controllers.categoryDetailsController = function($scope, categoryFactry, $routeParams){
	$scope.parentCategory = categoryFactry.getCategory({'category_parentId':0,'category_status':1})
	$scope.categoryDetails = categoryFactry.getCategoryDetails($routeParams.id)
	
	$scope.updateCategory = function(id){
		categoryFactry.updateCategory($scope,id)	
	}
}