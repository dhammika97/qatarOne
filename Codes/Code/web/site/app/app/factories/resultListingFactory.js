App.factory('resultsListingFactory',function($resource){
	var resultList = $resource('../../../api/adlist/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	
	var factory = {}
	
	factory.getResultList = function(params,$scope){
		return resultList.query(params).$promise
		.catch(function(e){
			$scope.validateMSG(e.data.message)
		}).then(function(e){
			//console.log(e)
			$scope.resultLists(e)
		})
	}
	
	var subCategories = $resource('../../../api/subCategory/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
    });

	factory.getSubCategories = function(params){
		return tld = subCategories.query(params);
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}
	
	var locationList = $resource('../../../api/locations/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	factory.getLocations = function(){
		return tld = locationList.query();
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}
	
	
	return factory
})

/*App.factory('resultsListingByLocation',function($resource){
	var resultList = $resource('../../../api/advertismentsByLocation/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	
	var factory = {}
	
	factory.getResultList = function(params){
		
		return tld = resultList.query(params);
		tld.$promise.catch(function(e){
			alert(e.data.message)
		})
	}
	
	
	return factory
})
*/