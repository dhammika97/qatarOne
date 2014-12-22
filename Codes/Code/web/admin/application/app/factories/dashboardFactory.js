App.factory('dashboadrFactory', function($resource){
	var showAdvertisments = $resource('../../../api/advertismentsAdmin/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	var factory = {}

	factory.showAdds = function(){
		return tld = showAdvertisments.query();
	}
	factory.approve = function(id,$scope){
            
		return showAdvertisments.update({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.advertisments = showAdvertisments.query()
			}).catch(function(e){
				alert(e.message)
			})
	}
	factory.deny = function(id,$scope){

		return showAdvertisments.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.advertisments = showAdvertisments.query()
			}).catch(function(e){
				alert(e.message)
			})
	}

	return factory
});