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

	
	var userProfile = $resource('../../../api/userProfile/:id', {}, {
		 update: { method: 'PUT', params: { id: '@id' } }
    });


	factory.saveUserSetting = function($scope,id){

		alert($scope.userSetting.user[0].user_confirmPassword);
		//ngProgress.start()

		if($scope.userSetting.user[0].user_New_password==$scope.userSetting.user[0].user_confirmPassword){			
			return userProfile.update({id:id},$scope.userSetting.user[0])
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
					//$location.path('/packages-view')
				}, 2000);
			})	
		}else{
			alert('false');
			$scope.addAlert('danger','Password mis-matched!')
			ngProgress.complete()
			$timeout(function(){
				$scope.closeAlert();
			}, 3000);
		}
	}
	return factory
})

