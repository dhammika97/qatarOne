//CategoryFactry

App.factory('eventFactory',function($resource){
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
	factory.deleteEvent = function($scope,id){
		return eventsList.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.events = eventsList.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}
	factory.saveEvent = function($scope){
		return eventsList.save($scope.eventa)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.eventa=''
			}
		)
	}

	
	
	return factory
})