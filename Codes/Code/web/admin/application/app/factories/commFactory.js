//CategoryFactry

App.factory('commentFactory',function($resource){
	var eventsList = $resource('../../../api/event/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getEvents = function(){
		
		return tld = eventsList.query();
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})	
	}

	
	
	return factory
})