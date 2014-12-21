// JavaScript Document
var App = angular.module('QatartOneApp',[
	'ngRoute',
	'ngResource',
	'angular.filter',
	'angularFileUpload',
	'ngSanitize',
	'uiSlider',
	'checklist-model',
	'ui.bootstrap',
	'ngProgress']) 

window.routes =
{
    "/portal/:name": {
        templateUrl: 'app/partials/home/home.html', 
        controller: 'controllers.dashController', 
        requireLogin: false
	},
/*    "/show-list/:parent_id": {
        templateUrl: 'app/partials/resultListing/resultListing.html', 
        controller: '', 
        requireLogin: false
    },*/
	"/show-list/:params": {
        templateUrl: 'app/partials/resultListing/resultListing.html', 
        controller: '', 
        requireLogin: false
    },
	"/news-detail/:id": {
        controller:'controllers.newsDetailsController',
		templateUrl:'app/partials/newsdetails/NewsDetails.html',
		requireLogin: false
    },
	"/events-details/:id": {
        controller:'controllers.eventsDetailsController',
		templateUrl:'app/partials/eventsdetails/EventsDetails.html',
		requireLogin: false
    },
	"/pages/:pageName": {
        controller:'controllers.pageNavController',
		templateUrl:'app/partials/CMS/CMSPage.html',
		requireLogin: false
    },
	"/post-ad": {
		controller:'controllers.advertismentAddController',
        templateUrl:'app/partials/postAd/postAdMain.html',
		requireLogin: true
    },
	"/review-ad/:id": {
		controller:'controllers.advertismentReviewController',
        templateUrl:'app/partials/postAd/reviewAdMain.html',
		requireLogin: true
    },
	'/login': {
		templateUrl:'app/partials/login/loginMain.html',
		requireLogin: false
	},
	'/details-view/:id': {
		templateUrl:'app/partials/detailsView/detailsView.html',
		requireLogin: false
	},
	'/packages-view': {
		templateUrl:'app/partials/packageView/packages.html',
		requireLogin: false
	},
	'/payment-details': {
		templateUrl:'app/partials/payment/paymentMain.html',
		requireLogin: false
	},
	'/settings': {
		controller:'controllers.settingController',
		templateUrl:'app/partials/settings/settingsMain.html',
		requireLogin: true
	},
	'/contact-us': {
		//controller:'controllers.settingController',
		templateUrl:'app/partials/contact/contactus.html',
		requireLogin: false
	},'/appyjobs': {
		controller:'controllers.jobApplyController',
		templateUrl:'app/partials/detailsView/applyjobs.html',
		requireLogin: false
	}
};

App.config(function($routeProvider, $httpProvider){
	$httpProvider.defaults.headers.common.Authorization = sessionStorage.getItem("accessKey");
	for(var path in window.routes) {
        $routeProvider.when(path, window.routes[path]);
    }
	$routeProvider.otherwise({
		redirectTo:'/portal/classified'
	});
	
})

.run( function($rootScope, $location, auth, $location, ngProgress) {
    // register listener to watch route changes
    $rootScope.$on( "$locationChangeStart", function(event, next, current) {
	ngProgress.start()
	for(var i in window.routes) {
		if(next.indexOf(i.split('/')[1]) != -1) {
			if(window.routes[i].requireLogin && sessionStorage.getItem("accessKey") == null) {
				if(i=='/post-ad'){
					//$rootScope.addAlert()
					alert('You should have registered account to add advertisements. If you are already registered please login')
					$location.path('/login')
				}else{
					alert("Please Login to the system to view this page!");
					//event.preventDefault();
					$location.path('/login')
				}
			}
		}
    }
	  
	  
    });
 })
/* 
 var getUser = function(){
	var ArrayCookies = document.cookie.split(';')
	for(i=0; i<ArrayCookies.length; i++){
		if(ArrayCookies[i].indexOf('accessKey')!=-1){
			return ArrayCookies[i].substr(ArrayCookies[i].indexOf('=')+1)
		}
	}
}
*/
