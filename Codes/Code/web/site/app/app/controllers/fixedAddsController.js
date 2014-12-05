controllers.afterNewsfixedAddsController = function($scope, fixedAddsFactory){

	$scope.fixedAdd = fixedAddsFactory.getfixedAdd(4);	
	
}
controllers.aftereventfixedAddsController = function($scope, fixedAddsFactory){

	$scope.fixedAdd = fixedAddsFactory.getfixedAdd(5);	
	
}
controllers.leftfixedAddsController = function($scope, fixedAddsFactory){

	$scope.fixedAdd = fixedAddsFactory.getfixedAdd(2);	
	
}
controllers.rightfixedAddsController = function($scope, fixedAddsFactory){

	$scope.fixedAdd = fixedAddsFactory.getfixedAdd(3);	
	
}
controllers.topfixedAddsController = function($scope, fixedAddsFactory){

	$scope.fixedAdd = fixedAddsFactory.getfixedAdd(1);	
	
}