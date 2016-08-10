navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i) || $(function(){
$(document).pjax('a[target!=_blank]', '.container', {fragment:'.container', timeout:6000});
$(document).on('submit', 'form', function (event) {$.pjax.submit(event, '.container', {fragment:'.container', timeout:6000});}); 
$(document).on('pjax:send', function() {
$(".pjax_loading,.pjax_loading1").css("display", "block");
$(".main").removeClass("animated zoomIn"); });
$(document).on('pjax:complete', function() { 
$(".pjax_loading,.pjax_loading1").css("display", "none");
$(".main").addClass("animated zoomIn").show();
$("a[href$=jpg],a[href$=gif],a[href$=png],a[href$=jpeg],a[href$=bmp]").addClass("highslide").each(function(){this.onclick=function(){return hs.expand(this)}})
pjax_cn();side_on();});
function pjax_cn(){
	$("#slider").responsiveSlides({
		auto: true,
		pager: true,
		nav: false,
		speed: 500,
		timeout: 5000,
		namespace: "centered-btns"
	});}
function side_on(){
		$(document).ready(function() {

	window.RootCookies = {};

	window.RootCookies.SetCookie = function(a, b, c) {

		var d = new Date;

		d.setTime(d.getTime() + 864E5 * c);

		document.cookie = a + "=" + escape(b) + (null == c ? "" : ";expires=" + d.toGMTString()) + ";path=/"

	};

	$(".fullscreen").click(function() {

		$(".fullscreen i").hasClass("icon-share") ? (RootCookies.SetCookie("siyuan_sidebar", "no", 30), $(".sidebar").css("display", "none"), $(".main").css("", ""), $(".main").animate({

			width: "100%"

		}, "slow"), $(".fullscreen i").removeClass("icon-share"), $(".fullscreen i").addClass("icon-reply")) : (RootCookies.SetCookie("siyuan_sidebar", "no", -1), $(".sidebar").css("display", "block"), $(".main").css("", ""), $(".main").animate({

			width: "840px"

		}, "slow"), $(".fullscreen i").removeClass("icon-reply"), $(".fullscreen i").addClass("icon-share"))

	})

});}
});

	