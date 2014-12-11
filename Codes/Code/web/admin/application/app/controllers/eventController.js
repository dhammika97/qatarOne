controllers.eventController = function($scope, eventFactory){
	$scope.events = eventFactory.getEvents();	
	$scope.deleteEvent = function(id){	
		if(id!=''){
			var r = confirm("Do you want to delete this Event!");
			if (r == true) {
				 eventFactory.deleteEvent($scope,id)
			}
		}
	}
	
}

controllers.eventAddController = function($scope, eventFactory, FileUploader){
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	$scope.addEvent = function(){
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {	
				if(response.error==false){
					$scope.eventa.event_image = response.image
					eventFactory.saveEvent($scope)
				}else{
					alert('image upload failed!')
				}
			};
		}else{
			alert('image should be selected')
		}
	}
}
controllers.eventDetailsController = function($scope, $routeParams, eventFactory, FileUploader){
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	$scope.eventDetails = eventFactory.getEvent($routeParams.id);
	
	$scope.updateEvent = function(id){		
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {	
				if(response.error==false){
					$scope.eventDetails.event[0].event_image = response.image
					eventFactory.updateEvent($scope,id);
				}else{
					alert('image upload failed!')
				}
			};
		}else{
			eventFactory.updateEvent($scope,id);
		}
	}
}
