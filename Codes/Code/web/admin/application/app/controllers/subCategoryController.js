// JavaScript Document
controllers.subCategoryController = function($scope,subCategoryFactory){
	$scope.subCategories = subCategoryFactory.getSubCategories()
	
	$scope.deleteSubCategory = function(id){
		if(id!=''){
			var r = confirm("Do you want to delete this Sub Category!");
			if (r == true) {
				subCategoryFactory.deleteSubCategory($scope,id)
			}
		}	
	}
}

controllers.addSubCategoryController = function($scope, subCategoryFactory, categoryFactry){
	$scope.parentCategory = categoryFactry.getCategory({'category_status':1})
	$scope.addSubCategory = function(){
		subCategoryFactory.saveSubCategory($scope)
	}
}


controllers.detailsSubCategoryController = function($scope, $routeParams, subCategoryFactory, categoryFactry){
	$scope.parentCategory = categoryFactry.getCategory({'category_status':1})
	$scope.subCategoryDetails = subCategoryFactory.getSubCategory($routeParams.id)
	
	$scope.updateSubCategory = function(id){
		subCategoryFactory.updateSubCategory($scope,id)	
	}
}