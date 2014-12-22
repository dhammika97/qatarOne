App.factory('jobApplyFactory',function($resource){
	var applyJobMail = $resource('../../../api/applyjob/:id', {}, {
        query: { method: 'POST', params: {}, isArray: false },
	
	  });
        
        var factory = {}
        
        factory.applyjobAPICall = function($scope,id){

		return applyJobMail.query({"advertisement_id":id,
			"employee_fname":$scope.employee.name,
			"employee_email":'test@test.test',
			"employee_phoneno":$scope.employee.telephone, 
			"employee_massage":$scope.employee.message,
			"mailType" :"jobapply"})
		.$promise.catch(function(e){
			
		}).then(function(e){
			alert(e.message);
			$scope.employee=''
		})
	}
        
    	var applyjobsDetails = $resource('../../../api/applyjobsdetails', {}, {
            query: { method: 'GET', params: {}, isArray: false }
        });
    	factory.getJobApplyDetails = function(){
    		return tld = applyjobsDetails.query();
    	}
	
	return factory
})

