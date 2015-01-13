//fixedAddsFactory

App.factory('fixedAddsFactory',function($resource){
	var fixedAdds = $resource('../api/fixedAdds/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getfixedAdd = function(addType){
		
		return tld = fixedAdds.query({'fixedads_status':1,'fixedads_type':addType});
		tld.$promise.catch(function(e){
			alert(e.data.message)
			
		})
	}
	
	
	return factory
})

