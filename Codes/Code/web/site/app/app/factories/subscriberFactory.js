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
				$scope.sendSubscribConfirmaton();
				alert(value.message)
				//$scope.subscriber=''
			})
		}
	var mail = $resource('../../../api/mail/:id', {}, {
        query: { method: 'POST', params: {}, isArray: false },

    });
    factory.sendMail = function($scope){

    	mail.query({"fname":$scope.subscriber.subscription_email, "to":$scope.subscriber.subscription_email,"mailType":"subscribe"});
    } 
	
	return factory
})
