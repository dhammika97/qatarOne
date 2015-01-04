// JavaScript Document
App.directive('newsticker', function() {
  return {
    restrict: 'AE',
    replace: true,
    template: '<div class="newsticker-jcarousellite"><ul>\
        	<li>One</li>\
			<li>One</li>\
			<li>One</li>\
			<li>One</li>\
			<li>One</li>\
			<li>One</li>\
			<li>One</li>\
        </ul></div>',
    link: function(scope, elem, attrs) {
		$(".newsticker-jcarousellite").jCarouselLite({
			vertical: true,
			hoverPause:true,
			visible: 4,
			auto:1000,
			speed:1000
		});
	}
  };
});
