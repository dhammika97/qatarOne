// JavaScript Document
App.directive('helloWorld', function(ngDialog) {
  return {
    restrict: 'AE',
    replace: true,
	scope:{
		videoT: '='
	},
    templateUrl: "app/directives/templates/sliderTemplate.html",
    link: function(scope, elem, attrs) {
		setTimeout(function(){
			$('.crsl-items').carousel({ autoRotate: 3000, visible: 4});
		},1000)
		
		scope.openWindow = function(id){
			ngDialog.open({ template: '<iframe id="player" type="text/html" width="640" height="480" src="http://www.youtube.com/embed/'+id+'" frameborder="0"></iframe>',
    		plain: true,
			className: 'ngdialog-theme-default' });	
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
						speed:2000
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
});
