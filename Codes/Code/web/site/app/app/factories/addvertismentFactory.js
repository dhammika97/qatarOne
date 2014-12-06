App.factory('advertismentFactory',function($resource){
	var addList = $resource('../../../api/categoryWithCount/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } }
           });
	var factory = {}
	factory.getAdd = function(params){
		return tld = addList.query();
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}
	return factory
})

