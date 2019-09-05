/*  ================================================================================
$(function()まとめ
================================================================================  */
$(function(){
 
/*------ 上部固定ヘッダー ------*/
  $('.fix-head').each(function() {
    var nav = $(this);
    // メニューのtop座標を取得する
    var offsetTop = nav.offset().top;
    var floatMenu = function() {
        // スクロール位置がメニューのtop座標を超えたら固定にする
        if (jQuery(window).scrollTop() > offsetTop + 700) {
            nav.addClass('fixed').slideDown();
        } else {
            nav.removeClass('fixed').slideUp();
        }
    }
    jQuery(window).scroll(floatMenu);
    jQuery('body').bind('touchmove', floatMenu);
  });

});