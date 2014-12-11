App.factory('settingFactory',function($resource){
	
	var factory = {}
	var userDetail = $resource('../../../api/GetUserDetail', {}, {
			get: {  method: 'GET', params: {}, isArray: false  }	
    });

	factory.getUser = function(){
		return user = userDetail.get();
		user.$promise.catch(function(e){
			alert(e.data.message)
		})
	}
	return factory
})

