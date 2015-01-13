// JavaScript Document
App.factory('registerFactory',function($resource, $location){
	var register = $resource('../api/register', {}, {
		save:{method: 'POST'}
    });
    var sendMail = $resource('../api/mail', {}, {
		query:{method: 'POST'}
    });
	
	var factory = {}
	factory.sendRegConfirmation = function($scope){
		var key = (($scope.userId*300)/2)+1603894240973228;
		sendMail.query({"fname":$scope.register.user_firstname, "to":$scope.register.user_email,
			"url":"http://qatarone1.com/api/userActivation/"+key,"mailType":"registrationActivation"});
	}
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
				$scope.userId = value.user_id;
				//$scope.sendmail();
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
	var login = $resource('../api/login', {}, {
		query: { method: 'POST', params: {}, isArray: false }
    });
	
	var factory = {}
	 
	factory.userLogin = function($scope, ngProgress, $timeout){
		return tld = login.query({'email':$scope.login.email, 'password':$scope.login.password, 'type': '3' },
		function(data){
			if(data.error==false){
				$scope.addAlert('success',data.message)
				ngProgress.complete()
				$timeout(function(){
					sessionStorage.setItem("accessKey", data.accessToken);
					sessionStorage.setItem("username", data.username)
					//$scope.$parent.username = data.username;
					$scope.setUser(data);
					$scope.closeAlert();
					$scope.go('/portal/classified')
					//window.location.replace('#/classifieds')
					location.reload()
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