controllers.eventController = function($scope, eventFactory){
	$scope.test = "test";
	$scope.events = eventFactory.getEvents();	
	//$scope.deleteCategory = function(id){	
//		if(id!=''){
//			var r = confirm("Do you want to delete this user!");
//			if (r == true) {
//				//$scope.users = usersFactory.deleteUser(id)
//				categoryFactry.deleteCategory($scope,id)
//			}
//		}
//	}
	
}