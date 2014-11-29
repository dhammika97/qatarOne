controllers.sliderController = function($scope, sliderFactory){	
	$scope.slider = sliderFactory.getSlider();	
	$scope.deleteSlider = function(id){	
		if(id!=''){
			var r = confirm("Do you want to delete this Image!");
			if (r == true) {
				 sliderFactory.deleteSlider($scope,id)
			}
		}
	}
	
}

controllers.sliderAddController = function($scope, sliderFactory){

	$scope.addSlider = function(){
			
		sliderFactory.saveSlider($scope)		

	}
}
controllers.sliderDetailsController = function($scope, $routeParams, sliderFactory){
	$scope.sliderDetails = sliderFactory.getSlider_edit($routeParams.id);	
	
	$scope.updateSlider= function(id){
		
		sliderFactory.updateSlider($scope,id);
	}
}
