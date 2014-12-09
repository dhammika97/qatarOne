App.factory('settingFactory',function($resource){
	
	var factory = {}
	var userList = $resource('../../../api/user/:id', {}, {
		get: { method: 'GET', params: { id: '@id' } }		
    });

	factory.getUser = function(id){
		return user = userList.get({'id':id});
		user.$promise.catch(function(e){
			alert(e.data.message)
		})
	}
		
	return factory
})
