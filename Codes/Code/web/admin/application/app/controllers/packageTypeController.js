controllers.packageTypeController = function($scope, packageTypeFactory){	
	$scope.packageTypes = packageTypeFactory.getPackageTypes()

	$scope.deletePackageType = function(id){
		if(id!=''){
			var r = confirm("Do you want to delete this Package Type!");
			if (r == true) {
				packageTypeFactory.deletePackageType($scope,id)
			}
		}
	}

}

controllers.pacakgeTypeAddController = function($scope, packageTypeFactory){
	$scope.addPacakgeType = function(){
		packageTypeFactory.savePacakgeType($scope)//userList.save(user)
	}
}

controllers.pacakgeTypeDetailsController = function($scope, $routeParams, packageTypeFactory){
	$scope.packageTypesDetail = packageTypeFactory.gePackageType($routeParams.id)
		
	$scope.updatePackageType = function(id){
		packageTypeFactory.updatePackageType($scope,id)
	}
}