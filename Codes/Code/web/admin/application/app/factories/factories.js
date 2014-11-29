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
		return tld = userList.query();
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}
	
	factory.saveUser = function($scope,user){
		return userList.save(user)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.user=''
			}
		)
	}
	
	factory.deleteUser = function($scope,id){
		//userList.delete({id:id})
		//return userList.query()
		return userList.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.users = userList.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}
	
	factory.getUser = function(id){
		return tmp = userList.get({id:id})
		tmp.$promise.catch(function(e){
			console.log(e.data.message)
			window.location.replace('#/dashboard')
		})
	}
	
	factory.updateUser = function($scope,id){
		//debugger
		tld = userList.update({id:id},$scope.userDetails.user[0])
		tld.$promise.then(function(e){
			alert(e.message)	
		}).catch(function(e){
			alert(e.message)	
		})
		//console.log($scope.userDetails.user)
	}
	
	return factory
})

//CategoryFactry

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
		return tld = userList.query();
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
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