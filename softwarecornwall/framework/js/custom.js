/* ------------------------------------------------------------------------ */
/* Skat Design Custom Js
/* http://skat.tf
/* ------------------------------------------------------------------------ */
(function($){"use strict";$(function(){$('.sd-menu-wrapper ul').superfish()});var $submit_button;var $website_box;$submit_button=$(".form-submit #submit");$website_box=$(".last-input input");$submit_button.click(function(){if($website_box.attr("value")==="Website"){$website_box.attr("value","")}});$('#wp-advanced-search').find('#search_query').each(function(ev){if(!$(this).val()){$(this).attr('placeholder',sd_advanced_search_var.attr)}});$('.sd-newsletter input[type=email]').attr('placeholder',sd_newlsetter_var.attr);$('.sd-search-input').attr('placeholder',sd_search_var.attr);$(window).load(function(){$('.flexslider').flexslider({animation:"slide"});$('.sd-latest-tweets-slider').flexslider({animation:"fade",controlNav:false})})})(jQuery);
/*!
 * jquery.customSelect() - v0.5.1
 * http://adam.co/lab/jquery/customselect/
 * 2014-04-19
 *
 * Copyright 2013 Adam Coulombe
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @license http://www.gnu.org/licenses/gpl.html GPL2 License 
 */
(function(a){a.fn.extend({customSelect:function(c){if(typeof document.body.style.maxHeight==="undefined"){return this}var e={customClass:"customSelect",mapClass:true,mapStyle:true},c=a.extend(e,c),d=c.customClass,f=function(h,k){var g=h.find(":selected"),j=k.children(":first"),i=g.html()||"&nbsp;";j.html(i);if(g.attr("disabled")){k.addClass(b("DisabledOption"))}else{k.removeClass(b("DisabledOption"))}setTimeout(function(){k.removeClass(b("Open"));a(document).off("mouseup.customSelect")},60)},b=function(g){return d+g};return this.each(function(){var g=a(this),i=a("<span />").addClass(b("Inner")),h=a("<span />");g.after(h.append(i));h.addClass(d);if(c.mapClass){h.addClass(g.attr("class"))}if(c.mapStyle){h.attr("style",g.attr("style"))}g.addClass("hasCustomSelect").on("render.customSelect",function(){f(g,h);g.css("width","");var k=parseInt(g.outerWidth(),10)-(parseInt(h.outerWidth(),10)-parseInt(h.width(),10));h.css({display:"inline-block"});var j=h.outerHeight();if(g.attr("disabled")){h.addClass(b("Disabled"))}else{h.removeClass(b("Disabled"))}i.css({width:k,display:"inline-block"});g.css({"-webkit-appearance":"menulist-button",width:h.outerWidth(),position:"absolute",opacity:0,height:j,fontSize:h.css("font-size")})}).on("change.customSelect",function(){h.addClass(b("Changed"));f(g,h)}).on("keyup.customSelect",function(j){if(!h.hasClass(b("Open"))){g.trigger("blur.customSelect");g.trigger("focus.customSelect")}else{if(j.which==13||j.which==27){f(g,h)}}}).on("mousedown.customSelect",function(){h.removeClass(b("Changed"))}).on("mouseup.customSelect",function(j){if(!h.hasClass(b("Open"))){if(a("."+b("Open")).not(h).length>0&&typeof InstallTrigger!=="undefined"){g.trigger("focus.customSelect")}else{h.addClass(b("Open"));j.stopPropagation();a(document).one("mouseup.customSelect",function(k){if(k.target!=g.get(0)&&a.inArray(k.target,g.find("*").get())<0){g.trigger("blur.customSelect")}else{f(g,h)}})}}}).on("focus.customSelect",function(){h.removeClass(b("Changed")).addClass(b("Focus"))}).on("blur.customSelect",function(){h.removeClass(b("Focus")+" "+b("Open"))}).on("mouseenter.customSelect",function(){h.addClass(b("Hover"))}).on("mouseleave.customSelect",function(){h.removeClass(b("Hover"))}).trigger("render.customSelect")})}})})(jQuery);

jQuery(document).ready(function($){
	$('.wpas-select').customSelect();
});

/*
 * jQuery Superfish Menu Plugin
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *	http://www.opensource.org/licenses/mit-license.php
 *	http://www.gnu.org/licenses/gpl.html
 */
(function(e){"use strict";var t=function(){var t={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",menuArrowClass:"sf-arrows"},n=function(){var t=/iPhone|iPad|iPod/i.test(navigator.userAgent);if(t){e(window).load(function(){e("body").children().on("click",e.noop)})}return t}(),r=function(){var e=document.documentElement.style;return"behavior"in e&&"fill"in e&&/iemobile/i.test(navigator.userAgent)}(),i=function(e,n){var r=t.menuClass;if(n.cssArrows){r+=" "+t.menuArrowClass}e.toggleClass(r)},s=function(n,r){return n.find("li."+r.pathClass).slice(0,r.pathLevels).addClass(r.hoverClass+" "+t.bcClass).filter(function(){return e(this).children(r.popUpSelector).hide().show().length}).removeClass(r.pathClass)},o=function(e){e.children("a").toggleClass(t.anchorClass)},u=function(e){var t=e.css("ms-touch-action");t=t==="pan-y"?"auto":"pan-y";e.css("ms-touch-action",t)},a=function(t,i){var s="li:has("+i.popUpSelector+")";if(e.fn.hoverIntent&&!i.disableHI){t.hoverIntent(l,c,s)}else{t.on("mouseenter.superfish",s,l).on("mouseleave.superfish",s,c)}var o="MSPointerDown.superfish";if(!n){o+=" touchend.superfish"}if(r){o+=" mousedown.superfish"}t.on("focusin.superfish","li",l).on("focusout.superfish","li",c).on(o,"a",i,f)},f=function(t){var n=e(this),r=n.siblings(t.data.popUpSelector);if(r.length>0&&r.is(":hidden")){n.one("click.superfish",false);if(t.type==="MSPointerDown"){n.trigger("focus")}else{e.proxy(l,n.parent("li"))()}}},l=function(){var t=e(this),n=d(t);clearTimeout(n.sfTimer);t.siblings().superfish("hide").end().superfish("show")},c=function(){var t=e(this),r=d(t);if(n){e.proxy(h,t,r)()}else{clearTimeout(r.sfTimer);r.sfTimer=setTimeout(e.proxy(h,t,r),r.delay)}},h=function(t){t.retainPath=e.inArray(this[0],t.$path)>-1;this.superfish("hide");if(!this.parents("."+t.hoverClass).length){t.onIdle.call(p(this));if(t.$path.length){e.proxy(l,t.$path)()}}},p=function(e){return e.closest("."+t.menuClass)},d=function(e){return p(e).data("sf-options")};return{hide:function(t){if(this.length){var n=this,r=d(n);if(!r){return this}var i=r.retainPath===true?r.$path:"",s=n.find("li."+r.hoverClass).add(this).not(i).removeClass(r.hoverClass).children(r.popUpSelector),o=r.speedOut;if(t){s.show();o=0}r.retainPath=false;r.onBeforeHide.call(s);s.stop(true,true).animate(r.animationOut,o,function(){var t=e(this);r.onHide.call(t)})}return this},show:function(){var e=d(this);if(!e){return this}var t=this.addClass(e.hoverClass),n=t.children(e.popUpSelector);e.onBeforeShow.call(n);n.stop(true,true).animate(e.animation,e.speed,function(){e.onShow.call(n)});return this},destroy:function(){return this.each(function(){var n=e(this),r=n.data("sf-options"),s;if(!r){return false}s=n.find(r.popUpSelector).parent("li");clearTimeout(r.sfTimer);i(n,r);o(s);u(n);n.off(".superfish").off(".hoverIntent");s.children(r.popUpSelector).attr("style",function(e,t){return t.replace(/display[^;]+;?/g,"")});r.$path.removeClass(r.hoverClass+" "+t.bcClass).addClass(r.pathClass);n.find("."+r.hoverClass).removeClass(r.hoverClass);r.onDestroy.call(n);n.removeData("sf-options")})},init:function(n){return this.each(function(){var r=e(this);if(r.data("sf-options")){return false}var f=e.extend({},e.fn.superfish.defaults,n),l=r.find(f.popUpSelector).parent("li");f.$path=s(r,f);r.data("sf-options",f);i(r,f);o(l);u(r);a(r,f);l.not("."+t.bcClass).superfish("hide",true);f.onInit.call(this)})}}}();e.fn.superfish=function(n,r){if(t[n]){return t[n].apply(this,Array.prototype.slice.call(arguments,1))}else if(typeof n==="object"||!n){return t.init.apply(this,arguments)}else{return e.error("Method "+n+" does not exist on jQuery.fn.superfish")}};e.fn.superfish.defaults={popUpSelector:"ul,.sf-mega",hoverClass:"sfHover",pathClass:"overrideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},animationOut:{opacity:"hide"},speed:"normal",speedOut:"fast",cssArrows:true,disableHI:false,onInit:e.noop,onBeforeShow:e.noop,onShow:e.noop,onBeforeHide:e.noop,onHide:e.noop,onIdle:e.noop,onDestroy:e.noop};e.fn.extend({hideSuperfishUl:t.hide,showSuperfishUl:t.show})})(jQuery);

// Sticky Plugin v1.0.0 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky

(function(e){var t={topSpacing:0,bottomSpacing:0,className:"is-sticky",wrapperClassName:"sticky-wrapper",center:false,getWidthFrom:"",responsiveWidth:false},n=e(window),r=e(document),i=[],s=n.height(),o=function(){var t=n.scrollTop(),o=r.height(),u=o-s,a=t>u?u-t:0;for(var f=0;f<i.length;f++){var l=i[f],c=l.stickyWrapper.offset().top,h=c-l.topSpacing-a;if(t<=h){if(l.currentTop!==null){l.stickyElement.css("position","").css("top","");l.stickyElement.trigger("sticky-end",[l]).parent().removeClass(l.className);l.currentTop=null}}else{var p=o-l.stickyElement.outerHeight()-l.topSpacing-l.bottomSpacing-t-a;if(p<0){p=p+l.topSpacing}else{p=l.topSpacing}if(l.currentTop!=p){l.stickyElement.css("position","fixed").css("top",p);if(typeof l.getWidthFrom!=="undefined"){l.stickyElement.css("width",e(l.getWidthFrom).width())}l.stickyElement.trigger("sticky-start",[l]).parent().addClass(l.className);l.currentTop=p}}}},u=function(){s=n.height();for(var t=0;t<i.length;t++){var r=i[t];if(typeof r.getWidthFrom!=="undefined"&&r.responsiveWidth===true){r.stickyElement.css("width",e(r.getWidthFrom).width())}}},a={init:function(n){var r=e.extend({},t,n);return this.each(function(){var n=e(this);var s=n.attr("id");var o=s?s+"-"+t.wrapperClassName:t.wrapperClassName;var u=e("<div></div>").attr("id",s+"-sticky-wrapper").addClass(r.wrapperClassName);n.wrapAll(u);if(r.center){n.parent().css({width:n.outerWidth(),marginLeft:"auto",marginRight:"auto"})}if(n.css("float")=="right"){n.css({"float":"none"}).parent().css({"float":"right"})}var a=n.parent();a.css("height",n.outerHeight());i.push({topSpacing:r.topSpacing,bottomSpacing:r.bottomSpacing,stickyElement:n,currentTop:null,stickyWrapper:a,className:r.className,getWidthFrom:r.getWidthFrom,responsiveWidth:r.responsiveWidth})})},update:o,unstick:function(t){return this.each(function(){var t=e(this);var n=-1;for(var r=0;r<i.length;r++){if(i[r].stickyElement.get(0)==t.get(0)){n=r}}if(n!=-1){i.splice(n,1);t.unwrap();t.removeAttr("style")}})}};if(window.addEventListener){window.addEventListener("scroll",o,false);window.addEventListener("resize",u,false)}else if(window.attachEvent){window.attachEvent("onscroll",o);window.attachEvent("onresize",u)}e.fn.sticky=function(t){if(a[t]){return a[t].apply(this,Array.prototype.slice.call(arguments,1))}else if(typeof t==="object"||!t){return a.init.apply(this,arguments)}else{e.error("Method "+t+" does not exist on jQuery.sticky")}};e.fn.unstick=function(t){if(a[t]){return a[t].apply(this,Array.prototype.slice.call(arguments,1))}else if(typeof t==="object"||!t){return a.unstick.apply(this,arguments)}else{e.error("Method "+t+" does not exist on jQuery.sticky")}};e(function(){setTimeout(o,0)})})(jQuery)

jQuery(window).load(function() {
	jQuery(".sd-sticky-header").sticky({topSpacing:0});
});


/*! Sidr - v1.2.1 - 2013-11-06
 * https://github.com/artberri/sidr
 * Copyright (c) 2013 Alberto Varela; Licensed MIT */
(function(e){var t=!1,i=!1,n={isUrl:function(e){var t=RegExp("^(https?:\\/\\/)?((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|((\\d{1,3}\\.){3}\\d{1,3}))(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*(\\?[;&a-z\\d%_.~+=-]*)?(\\#[-a-z\\d_]*)?$","i");return t.test(e)?!0:!1},loadContent:function(e,t){e.html(t)},addPrefix:function(e){var t=e.attr("id"),i=e.attr("class");"string"==typeof t&&""!==t&&e.attr("id",t.replace(/([A-Za-z0-9_.\-]+)/g,"sidr-id-$1")),"string"==typeof i&&""!==i&&"sidr-inner"!==i&&e.attr("class",i.replace(/([A-Za-z0-9_.\-]+)/g,"sidr-class-$1")),e.removeAttr("style")},execute:function(n,s,a){"function"==typeof s?(a=s,s="sidr"):s||(s="sidr");var r,d,l,c=e("#"+s),u=e(c.data("body")),f=e("html"),p=c.outerWidth(!0),g=c.data("speed"),h=c.data("side"),m=c.data("displace"),v=c.data("onOpen"),y=c.data("onClose"),x="sidr"===s?"sidr-open":"sidr-open "+s+"-open";if("open"===n||"toggle"===n&&!c.is(":visible")){if(c.is(":visible")||t)return;if(i!==!1)return o.close(i,function(){o.open(s)}),void 0;t=!0,"left"===h?(r={left:p+"px"},d={left:"0px"}):(r={right:p+"px"},d={right:"0px"}),u.is("body")&&(l=f.scrollTop(),f.css("overflow-x","hidden").scrollTop(l)),m?u.addClass("sidr-animating").css({width:u.width(),position:"absolute"}).animate(r,g,function(){e(this).addClass(x)}):setTimeout(function(){e(this).addClass(x)},g),c.css("display","block").animate(d,g,function(){t=!1,i=s,"function"==typeof a&&a(s),u.removeClass("sidr-animating")}),v()}else{if(!c.is(":visible")||t)return;t=!0,"left"===h?(r={left:0},d={left:"-"+p+"px"}):(r={right:0},d={right:"-"+p+"px"}),u.is("body")&&(l=f.scrollTop(),f.removeAttr("style").scrollTop(l)),u.addClass("sidr-animating").animate(r,g).removeClass(x),c.animate(d,g,function(){c.removeAttr("style").hide(),u.removeAttr("style"),e("html").removeAttr("style"),t=!1,i=!1,"function"==typeof a&&a(s),u.removeClass("sidr-animating")}),y()}}},o={open:function(e,t){n.execute("open",e,t)},close:function(e,t){n.execute("close",e,t)},toggle:function(e,t){n.execute("toggle",e,t)},toogle:function(e,t){n.execute("toggle",e,t)}};e.sidr=function(t){return o[t]?o[t].apply(this,Array.prototype.slice.call(arguments,1)):"function"!=typeof t&&"string"!=typeof t&&t?(e.error("Method "+t+" does not exist on jQuery.sidr"),void 0):o.toggle.apply(this,arguments)},e.fn.sidr=function(t){var i=e.extend({name:"sidr",speed:200,side:"left",source:null,renaming:!0,body:"body",displace:!0,onOpen:function(){},onClose:function(){}},t),s=i.name,a=e("#"+s);if(0===a.length&&(a=e("<div />").attr("id",s).appendTo(e("body"))),a.addClass("sidr").addClass(i.side).data({speed:i.speed,side:i.side,body:i.body,displace:i.displace,onOpen:i.onOpen,onClose:i.onClose}),"function"==typeof i.source){var r=i.source(s);n.loadContent(a,r)}else if("string"==typeof i.source&&n.isUrl(i.source))e.get(i.source,function(e){n.loadContent(a,e)});else if("string"==typeof i.source){var d="",l=i.source.split(",");if(e.each(l,function(t,i){d+='<div class="sidr-inner">'+e(i).html()+"</div>"}),i.renaming){var c=e("<div />").html(d);c.find("*").each(function(t,i){var o=e(i);n.addPrefix(o)}),d=c.html()}n.loadContent(a,d)}else null!==i.source&&e.error("Invalid Sidr Source");return this.each(function(){var t=e(this),i=t.data("sidr");i||(t.data("sidr",s),"ontouchstart"in document.documentElement?(t.bind("touchstart",function(e){e.originalEvent.touches[0],this.touched=e.timeStamp}),t.bind("touchend",function(e){var t=Math.abs(e.timeStamp-this.touched);200>t&&(e.preventDefault(),o.toggle(s))})):t.click(function(e){e.preventDefault(),o.toggle(s)}))})}})(jQuery);

jQuery(".sd-responsive-menu-toggle a").sidr({name:"sidr-main",source:".sd-menu-wrapper",side:"left",renaming:true,displace:false,onOpen:function(){jQuery(".sd-responsive-menu-close").toggleClass("sd-resp-menu-active")},onClose:function(){jQuery(".sd-responsive-menu-close").removeClass("sd-resp-menu-active")}});jQuery(".sidr-inner").prepend('<span class="sd-responsive-menu-close"><i class="fa fa-bars"></i><i class="fa fa-times"></i></span>');jQuery(".sidr-class-menu-item-has-children").each(function(e){jQuery(this).append('<span class="sidr-chevron"><i class="fa fa-chevron-right"></i></span>')});jQuery(".sidr-chevron").on("click touchstart",function(){var e=jQuery(this).prev("ul");var t=e.is(":visible")?'<i class="fa fa-chevron-right"></i>':'<i class="fa fa-chevron-down"></i>';jQuery(this).html(t);e.toggle();jQuery(this).toggleClass("sd-menu-active");return false});jQuery(".sd-responsive-menu-close").click(function(){jQuery.sidr("close","sidr-main");return false});

/*
 *  Project: Scrolly : parallax is easy as a matter of fact !
 *  Description: Based on jQuery boilerplate
 *  Author: Victor C. / Octave & Octave web agency
 *  Licence: MIT
 */
(function ( $, window, document, undefined ) {
    // Create the defaults once
    var pluginName = 'scrolly',
        defaults = {
            bgParallax: false
        },
        didScroll = false;

    function Plugin( element, options ) {
        this.element = element;
        this.$element = $(this.element);

        this.options = $.extend( {}, defaults, options) ;
        
        this._defaults = defaults;
        this._name = pluginName;
        
        this.init();
    }

    Plugin.prototype.init = function () {
        var self = this;
        this.startPosition = this.$element.position().top;
        this.offsetTop = this.$element.offset().top;
        this.height = this.$element.outerHeight(true);
        this.velocity = this.$element.attr('data-velocity');
        this.bgStart = parseInt(this.$element.attr('data-fit'), 10);

        $(document).scroll(function(){
            self.didScroll = true;
        });
        
        setInterval(function() {
            if (self.didScroll) {
                self.didScroll = false;
                self.scrolly();
            }
        }, 10);
    };

    Plugin.prototype.scrolly = function() {
        var dT =  $(window).scrollTop(),
            wH = $(window).height(),
            position = this.startPosition;

        if(this.offsetTop >= (dT+wH)) {
            this.$element.addClass('scrolly-invisible');
        } else {
            if(this.$element.hasClass('scrolly-invisible')){
                position = this.startPosition + (dT + ( wH - this.offsetTop ) ) * this.velocity;
            } else {
                position = this.startPosition + dT  * this.velocity;
            }
        }
        // Fix background position
        if(this.bgStart){ position = position + this.bgStart; }

        if(this.options.bgParallax === true) {
            this.$element.css({backgroundPosition: '50% '+position+'px'});
        } else {
            this.$element.css({top: position});
        }
    };

    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
            }
        });
    };

})(jQuery, window, document);

// Resize news article container divs to the largest one on archive / category pages

jQuery(document).ready(function(){

    jQuery('#post-wrapper').each(function(){

        // Cache the highest
        var highestBox = 0;
        
        // Select and loop the elements you want to equalise
        jQuery('.sd-blog-entry', this).each(function(){
        
            // If this box is higher than the cached highest then store it
            if(jQuery(this).height() > highestBox) {
                highestBox = jQuery(this).height(); 
            }
        
        });
            
        // Set the height of all those children to whichever was highest 
        jQuery('.sd-blog-entry',this).height(highestBox);
    });
});


/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */
