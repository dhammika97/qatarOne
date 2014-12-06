var params = new Array;
controllers.resultsListingController = function($scope,resultsListingFactory, $routeParams){
	params = {'advertisement_categoryId':$routeParams.parent_id}
	
	$scope.resultList = resultsListingFactory.getResultList(params);
	$scope.setParamsCat = function(paramVal){
		var prid = $routeParams.parent_id;
		params = {'advertisement_categoryId' :$routeParams.parent_id, 'advertisement_subCategoryId' :paramVal}
		results(params)
	}
	
	
	var results = function(params){
		$scope.resultList = resultsListingFactory.getResultList(params);
	}
}
