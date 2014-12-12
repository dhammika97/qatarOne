var params = new Array;
controllers.resultsListingController = function($scope,resultsListingFactory, $routeParams){
	
	var params = {}
	//params['category'] = $routeParams.parent_id
	var param = $routeParams.params.split('-in-')
	var cat = param[0].split('-on-')
	var loc = param[1].split('-at-')
	
	params['category'] = cat[0]
	params['subcategory'] = cat[1]
	params['location'] = loc[0]
	params['suburb'] = loc[1]
	params['searchby'] = ''
	params['sortby'] = ''
	params['pricerangegreaterthan'] = ''
	params['pricerangelessthan'] = ''
	$scope.resultList = resultsListingFactory.getResultList(params);
	
	$scope.setParams = function(key,value){
		//alert(key)
		switch(key) {
			case 'category':
				params['category'] = value
				break;
			case 'subcategory':
				params['subcategory'] = value
				break;
			case 'location':
				params['location'] = value
				break;
			case 'suburb':
				params['suburb'] = value
				break;
			case 'searchby':
				params['searchby'] = value
				break;
			case 'sortby':
				params['sortby'] = value
				break;
			case 'pricerangegreaterthan':
				params['pricerangegreaterthan'] = value
				break;
			case 'pricerangelessthan':
				params['pricerangelessthan'] = value
				break;
			default:
				params['category'] = $routeParams.parent_id
		}
		//console.log(params['suburb'])
		var str = '/show-list/'
		if(params['category']!='undefined')
		str += params['category']
		
		if(params['subcategory']!='undefined')
		str += '-on-'+params['subcategory']
		
		str += '-in-'
		
		if(params['location']!='undefined')
		str += params['location']
		
		if(params['suburb']!='undefined')
		str += '-at-'+params['suburb']
		
		//console.log(str)
		//console.log(params)
		$scope.go(str)
		//var url = '/show-list'
		//for(i in params)
		//url += '/'+params[i]
		//console.log(url)
		//$scope.resultList = resultsListingFactory.getResultList(params);
	}
	$scope.isList = true
	
	$scope.changeView = function(param){
		if(param=='grid'){
			$scope.isList = true
		}else{
			$scope.isList = false
		}
	}
}
