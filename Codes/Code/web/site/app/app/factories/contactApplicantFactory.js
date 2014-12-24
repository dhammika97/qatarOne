App.factory('contactApplicantFactory',function($resource){
	var contactApplicantMail = $resource('../../../api/contactApplicantEmail/:id', {}, {
        query: { method: 'POST', params: {}, isArray: false },
    });

	
	var factory = {}
	factory.notifyApplicant2 = function($scope,id){
	//	alert(id);
		return tld = contactApplicantMail.query({"epmluserid": id,"name":$scope.employee.name,"telephone":$scope.employee.telephone,"customerMessage":$scope.employee.message, "mailType" :"contactApplicant"});
		tld.$promise.catch(function(e){
			
		}).then(function(){
			alert("done");
		})
	}
		
	return factory
})

