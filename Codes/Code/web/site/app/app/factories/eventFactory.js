//eventFactry

App.factory('eventFactory',function($resource){
	var eventList = $resource('../../../api/event/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getEvents = function(params){
		
		return tld = eventList.query({'event_status':1});
		tld.$promise.catch(function(e){
			alert(e.data.message)
			
		})
	}
	factory.getEventsDetails = function(params){

		return tld = eventList.query({'evenet_id':params});
		tld.$promise.catch(function(e){
			alert(e.data.message)
			
		})
	}
	
	
	return factory
})
