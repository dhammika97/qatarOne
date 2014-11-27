// JavaScript Document
App.factory('usersFactory',function($resource){
	var userList = $resource('../../../api/user/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	var factory = {}
	factory.getUsers = function(){
		return userList.query()
	}
	
	factory.saveUser = function(user){
		return userList.save(user)
		.$promise.then(
			function(value){
				if(value.error!=true){
					window.location="#/users"
				}else{
					alert(value.message)	
				}
			}
		)
	}
	
	factory.deleteUser = function($scope,id){
		//userList.delete({id:id})
		//return userList.query()
		return userList.delete({id:id})
		.$promise.then(
			function(e){
				if(e.error!=true){
					$scope.users = userList.query()
				}else{
					alert('error')
				}
			}
		)
	}
	
	factory.getUser = function(id){
		return userList.get({id:id})
	}
	
	factory.updateUser = function($scope,id){
		return userList.update({id:id}, $scope.userDetails.user)
		//console.log(user)
	}
	
	return factory
})

App.factory('User',function($rootScope){
	var getUser = function(){
		var ArrayCookies = document.cookie.split(';')
		for(i=0; i<ArrayCookies.length; i++){
			if(ArrayCookies[i].indexOf('accessKey')!=-1){
				return ArrayCookies[i].substr(ArrayCookies[i].indexOf('=')+1)
			}
		}
	}
	
	$rootScope.accessToken = getUser()
})