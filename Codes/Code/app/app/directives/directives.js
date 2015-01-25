// JavaScript Document
App.directive('helloWorld', function(ngDialog, $window) {
  return {
    restrict: 'AE',
    replace: true,
	scope:{
		videoT: '='
	},
    templateUrl: "app/directives/templates/sliderTemplate.html",
    link: function(scope, elem, attrs) {
		setTimeout(function(){
			scope.onResizeFunction();
		},2000)
		
		scope.openWindow = function(id){
			ngDialog.open({ template: '<iframe id="player" type="text/html" style="max-width:100%" width="640" height="480" src="http://www.youtube.com/embed/'+id+'" frameborder="0"></iframe>',
    		plain: true,
			className: 'ngdialog-theme-default' });	
		}
		
		angular.element($window).bind('resize', function() {
			//scope.onResizeFunction();
			//scope.$apply();
		});
		
		scope.onResizeFunction = function(){
			console.log($('.crsl-items').css('display','block'))
			var width = window.innerWidth;
			if(width > 900) {
			   // desktop
			   $('.crsl-items').carousel({ autoRotate: 3000, visible: 4});
			} else if(width <= 900 && width > 480) {
			   // tablet
			   $('.crsl-items').carousel({ autoRotate: 3000, visible: 3});
			} else {
			   // phone
			   $('.crsl-items').carousel({ autoRotate: 3000, visible: 2});
			}
			// don't forget manually trigger $digest()
			//scope.$digest();
		}
		
	}
  };
}).directive('newsTicker',function($location){
	return {
		restrict: 'E',
		replace: true,
		scope:{
			newsM: '='
		},
		templateUrl: "app/directives/templates/newsTickerTemplate.html",
		link: function(scope,elem,attrs){
			scope.init = function(){
				$(elem).jCarouselLite({
						vertical: true,
						hoverPause:true,
						visible: 2,
						auto:500,
						speed:3000
				});
			}
			setTimeout(function(){
				scope.init();
			},1200)
			
			scope.go = function(url){
				$location.path(url)
			}
		}
	}
}).directive('fbLike', ['$window', function ($window) {
    return {
        restrict: 'A',
		scope:{
			shareM:'='
		},
        template: '<div class="fb-share-button" data-href="http://qatarone1.com/app{{shareM}}" data-layout="button"></div>',
        link: function (scope, element, attrs) {
            scope.$watch(function () { return !!$window.FB; },
                function (fbIsReady) {
                    if (fbIsReady) {
                        $window.FB.XFBML.parse(element.parent()[0]);
                    }
                });
        }
    };
}]);