App.factory('jobApplyFactory',function($resource){
	var applyJobMail = $resource('../../../api/applyjob/:id', {}, {
        query: { method: 'POST', params: {}, isArray: false },
	
	  });
        
        var factory = {}

        factory.applyjobAPICall = function($scope){
        	
		alert('test data will be saved in DB');

		return tld = applyJobMail.query({"advertisement_id":"30",
			"employee_fname":"jbname",
			"employee_email":"testjob@gmail.com",
			"employee_phoneno":"123456", 
			"employee_massage":"postjob",
			"mailType" :"jobapply"});
		
	//	return tld = applyJobMail.query({"advertisement_id":$scope.employee.name,"employee_fname":$scope.employee.name,"employee_email":$scope.employee.email,"employee_phoneno":$scope.employee.number, "employee_massage":$scope.employee.message, "mailType" :"jobapply"});
		tld.$promise.catch(function(e){
			
		}).then(function(){
			alert("done");
		})
	}
	
	
	return factory
})

