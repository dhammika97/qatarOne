
controllers.categoryController = function($scope, usersFactory){
	$scope.users = usersFactory.getUsers()
	
	$scope.test = "test";
	
	$scope.deleteUser = function(id){
		if(id!=''){
			var r = confirm("Do you want to delete this user!");
			if (r == true) {
				//$scope.users = usersFactory.deleteUser(id)
				usersFactory.deleteUser($scope,id)
			}
		}
	}
	
}
