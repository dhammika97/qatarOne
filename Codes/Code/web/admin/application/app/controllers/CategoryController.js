
controllers.categoryController = function($scope, categoryFactry){
	$scope.test="safds";
	$scope.categories = categoryFactry.getCategory();	
	$scope.deleteCategory = function(id){	
		if(id!=''){
			var r = confirm("Do you want to delete this user!");
			if (r == true) {
				//$scope.users = usersFactory.deleteUser(id)
				categoryFactry.deleteCategory($scope,id)
			}
		}
	}
	
}
