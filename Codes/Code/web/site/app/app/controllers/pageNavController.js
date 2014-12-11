controllers.pageNavController = function($scope, $routeParams, pageFactory){	

	var page_id
	var params = $routeParams.pageName

		if(params == "AboutUs" ){
			page_id = 1;
		}else if(params == "SiteMap"){
			page_id = 2;		
		}else if(params == "TermsOfUse"){
			page_id = 3;		
		}else if(params == "PrivacyPolicy"){
			page_id = 4;		
		}else if(params == "FAQ"){
			page_id = 5;		
		}

		$scope.page = pageFactory.getPage(page_id)
	}
App.controller(controllers)
