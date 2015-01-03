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


	factory.saveUserSetting = function($scope,id,ngProgress,$timeout){

		//alert($scope.userSetting.user[0].user_confirmPassword);
		//ngProgress.start()

		// if($scope.userSetting.user[0].user_New_password==$scope.userSetting.user[0].user_confirmPassword){			
			return userProfile.update({id:id},$scope.userSetting.user[0])
			.$promise.catch(function(e){	
				//console.log(e.data)			
				$scope.addAlert('danger',e.data.message)
				ngProgress.complete()
				$timeout(function(){
					$scope.closeAlert();
				}, 3000);
			}).then(
			function(value){
				//console.log(value)
				$scope.addAlert('success',value.message)
				ngProgress.complete()
				$timeout(function(){
					$scope.closeAlert();					
				}, 2000);
			})	
		//}
		// else{			
		// 	$scope.addAlert('danger','Password mis-matched!')
		// 	ngProgress.complete()
		// 	$timeout(function(){
		// 		$scope.closeAlert();
		// 	}, 3000);
		// }
	}
	

	factory.updateUserNameInfo = function($scope,id,ngProgress,$timeout){

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
				}, 2000);
			})	
	}
	
	var userProfileUpdate = $resource('../../../api/userProfileUpdate/:id', {}, {
		 update: { method: 'PUT', params: { id: '@id' } }
   });
	
	
	factory.updatePassWordInfo = function($scope,id,ngProgress,$timeout){
		
		return userProfileUpdate.update({id:id},$scope.userSetting.user[0])
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
						}, 2000);
					})	
			}


	var userforgotPSWDLink = $resource('../../../api/sendforgotPSWDLink', {}, {
		save:{method: 'POST'}
   });
	
	
	factory.verifyAndsendforgotPSWDLink = function($scope,ngProgress,$timeout){		
		
		return userforgotPSWDLink.save($scope.user.user_email)
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
			}
	
		var userForgotPasswordUpdate = $resource('../../../api/forgotPasswordUpdate/:id', {}, {
		 update: { method: 'PUT', params: { id: '@id' } }
   });
	
	
	factory.updateNewForgotpassword = function($scope,id,ngProgress,$timeout){
		console.log($scope.userforgotPWD);
		return userForgotPasswordUpdate.update({id:id},$scope.userforgotPWD)
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
						}, 2000);
					})	
			}
	
	return factory
})

App.factory('myAdsFactory',function($resource){
	var myAds = $resource('../../../api/myAdvertisments', {}, {
		get: {method: 'GET', params: {}, isArray: false}	
    });
	var factory = {}
	
	factory.getMyAds = function($scope){
		return myAds.get().$promise.catch(function(e){
			alert(e.message)	
		}).then(function(e){
			$scope.myAds(e)
		})
	}
	
	return factory
})