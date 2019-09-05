// js

/* ===================================================================

 * TOPへ戻る

=================================================================== */

var scrolltotop={
	//startline: Integer. Number of pixels from top of doc scrollbar is scrolled before showing control
	//scrollto: Keyword (Integer, or "Scroll_to_Element_ID"). How far to scroll document up when control is clicked on (0=top).
	setting: {startline:100, scrollto: 0, scrollduration:800, fadeduration:[500, 100]},
	controlHTML: '<span class="icon_pagetop"></span>', //HTML for control, which is auto wrapped in DIV w/ ID="topcontrol"
	controlattrs: {offsetx:15, offsety:10}, //offset of control relative to right/ bottom of window corner
	anchorkeyword: '#top', //Enter href value of HTML anchors on the page that should also act as "Scroll Up" links

	state: {isvisible:false, shouldvisible:false},

	scrollup:function(){
		if (!this.cssfixedsupport) //if control is positioned using JavaScript
			this.$control.css({opacity:0}) //hide control immediately after clicking it
		var dest=isNaN(this.setting.scrollto)? this.setting.scrollto : parseInt(this.setting.scrollto)
		if (typeof dest=="string" && jQuery('#'+dest).length==1) //check element set by string exists
			dest=jQuery('#'+dest).offset().top
		else
			dest=0
		this.$body.animate({scrollTop: dest}, this.setting.scrollduration);
	},

	keepfixed:function(){
		var $window=jQuery(window);
		var controlx=$window.scrollLeft() + $window.width() - this.$control.width() - this.controlattrs.offsetx
		var controly=$window.scrollTop() + $window.height() - this.$control.height() - this.controlattrs.offsety
		this.$control.css({left:controlx+'px', top:controly+'px'})
	},

	togglecontrol:function(){
		var scrolltop=jQuery(window).scrollTop()
		if (!this.cssfixedsupport)
			this.keepfixed()
		this.state.shouldvisible=(scrolltop>=this.setting.startline)? true : false
		if (this.state.shouldvisible && !this.state.isvisible){
			this.$control.stop().animate({opacity:1}, this.setting.fadeduration[0])
			this.state.isvisible=true
		}
		else if (this.state.shouldvisible==false && this.state.isvisible){
			this.$control.stop().animate({opacity:0}, this.setting.fadeduration[1])
			this.state.isvisible=false
		}
	},
	
	init:function(){
		jQuery(document).ready(function($){
			var mainobj=scrolltotop
			var iebrws=document.all
			mainobj.cssfixedsupport=!iebrws || iebrws && document.compatMode=="CSS1Compat" && window.XMLHttpRequest //not IE or IE7+ browsers in standards mode
			mainobj.$body=(window.opera)? (document.compatMode=="CSS1Compat"? $('html') : $('body')) : $('html,body')
			mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+'</div>')
				.css({position:mainobj.cssfixedsupport? 'fixed' : 'absolute', bottom:mainobj.controlattrs.offsety, right:mainobj.controlattrs.offsetx, opacity:0, cursor:'pointer', zIndex:9999})
				.attr({title:'ページ上部へ'})
				.click(function(){mainobj.scrollup(); return false})
				.appendTo('body')
			if (document.all && !window.XMLHttpRequest && mainobj.$control.text()!='') //loose check for IE6 and below, plus whether control contains any text
				mainobj.$control.css({width:mainobj.$control.width()}) //IE6- seems to require an explicit width on a DIV containing text
			mainobj.togglecontrol()
			$('a[href="' + mainobj.anchorkeyword +'"]').click(function(){
				mainobj.scrollup()
				return false
			})
			$(window).bind('scroll resize', function(e){
				mainobj.togglecontrol()
			})
		})
	}
}

scrolltotop.init()


/* ニュース */
/*(function($) {
$(function() {
	function headline() {
		setTimeout(function() {
			headline();
			$("#news li").not(':first').css('display', 'none');
			$("#news li:first").fadeOut('normal', function() {
				$(this).next().fadeIn('normal');
				$(this).clone().appendTo("#news ul");
				$(this).remove();
			});
		}, 3000);
	}
	var n_size = $("#news li").size();
	if(n_size > 1) {
		headline();
	}
});
})(jQuery);*/
function ticker(){
    //最初のアイテムから順にスライドアップ
    $('#news li:first').slideUp( function(){
        $(this).appendTo($('#news')).slideDown();
    });
}
 //setInterval()で要素を繰り返し呼び出す
setInterval(function(){ticker()}, 4000);




(function($) {
$(function() {
	
/* ロールオーバー */
$('.over').opOver(1.0,0.8);

/* ドロップダウンメニュー */
$('.navToggle').click(function() {
	$(this).toggleClass('active');

	if ($(this).hasClass('active')) {
		$('.gnavi').addClass('active');
	} else {
		$('.gnavi').removeClass('active');
	}
});

});
})(jQuery);

/*------------------------------------------------ ロールオーバ ------------------------------------------------*/
/*=====================================================
meta: {
  title: "jquery-opacity-rollover.js",
  version: "2.1",
  copy: "copyright 2009 h2ham (h2ham.mail@gmail.com)",
  license: "MIT License(https://www.opensource.org/licenses/mit-license.php)",
  author: "THE HAM MEDIA - https://h2ham.seesaa.net/",
  date: "2009-07-21"
  modify: "2009-07-23"
}
=====================================================*/
(function($) {
	
	$.fn.opOver = function(op,oa,durationp,durationa){
		
		var c = {
			op:op? op:1.0,
			oa:oa? oa:0.6,
			durationp:durationp? durationp:'fast',
			durationa:durationa? durationa:'fast'
		};
		

		$(this).each(function(){
			$(this).css({
					opacity: c.op,
					filter: "alpha(opacity="+c.op*100+")"
				}).hover(function(){
					$(this).fadeTo(c.durationp,c.oa);
				},function(){
					$(this).fadeTo(c.durationa,c.op);
				})
		});
	},
	
	$.fn.wink = function(durationp,op,oa){

		var c = {
			durationp:durationp? durationp:'slow',
			op:op? op:1.0,
			oa:oa? oa:0.2
		};
		
		$(this).each(function(){
			$(this)	.css({
					opacity: c.op,
					filter: "alpha(opacity="+c.op*100+")"
				}).hover(function(){
				$(this).css({
					opacity: c.oa,
					filter: "alpha(opacity="+c.oa*100+")"
				});
				$(this).fadeTo(c.durationp,c.op);
			},function(){
				$(this).css({
					opacity: c.op,
					filter: "alpha(opacity="+c.op*100+")"
				});
			})
		});
	}
	
})(jQuery);


//ページトップ
(function(){
    $(".pagetop").click(
	function(){
        $("html,body").animate({scrollTop:0},'slow');
        return false;
	});
})(jQuery);



//開舞＋タン
/*
 + JQuery         : switchHat.js 0.10
 +
 + Author         : Takashi Hirasawa
 + Special Thanks : kotarok (https://nodot.jp/)
 + Copyright (c) 2010 CSS HappyLife (https://css-happylife.com/)
 + Licensed under the MIT License:
 + https://www.opensource.org/licenses/mit-license.php
 +
 + Since    : 2010-06-24
 + Modified : 2010-06-27
 */

(function($) {

	//澄2・iコメントアウトｌ"蛟莱@能低鯨）
	$(function(){
		$.uHat.switchHat();
		//$.uHat.close();
		$.uHat.openAll();
	});

	$.uHat = {

		// 裾艢・・洒
		switchHat: function(settings) {
			uHatConA = $.extend({
				switchBtn: '.switchHat',
				switchContents: '.switchDetail',
				switchClickAddClass: 'nowOpen'
			}, settings);
			$(uHatConA.switchContents).hide();
			$(uHatConA.switchBtn).addClass("switchOn").click(function(){
				var index = $(uHatConA.switchBtn).index(this);
				$(uHatConA.switchContents).eq(index).slideToggle("fast");
				$(this).toggleClass(uHatConA.switchClickAddClass);
			}).css("cursor","pointer");
		},

		// 燕俣・・操朽・{タンり貼ｦｌ"蟄
		close: function(settings) {
			uHatConB = $.extend({
				closeBtnSet: uHatConA.switchContents,
				apCloseBtn: '<span>X Close</span>'
			}, settings);
			$(uHatConB.closeBtnSet).append('<p class="closeBtnHat">'+uHatConB.apCloseBtn+'</p>');
			$(".closeBtnHat").children().click(function(){
				$(this).parents(uHatConA.switchContents).fadeOut("slow");
				$(this).parents().prev().contents(uHatConA.switchBtn).removeClass(uHatConA.switchClickAddClass);
			}).css("cursor","pointer");
		},

		// 全部開ｇ#{タン
		openAll: function(settings) {
			uHatConC = $.extend({
				openAllBtnClass: '.allOpenBtn',
				switchBtn: uHatConA.switchBtn,
				openContents: uHatConA.switchContents
			}, settings);
			$(uHatConC.openAllBtnClass).addClass("switchOn").toggle(
				function(){
					$(this).addClass(uHatConA.switchClickAddClass);
					$(uHatConC.openContents).slideDown("slow");
					$(uHatConC.switchBtn).addClass(uHatConA.switchClickAddClass);
				},
				function(){
					$(this).removeClass(uHatConA.switchClickAddClass);
					$(uHatConC.openContents).slideUp("slow");
					$(uHatConC.switchBtn).removeClass(uHatConA.switchClickAddClass);
				}
			).css("cursor","pointer");
		}

	};

})(jQuery);

