controllers.resultsListingController = function($scope,resultsListingFactory, $routeParams){
	
	var params = new Array;
	params = {'categoryID':$routeParams.parent_id}
	
	$scope.resultList = resultsListingFactory.getResultList(params);

	$scope.setParams = function(paramKey,paramVal){
		//push key n value to params
		
		results(params)
	}
	var results = function(params){
		$scope.resultList = resultsListingFactory.getResultList(params);
	}
}
