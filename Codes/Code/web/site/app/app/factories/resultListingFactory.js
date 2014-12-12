App.factory('resultsListingFactory',function($resource){
	var resultList = $resource('../../../api/adlist/:id', {}, {
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

App.factory('resultsListingByLocation',function($resource){
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
