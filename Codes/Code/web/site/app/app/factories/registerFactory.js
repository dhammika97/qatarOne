// JavaScript Document
App.factory('registerFactory',function($resource, $location){
	var register = $resource('../../../api/register', {}, {
		save:{method: 'POST'}
    });
	
	var factory = {}
	factory.saveUser = function($scope){
		if($scope.register.user_password==$scope.register.user_confirmPassword){
			return register.save($scope.register)
			.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				//$scope.register=''
				$location.path('/packages-view')
			})	
		}else{
			alert('Password mis-matched!')
		}
	}

	return factory
})

App.factory('loginFactory',function($resource){
	var login = $resource('../../../api/login', {}, {
		query: { method: 'POST', params: {}, isArray: false }
    });
	
	var factory = {}
	
	factory.userLogin = function($scope){
		return tld = login.query({'email':$scope.login.email, 'password':$scope.login.password },
		function(data){
			if(data.error==false){
				alert(data.message)
				sessionStorage.setItem("accessKey", data.accessToken);
				sessionStorage.setItem("username", data.username)
				//$scope.username = data.username;
				//console.log($scope.username)
				//return $scope.username
				$scope.go('/classifieds')
			}else{
				alert(data.message)
			}
		});
	}
	
	factory.getUser = function(){
		return sessionStorage.getItem("username")
	}
	return factory
})