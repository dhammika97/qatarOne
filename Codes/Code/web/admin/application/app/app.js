// JavaScript Document
var App = angular.module('QatartOne',['ngRoute','ngResource'])

App.config(function($routeProvider, $httpProvider){
	
	$httpProvider.defaults.headers.common.Authorization = getUser();
	
	$routeProvider
	.when('/',
		{
			//controller:'controllers.dashController',
			templateUrl:'app/partials/dashboard.html'
		}
	)
	.when('/users',
		{
			controller:'controllers.userController',
			templateUrl:'app/partials/user/usersList.html'	
		}
	)
	.when('/addUser',
		{
			controller:'controllers.userAddController',
			templateUrl:'app/partials/user/addUser.html'	
		}
	)
	.when('/editUser/:id',
		{
			controller:'controllers.userDetailsController',
			templateUrl:'app/partials/user/editUser.html'	
		}
	)
	.when('/addNews',
		{
			controller:'controllers.newsController',
			templateUrl:'app/partials/addNews.html'	
		}
	)
	.when('/categories',
		{
			controller:'controllers.categoryController',
			templateUrl:'app/partials/category/categoryList.html'	
		}
	)

	.when('/addCategory',
		{
			controller:'controllers.addCategoryController',
			templateUrl:'app/partials/category/addCategory.html'	
		}
	)

	.when('/location',
		{
			controller:'controllers.locationsController',
			templateUrl:'app/partials/locations/locationList.html'	
		}
	)
	
	.when('/addLocation',
		{
			controller:'controllers.locationAddController',
			templateUrl:'app/partials/locations/addLocation.html'
		}
	)
	.when('/editLocation/:id',
		{
			controller:'controllers.locationDetailController',
			templateUrl:'app/partials/locations/editLocation.html'
		}
	)
	.when('/events',
		{
			controller:'controllers.eventController',
			templateUrl:'app/partials/events/eventList.html'	
		}
	)
	.when('/addEvents',
		{
			controller:'controllers.eventAddController',
			templateUrl:'app/partials/events/eventAdd.html'		
		}
	)
	.when('/editEvent/:id',
		{
			controller:'controllers.eventDetailsController',
			templateUrl:'app/partials/events/eventEdit.html'		
		}
	)
	.when('/suberbs',
		{
			controller:'controllers.suberbsController',
			templateUrl:'app/partials/suberbs/suberbsList.html'	
		}
	)
	.when('/pages',
		{
			controller:'controllers.pageController',
			templateUrl:'app/partials/page/pageList.html'	
		}
	)
	
	.when('/addPage',
		{
			controller:'controllers.pageAddController',
			templateUrl:'app/partials/page/addPage.html'	
		}
	)
	
	.when('/editPage/:id',
		{
			controller:'controllers.pageDetailController',
			templateUrl:'app/partials/page/editPage.html'	
		}
	)
	
	.when('/addPageContent',
		{
			controller:'controllers.pageContentAddController',
			templateUrl:'app/partials/page/addPageContent.html'
		}
	)
	
	.when('/news',
		{
			controller:'controllers.newsController',
			templateUrl:'app/partials/news/newsList.html'	
		}
	)
	.when('/editNews/:id',
		{
			controller:'controllers.newsDetailsController',
			templateUrl:'app/partials/news/newsEdit.html'	
		}
	)
	.when('/addNews',
		{
			controller:'controllers.newsAddController',
			templateUrl:'app/partials/news/newsAdd.html'	
		}
	)
	
	.when('/fixedAdvertisment',
		{
			controller:'controllers.fixedAdvertismentController',
			templateUrl:'app/partials/fixedAdvertisment/fixedAdvertismentList.html'
		}
	)
	.when('/addFixedAdvertisment',
			{
				controller:'controllers.fixedAdvertismentAddController',
				templateUrl:'app/partials/fixedAdvertisment/addFixedAdvertisment.html'
			}
	)
	.when('/editFixedAdvertisment/:id',
			{
				controller:'controllers.fixedAdvertismentDetailsController',
				templateUrl:'app/partials/fixedAdvertisment/editFixedAdvertisment.html'
			}

		)	
	.when('/slider',
			{
				controller:'controllers.sliderController',
				templateUrl:'app/partials/slider/sliderList.html'
			}

		)
	.when('/addSlider',
			{
				//controller:'controllers.fixedAdvertismentAddController',
				templateUrl:'app/partials/slider/sliderAdd.html'
			}
	)			
	
	
	.otherwise({
		redirectTo:'/'
	});
	
})

.run( function($rootScope, $location, User) {
    // register listener to watch route changes
    $rootScope.$on( "$routeChangeStart", function(event, next, current) {
      if ( $rootScope.accessToken == null ) {
          window.location.replace('../')
      }
	  //console.log(event)
	  //console.log(next)
	  //console.log(current)  
	  //console.log($rootScope.accessToken)
    });
 })
 
 var getUser = function(){
	var ArrayCookies = document.cookie.split(';')
	for(i=0; i<ArrayCookies.length; i++){
		if(ArrayCookies[i].indexOf('accessKey')!=-1){
			return ArrayCookies[i].substr(ArrayCookies[i].indexOf('=')+1)
		}
	}
}
