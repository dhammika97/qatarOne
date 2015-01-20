App.factory('jobApplyFactory',function($resource){
	var applyJobMail = $resource('../api/applyjob/:id', {}, {
        query: { method: 'POST', params: {}, isArray: false },
	
	  });
        
        var factory = {}
        
        factory.applyjobAPICall = function($scope,id, ngProgress){
                //console.log($scope.resume);
           	ngProgress.complete() 
		return applyJobMail.query({"advertisement_id":id,
			"employee_fname":$scope.employee.name,
			"employee_email":'test@test.test',
			"employee_phoneno":$scope.employee.telephone, 
			"employee_massage":$scope.employee.message,
                        "resume" : $scope.resume,
			"mailType" :"jobapply"})
		.$promise.catch(function(e){
			ngProgress.complete() 
			alert(e.message);
		}).then(function(e){
			ngProgress.complete() 
                        $scope.employee=''

			alert(e.message);
			
		})
	}
        
    	var applyjobsDetails = $resource('../api/applyjobsdetails', {}, {
            query: { method: 'GET', params: {}, isArray: false }
        });
    	factory.getJobApplyDetails = function(){
    		return tld = applyjobsDetails.query();
    	}
	
	return factory
})

