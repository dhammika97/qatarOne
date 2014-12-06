App.factory('advertismentFactory',function($resource){
	var addList = $resource('../../../api/advertisment/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } }
           });
	var factory = {}
	factory.getAdd = function(id){
		return tld = addList.get({'id':id});
		tld.$promise.catch(function(e){
			alert(e.data.message)
		})
	}
	return factory
})

