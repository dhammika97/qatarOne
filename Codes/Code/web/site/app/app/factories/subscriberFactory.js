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

	factory.saveSubscriber = function($scope,ngProgress, $timeout){		
		return subscriber.save($scope.subscriber)
			.$promise.catch(function(e){
				$scope.addAlert('danger',e.data.message)
				ngProgress.complete()
				$timeout(function(){
					$scope.closeAlert();
				}, 3000);
			}).then(function(value){
				$scope.addAlert('success',value.message)
				ngProgress.complete()
				$timeout(function(){					
					$scope.closeAlert();
					$scope.subscriber.subscription_email=''
				}, 2000);
				
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
