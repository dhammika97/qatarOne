

controllers.packageTypeController = function($scope, packageTypeFactory){
	alert('a');
	$scope.packageTypes = packageTypeFactory.getPackageTypes()

	// $scope.deleteFixedAdvertisment = function(id){
	// 	if(id!=''){
	// 		var r = confirm("Do you want to delete this Fixed Advertisment!");
	// 		if (r == true) {
	// 			//$scope.users = usersFactory.deleteUser(id)
	// 			fixedAdvertismentFactory.deleteFixedAdvertisment($scope,id)
	// 		}
	// 	}
	// }

}

// controllers.fixedAdvertismentAddController = function($scope, packageTypeFactory){
// 	$scope.addfixedAdvertisment = function(){
// 		fixedAdvertismentFactory.savefixedAdvertisment($scope)//userList.save(user)
// 	}
//}
controllers.pacakgeTypeDetailsController = function($scope, $routeParams, packageTypeFactory){
	$scope.packageTypesDetail = packageTypeFactory.gePackageType($routeParams.id)
	console.log($scope.packageTypesDetail);
	
	
	$scope.updatePackageType = function(id){
		packageTypeFactory.updatePackageType($scope,id)
	}
}
