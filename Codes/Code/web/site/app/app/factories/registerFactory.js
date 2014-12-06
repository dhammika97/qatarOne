// JavaScript Document
App.factory('registerFactory',function($resource){
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
				//$scope.go('/sdsd')
			})	
		}else{
			alert('Password mis-matched!')
		}
	}
	
	
	return factory
})