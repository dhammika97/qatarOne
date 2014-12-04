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
			eventFactory.saveEvent($scope)
		}
	}
}
controllers.eventDetailsController = function($scope, $routeParams, eventFactory){
	$scope.eventDetails = eventFactory.getEvent($routeParams.id);	
	$scope.updateEvent = function(id){
		eventFactory.updateEvent($scope,id);
	}
}
