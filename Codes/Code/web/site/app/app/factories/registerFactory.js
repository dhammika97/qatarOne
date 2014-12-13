// JavaScript Document
App.factory('registerFactory',function($resource, $location){
	var register = $resource('../../../api/register', {}, {
		save:{method: 'POST'}
    });
	
	var factory = {}
	factory.saveUser = function($scope,ngProgress, $timeout){
		ngProgress.start()
		if($scope.register.user_password==$scope.register.user_confirmPassword){
			return register.save($scope.register)
			.$promise.catch(function(e){
				$scope.addAlert('danger',e.data.message)
				ngProgress.complete()
				$timeout(function(){
					$scope.closeAlert();
				}, 3000);
			}).then(
			function(value){
				$scope.addAlert('success',value.message)
				ngProgress.complete()
				$timeout(function(){
					$scope.closeAlert();
					$location.path('/packages-view')
				}, 2000);
			})	
		}else{
			$scope.addAlert('danger','Password mis-matched!')
			ngProgress.complete()
			$timeout(function(){
				$scope.closeAlert();
			}, 3000);
		}
	}

	return factory
})

App.factory('loginFactory',function($resource){
	var login = $resource('../../../api/login', {}, {
		query: { method: 'POST', params: {}, isArray: false }
    });
	
	var factory = {}
	
	factory.userLogin = function($scope, ngProgress, $timeout){
		return tld = login.query({'email':$scope.login.email, 'password':$scope.login.password },
		function(data){
			if(data.error==false){
				$scope.addAlert('success',data.message)
				ngProgress.complete()
				$timeout(function(){
					sessionStorage.setItem("accessKey", data.accessToken);
					sessionStorage.setItem("username", data.username)
					//$scope.$parent.username = data.username;
					$scope.setUser(data.username);
					$scope.closeAlert();
					$scope.go('/classifieds')
				}, 2000);
				
				
			}else{
				$scope.addAlert('danger',data.message)
				ngProgress.complete()
				$timeout(function(){
					$scope.closeAlert();
				}, 3000);
			}
		});
	}
	
	factory.getUser = function(){
		return sessionStorage.getItem("username")
	}
	return factory
})