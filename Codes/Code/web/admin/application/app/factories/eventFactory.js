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
	factory.getEvent = function(id){
		//alert(id);
		return tmp = eventsList.get({id:id})
		tmp.$promise.catch(function(e){
			console.log(e.data.message)
			window.location.replace('#/dashboard')
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
	factory.updateEvent = function($scope,id){
		
		tld = eventsList.update({id:id},$scope.eventDetails.event[0])
		tld.$promise.then(function(e){
			alert(e.message)	
		}).catch(function(e){
			alert(e.message)	
		})
		//console.log($scope.userDetails.user)
	}

	
	
	return factory
})