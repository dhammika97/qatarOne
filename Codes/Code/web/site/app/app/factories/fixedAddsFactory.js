//fixedAddsFactory

App.factory('fixedAddsFactory',function($resource){
	var fixedAdds = $resource('../../../api/fixedAds/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getfixedAdd = function(params){
		
		return tld = fixedAdds.query({'fixedads_status':1});
		tld.$promise.catch(function(e){
			alert(e.data.message)
			
		})
	}
	
	
	return factory
})

