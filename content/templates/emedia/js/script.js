/*-------------------
*Description:        For Emlog(Emer)
*Website:            http://www.ewceo.com
*Author:             易玩稀有-尔今
*update:             2014-12-15
-------------------*/
(function($){
    $.fn.capacityFixed = function(options) {
        var opts = $.extend({},$.fn.capacityFixed.deflunt,options);
        var FixedFun = function(element) {
            var top = opts.top;
            element.css({
                "top":top
            });
            $(window).scroll(function() {

            });
            element.find(".close-ico").click(function(event){
                element.remove();
                event.preventDefault();
            })
        };
        return $(this).each(function() {
            FixedFun($(this));
        });
    };
})(jQuery);
function b(){
	h = $(window).height();
	t = $(document).scrollTop();
	if(t > h){
		$('#gotop').show();
	}else{
		$('#gotop').hide();
	}
}
$(document).ready(function(e) {
	//Topmenu
	$("#navul li:has(ul)").hover( 
	function(){ 
		$(this).find('ul').slideDown(100);
		$(this).addClass("navhome");
	},function(){
		$(this).find('ul').slideUp(100);
		$(this).removeClass("navhome");
	});
	b();
	$('#gotop').click(function(){
		$(document).scrollTop(0);	
	})
	$('#code').hover(function(){
			$(this).attr('id','code_hover');
			$('#code_img').show();
		},function(){
			$(this).attr('id','code');
			$('#code_img').hide();
	})
	
});

$(window).scroll(function(e){
	b();		
})
