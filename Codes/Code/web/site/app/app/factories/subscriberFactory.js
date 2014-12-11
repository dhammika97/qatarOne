App.factory('subscriberFactory',function($resource){
	var subscriber = $resource('../../../api/subscription/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	
	var factory = {}	
	factory.subscriber = function(){		
		return subscriber.query()
	}

	factory.saveSubscriber = function($scope){
		return subscriber.save($scope.subscriber)
			.$promise.catch(function(e){
				alert(e.data.message)
			}).then(function(value){
				alert(value.message)
				//$scope.subscriber=''
			})
		}
	
	
	return factory
})
