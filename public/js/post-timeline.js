/*!
 * imagesLoaded PACKAGED v4.1.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

!function(e,t){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",t):"object"==typeof module&&module.exports?module.exports=t():e.EvEmitter=t()}("undefined"!=typeof window?window:this,function(){function e(){}var t=e.prototype;return t.on=function(e,t){if(e&&t){var i=this._events=this._events||{},n=i[e]=i[e]||[];return n.indexOf(t)==-1&&n.push(t),this}},t.once=function(e,t){if(e&&t){this.on(e,t);var i=this._onceEvents=this._onceEvents||{},n=i[e]=i[e]||{};return n[t]=!0,this}},t.off=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){var n=i.indexOf(t);return n!=-1&&i.splice(n,1),this}},t.emitEvent=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){i=i.slice(0),t=t||[];for(var n=this._onceEvents&&this._onceEvents[e],o=0;o<i.length;o++){var r=i[o],s=n&&n[r];s&&(this.off(e,r),delete n[r]),r.apply(this,t)}return this}},t.allOff=function(){delete this._events,delete this._onceEvents},e}),function(e,t){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return t(e,i)}):"object"==typeof module&&module.exports?module.exports=t(e,require("ev-emitter")):e.imagesLoaded=t(e,e.EvEmitter)}("undefined"!=typeof window?window:this,function(e,t){function i(e,t){for(var i in t)e[i]=t[i];return e}function n(e){if(Array.isArray(e))return e;var t="object"==typeof e&&"number"==typeof e.length;return t?d.call(e):[e]}function o(e,t,r){if(!(this instanceof o))return new o(e,t,r);var s=e;return"string"==typeof e&&(s=document.querySelectorAll(e)),s?(this.elements=n(s),this.options=i({},this.options),"function"==typeof t?r=t:i(this.options,t),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(this.check.bind(this))):void a.error("Bad element for imagesLoaded "+(s||e))}function r(e){this.img=e}function s(e,t){this.url=e,this.element=t,this.img=new Image}var h=e.jQuery,a=e.console,d=Array.prototype.slice;o.prototype=Object.create(t.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(e){"IMG"==e.nodeName&&this.addImage(e),this.options.background===!0&&this.addElementBackgroundImages(e);var t=e.nodeType;if(t&&u[t]){for(var i=e.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=e.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var u={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(e){var t=getComputedStyle(e);if(t)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(t.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,e),n=i.exec(t.backgroundImage)}},o.prototype.addImage=function(e){var t=new r(e);this.images.push(t)},o.prototype.addBackground=function(e,t){var i=new s(e,t);this.images.push(i)},o.prototype.check=function(){function e(e,i,n){setTimeout(function(){t.progress(e,i,n)})}var t=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(t){t.once("progress",e),t.check()}):void this.complete()},o.prototype.progress=function(e,t,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded,this.emitEvent("progress",[this,e,t]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,e),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,e,t)},o.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(e,[this]),this.emitEvent("always",[this]),this.jqDeferred){var t=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[t](this)}},r.prototype=Object.create(t.prototype),r.prototype.check=function(){var e=this.getIsImageComplete();return e?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&this.img.naturalWidth},r.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.img,t])},r.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var e=this.getIsImageComplete();e&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.element,t])},o.makeJQueryPlugin=function(t){t=t||e.jQuery,t&&(h=t,h.fn.imagesLoaded=function(e,t){var i=new o(this,e,t);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});

(function($) {
    var items = new Array(), current = 0;

    /* Callbacks */
    var OnStep     = function(Percent) { };
    var OnComplete = function()        { };

    // Get all images from css and <img> tag
    var getImages = function(element) {
        $(element).find('img').each(function() {
            var url = "";
            
            if ($(this).get(0).nodeName.toLowerCase() == 'img' && typeof($(this).attr('data-src')) != 'undefined' && $(this).attr('data-src') != 'null') {
                url = $(this).attr('data-src');

                items.push(this);
            }
        });
    };

    var loadComplete = function() {
        current++;
   
        OnStep(Math.round((current / items.length) * 100));
   
        if (current == items.length) {
            OnComplete();
        }
    };

    var loadImg = function(_image) {

        var img = new Image;

        if (_image.dataset.src != 'null') {
          
          img.src = _image.dataset.src;

          img.onload = function() {
            
            _image.src         = img.src;
            _image.dataset.src = null;
            loadComplete();
          };
        }

    };

    $.fn.ptl_prefetch = function(options) {

        return this.each(function() {
            
            /* Set Callbacks */
            if (typeof(options.OnStep) !== "undefined") OnStep = options.OnStep;
            if (typeof(options.OnComplete) !== "undefined") OnComplete = options.OnComplete;

            getImages(this);

            for (var i = 0; i < items.length; i++) {
                loadImg(items[i]);
            }
        });
    };
})(jQuery);

(function( $ ) {

  'use strict';

  /* ServerCall Helper Function */
  var tab_loading = {show: function(){jQuery('.asl-p-cont > .loading').removeClass('hide');},hide: function(){jQuery('.asl-p-cont > .loading').addClass('hide');}};
  var ServerCall = function (_url, _data, _callback, _option) {_data   = _data == null ? {}: _data;_option = _option == null ? {}: _option; var i   = _option.dataType ? _option.dataType : "json";if(_option.submit) {_option.submit.button('loading');}tab_loading.show();var s = {type : _option.type ? _option.type : "POST",url : _url,data : _data,dataType : i,success : function (_d) {tab_loading.hide();_callback(_d);}};var o = jQuery.ajax(s);};
  function displayMessage(message,_form,_class,_no_animation){if(!_class) _class = 'alert alert-danger';_form.empty();var message = _form.message(message, {append: true,arrow: 'bottom',classes: [_class],animate: true});if(!_no_animation)jQuery('html, body').animate({scrollTop: _form.offset().top}, 'slow');};

  /**
   * [getKeyByIndex description]
   * @param  {[type]} obj   [description]
   * @param  {[type]} index [description]
   * @return {[type]}       [description]
   */
  function getKeyByIndex(obj, index) {
    var i = 0;

    if(obj)
      for (var attr in obj) {

        if(obj.hasOwnProperty(atfhtr)) {

            if (index === i){
              return attr;
            }
            i++;
        }
      }
    
    return null;
  };


  /**
   * [post_timeline_regen description]
   * @param  {[type]} _options [description]
   * @return {[type]}          [description]
   */
  $.fn.post_timeline_regen = function(_options) {

    var options = $.extend({},_options);
    var panim = null;

    /////////////////////////
    ///// Vertical Methods //
    /////////////////////////
    var ptl_navigation_vertical = {
        current_iterate: 0,
        initialize: function($_container) {

            this.$cont = $_container;

            var max_li = (_options.nav_max && !isNaN(_options.nav_max))?parseInt(_options.nav_max):4,
                $cont  = $_container.find('.yr_list');

            //set limit
            if(max_li <= 2 || max_li > 15) {
              max_li = 6;
            }


            var $cont_inner = $cont.find('.yr_list-inner'),
                $cont_view  = $cont.find('.yr_list-view');

            this.$cont_inner = $cont_inner;
            var cin_height   = $cont_inner.height();
            var $c_li        = $cont.find('.yr_list-inner li');
            this.li_count    = $c_li.length; 

            this.li_width        = cin_height / this.li_count; //pad
            this.iterate_width   = this.li_width * max_li;
            this.total_iterate   = Math.ceil(cin_height / this.iterate_width) - 1;

            //the iteration wrapper
            var c_iterate = 0,
                n_iterate = 0;
            for(var i = 0; i <= this.total_iterate; i++) {

              c_iterate  = i * max_li;
              n_iterate += max_li;
              var $temp_div = $c_li.slice(c_iterate, n_iterate).wrapAll('<div class="ptl-yr-list"/>');
              
              if(i == this.current_iterate) {
                $temp_div.parent().addClass('ptl-active');
              }
            }

            this.in_wrap_height = $cont.find('.ptl-yr-list').eq(0).outerHeight();
            this.iterate_width  = this.in_wrap_height;


            this.btn_top     = $cont.find('.btn-top'),
            this.btn_bottom  = $cont.find('.btn-bottom');
            
            if(this.li_count <= max_li) {

                this.btn_top.hide();
                this.btn_bottom.hide();
            }
            else{

              this.btn_top.show();
              this.btn_bottom.show();
              $(this.btn_top).addClass('ptl-disabled');
            }


            var padding = 0;
            $cont_view.height(((this.in_wrap_height) + padding)+ 'px');
            //$cont_view.height(((max_li * this.li_width) + padding)+ 'px');
            this.btn_top.unbind().bind('click',$.proxy(this.topArrow,this));
            this.btn_bottom.unbind().bind('click',$.proxy(this.bottomArrow,this));
        },
        topArrow: function(e) {

            var that = this;
            if(this.current_iterate > 0) {

                this.current_iterate--;

                this.$cont_inner.find('.ptl-yr-list').eq(this.current_iterate).addClass('ptl-active');

                //add disable
                if(this.current_iterate == 0) {
                    $(this.btn_top).addClass('ptl-disabled');
                }
                $(this.btn_bottom).removeClass('ptl-disabled');

                var to_top =  -(this.current_iterate * this.iterate_width);

                //console.log(this.current_iterate,'   ',to_left);
                that.$cont_inner.find('.ptl-yr-list').eq(that.current_iterate + 1).removeClass('ptl-active');
                this.$cont_inner.animate({'top':to_top+'px'},500,'swing',function(e) {

                    //that.$cont_inner.find('.ptl-yr-list').eq(that.current_iterate + 1).removeClass('ptl-active');
                    //console.log('===> post-timeline-public-display-12-h.php ===> 165 complete');
                });
            }
        },
        bottomArrow: function(e) {

            var that = this;
            if(this.current_iterate < this.total_iterate) {

                this.current_iterate++;

                this.$cont_inner.find('.ptl-yr-list').eq(this.current_iterate).addClass('ptl-active');

                if(this.current_iterate == this.total_iterate) {
                    $(this.btn_bottom).addClass('ptl-disabled');
                }
            
                $(this.btn_top).removeClass('ptl-disabled');
                  
                var to_top =  -(this.current_iterate * this.iterate_width);

                //console.log(this.current_iterate,'   ',to_left);
                that.$cont_inner.find('.ptl-yr-list').eq(that.current_iterate - 1).removeClass('ptl-active');
                this.$cont_inner.animate({'top':to_top+'px'},500,'swing',function(e) {
                    //console.log('===> post-timeline-public-display-12-h.php ===> 165 complete');
                    //that.$cont_inner.find('.ptl-yr-list').eq(that.current_iterate - 1).removeClass('ptl-active');
                    //that.$cont_inner.find('.ptl-yr-list').eq(that.current_iterate - 1).removeClass('ptl-active');
                });
            }
        },
        //vertical
        goTo: function(_iterate) {

            var that = this;

            var prev_iterate     = that.current_iterate;
            that.current_iterate = _iterate;

            //same iteration return
            if(prev_iterate == that.current_iterate)return;



            that.$cont_inner.find('.ptl-yr-list').eq(that.current_iterate).addClass('ptl-active');
            that.$cont_inner.find('.ptl-yr-list').eq(prev_iterate).removeClass('ptl-active');
            //that.$cont_inner.find('.ptl-yr-list').eq(prev_iterate).addClass('ptl-rem');

            //add Disable
            $(this.btn_top).removeClass('ptl-disabled');
            $(this.btn_bottom).removeClass('ptl-disabled');

            if(this.current_iterate == 0) {
                $(this.btn_top).addClass('ptl-disabled');
            }

            if(this.current_iterate == this.total_iterate) {
                $(this.btn_bottom).addClass('ptl-disabled');
            }

            var to_top = -(this.current_iterate * this.iterate_width);

            console.log('Goto Index: ',_iterate,' prev_iterate: '+prev_iterate,'current_iterate: '+this.current_iterate);


            this.$cont_inner.animate({'top':to_top+'px'},500,'swing',function(e) {

                //that.$cont_inner.find('.ptl-yr-list').eq(prev_iterate).removeClass('ptl-active');
            });
        },
        //Update tags List
        update_tags: function(_tag_list) {

          var that  = this,
              count = 0;

          console.log('===> post-timeline.js ===> 285', _tag_list);

          for(var y in _tag_list) {

              var tag_index = _tag_list[y][0],
                  tag_value = _tag_list[y][1];

              if(_tag_list.hasOwnProperty(y)) {
                
                if(that.$cont_inner.find('li[data-tag="'+tag_index+'"]').length == 0) {
                  count++;
                  that.$cont_inner.append('<li data-tag="'+tag_index+'"><a data-scroll data-options=\'{ "easing": "Quart" }\'  data-href="#ptl-tag-'+tag_index+'"><span>'+tag_value+'</span></a></li>');
                }
              }
          }

          //fix the tag list
          if(count > 0) {

              var _iterate = ptl_navigation_vertical.current_iterate;


              that.$cont_inner.find('.ptl-yr-list li').unwrap();
              
              //make current iteration
              ptl_navigation_vertical.current_iterate = _iterate;

              ptl_navigation_vertical.initialize(ptl_navigation_vertical.$cont);

          }
        }
    };

    /**
     * [debounce description]
     * @param  {[type]} func      [description]
     * @param  {[type]} wait      [description]
     * @param  {[type]} immediate [description]
     * @return {[type]}           [description]
     */
    function debounce(func, wait, immediate) {
      
      var timeout;
      return function() {
        var context = this, args = arguments;
        var later = function() {
          timeout = null;
          if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
      };
    };

    /**
     * [add_animation Add Animation]
     * @param {[type]} _options [description]
     * @param {[type]} $cont    [description]
     */
    var add_animation  = function(_options, $cont) {

      _options.offset = _options.offset || 0;

      //activate first li 
      $cont.find('.yr_list li:first-child a').addClass('active');
      
      var active_node = null;
      
      _options.scroller = _options.scroller || null;


      var first_load = true;
      /**
       * [description]
       */
      var anim_options = {
          boxClass:     'panim', 
          animateClass: 'animated',
          scrollContainer: (window['ptl_admin_pan'])?'.modaal-wrapper':_options.scroller,
          //scrollContainer: null,
          offset: 300,
          callbackloop: function(box) {

            //  Set the Opacity
            if(first_load) {
              first_load = false;
              $cont.find('.ptl-content-loaded').removeClass('ptl-content-loaded');
            }

            var _tag = $(box).data('tag');
            
            if(_options.scrolling)return;

            if(!active_node || _tag != active_node.data('tag')) {

              var $node = $cont.find('.yr_list li[data-tag="'+_tag+'"]');
              active_node = $node;
              $cont.find('.yr_list li a.active').removeClass('active');
              $node.children(0).addClass('active');

              //goto navigation
              var _nav_index = $cont.find('.ptl-yr-list.ptl-active').index();
              var _index = $node.parent().index();

              console.log('===> post-timeline.js ===> Current:', _nav_index, ' and Go to:', _index );

              if(_nav_index != _index) {
                ptl_navigation_vertical.goTo(_index);
              }
            }
          }
      };
      
      panim = new PTLAnim(anim_options);
        
      panim.init();

      if (_options['ptl-scroll-anim'] == 'on') {

        PTLAnim.prototype.addBox = function(element) {
          this.boxes.push(element);
        };
        // Attach scrollSpy to .panim elements for detect view exit events,
        // then reset elements and add again for animation
        $cont.find('.panim').on('scrollSpy:exit', function() {
          $(this).css({
            'visibility': 'hidden',
            'animation-name': 'none'
          }).addClass('animate__animated').removeClass('animate__').removeClass('animated');
          panim.addBox(this);
        }).scrollSpy();

      }
    };


    /**
     * [add_like_event Add the like event]
     * @param {[type]} $cont   [description]
     * @param {[type]} options [description]
     */
    var add_like_event = function($cont, options) {

      $cont.on('click','.ptl-post-like',function(){
        
        var $this   = $(this),
            post_id = $this.attr('id').replace("post-", "");

        ServerCall(PTL_REMOTE.ajax_url + "?action=ptl_save_post_like", { post_id: post_id }, function(_response) {

          if (_response.success) {

            $this.parent('li').find('.ptl-like-count').text(_response.count);
            $this.find('.heart').addClass('active')
          } 
        }, 'json');
      });
    }

    /**
     * [add_carousel description]
     * @param {[type]} $cont   [description]
     * @param {[type]} options [description]
     */
    var add_carousel = function($cont, options) {

      var gallery_cont = 'ptl-media-post-gallery';

      $cont.find(".ptl-media-post-gallery").owlCarousel({
        margin:10, 
        nav:true, 
        responsive:{ 
          0:{ items:1},
          600:{items:1},
          1000:{items:1}
        }
      });

    };


    /**
     * [images_popup Post Popup Gallery Event]
     * @param  {[type]} $cont   [description]
     * @param  {[type]} options [description]
     * @return {[type]}         [description]
     */
    var images_popup = function($cont, options) {

      $cont.on('click','.ptl-post-like',function(){
        
        var $this   = $(this),
            post_id = $this.attr('id').replace("post-", "");

        ServerCall(PTL_REMOTE.ajax_url + "?action=ptl_save_post_like", { post_id: post_id }, function(_response) {

          if (_response.success) {

            $this.parent('li').find('.ptl-like-count').text(_response.count);

          } 
        
        }, 'json');
      });
    };


    /**
     * [loadmore_functionality Add Load More]
     * @param {[type]} $cont    [description]
     * @param {[type]} _options [description]
     */
    var loadmore_functionality = function($cont, _options) {
      var page = 2,
          allow_scroll = true;
      //Load More Button
      if (_options['ptl-pagination'] == 'button') {
        $cont.find('.plt-load-more .ptl-more-btn').bind('click', function (e) {

          e.preventDefault();
          ajax_post_Data($cont,options);

        });
      }

      // Ajax Retrive Post Data
      function ajax_post_Data($cont,_options) {

        var $this = $cont.find('.plt-load-more .ptl-more-btn');
        var step = $cont.find('.plt-load-more').attr('data-steps');
        var first_load = true;

        var data = {
          'action': 'timeline_ajax_load_posts',
          'page': page,
          'step': step,
          'config': _options,
          'security': PTL_REMOTE.security
        };

        //  Show the loader
        $this.bootButton('loading');

        var scroll_loader = $cont.find('.ptl-scroll-loader');

        if (scroll_loader[0]) {
          scroll_loader.html('<span class="'+PTL_REMOTE.loader_style+'"></span> ');
        }

        //  Send an AJAX request for load more
        $.post( PTL_REMOTE.ajax_url, data, function( response ) {
          
          response = JSON.parse(response);


          if( $.trim(response.template) != '' && response.success ) {

            // append template
            $cont.find('.ptl-tmpl-main-inner' ).append( response.template );

            if (response.navigation) {
                //Update tag list
                ptl_navigation_vertical.update_tags(response.navigation);
            }

            if (response.step) {
              $cont.find('.plt-load-more').attr('data-steps',response.step);
            }

            // Remove duplicate Years
            $cont.find('.ptl-sec-year[data-id]').each(function(){
              
              var ids = $(this).attr('data-id');

              if(ids.length > 1 && ids == $(this).attr('data-id')){
                $cont.find('.ptl-sec-year[data-id="'+$(this).attr('data-id')+'"]').eq(1).parent('div').parent('.ptl-row').remove();
              }
            });

            page++;
            allow_scroll = true;  

            if (_options['ptl-scroll-anim'] == 'on') {

              // reset animation
              $cont.find('.panim').on('scrollSpy:exit', function() {
                $(this).css({
                  'visibility': 'hidden',
                  'animation-name': 'none'
                }).removeClass('animate__').addClass('animate__animated');
                panim.addBox(this);
              }).scrollSpy();

            }

            //  Set the Opacity
            if(first_load) {
              first_load = false;
              $cont.find('.ptl-content-loaded').removeClass('ptl-content-loaded');
            }

          } 
          else {
            $cont.find('.ptl-no-more-posts span').text(PTL_REMOTE.LANG.no_more_posts);
            $this.hide();
          }

          //  Hide the loader
          $this.bootButton('reset');

          if (scroll_loader[0]) {
            scroll_loader.html('');
          }

          if (_options['ptl-lazy-load'] == 'on') {
            // lazyload images
            prefetcher($cont);
          }

          //  Add Carousel
          add_carousel($cont, _options);
        });


      }
    };


    /**
     * [add_video_posts description]
     * @param {[type]} $cont    [description]
     * @param {[type]} _options [description]
     */
    var add_video_posts = function($cont, _options) {

      var ptl_video_link;  

      $cont.find('.ptl-video-btn').click(function() {
        
        //  Get the proper video src
        ptl_video_link = $(this).attr( "data-src" );
          $cont.find("#ptl-video").attr('src', "" ); 

        if (ptl_video_link != '' && ptl_video_link != null) {

          ptl_video_link = ptl_video_link.replace('watch?v=', 'embed/');
          ptl_video_link = ptl_video_link.split('&')[0];

          //  Change the attribute
          $cont.find("#ptl-video").attr('src', ptl_video_link + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 

          
          $cont.find('.ptl-video-popup').popout({
            keyboard: true,
            backdrop: true,
            focus: true
          });
        }
      });
      ////////////////////////////
      //  Close the Video popout //
      ////////////////////////////
      /*$cont.find('.ptl-popout-backdrop-in').bind('click', function() {
        
        window.setTimeout(function() {
          $('.popout').popout('hide');
          $cont.find("#ptl-video").attr('src', '' ); 
        }, 300);
      });*/
    };


    /**
     * [prefetcher Prefetch all the images of the container]
     * @param  {[type]} $cont [description]
     * @return {[type]}       [description]
     */
    var prefetcher = function($cont) {

       $cont.ptl_prefetch({
          OnStep: function(percent) {

            // console.log('===> post-timeline.js ===> 1155',percent);
          },
          OnComplete: function() {
            // console.log('===> post-timeline.js ===> OnComplete');
          }
      });

    };

    /**
     * [post_gallery_popup description]
     * @param {[type]} $cont    [description]
     * @param {[type]} _options [description]
     */
    var post_gallery_popup = function($cont, _options) {

      $cont.on('click','.ptl-gallery-popup-btn',function() {
        $cont.find('.ptl-gallery-popup').popout({
          keyboard: true,
          backdrop: true,
          focus: true
        });

        var $this = $(this);

        var post_id = $this.attr('data-post');

        $cont.find('.ptl-gallery-popup .ptl-popup-carousel').html('');

        ServerCall(PTL_REMOTE.ajax_url + "?action=ptl_popup_gallery", { post_id: post_id }, function(_response) {

          if (_response.success) {

            $cont.find('.ptl-gallery-popup .ptl-popup-carousel').html(_response.gallery);

               $cont.find(".ptl-media-post-gallery-popup").owlCarousel({
                 margin:10, 
                 nav:true, 
                 responsive:{ 
                   0:{ items:1},
                   600:{items:1},
                   1000:{items:1}
                 }
               });

               if (_options['ptl-lazy-load'] == 'on') {
                 // lazyload images
                 prefetcher($cont);
               }


          } 
        }, 'json');
      });

    };


    /**
     * [ptl_main Post Timeline Main method]
     * @return {[type]} [description]
     */
    function ptl_main() {
      
      //  Main This
      var $this      = $(this);
      var $section   = $this.find('.timeline-section');

      //  Vertical Timelines

      options.scroller = _options.scroller || null;

      //  Add ptl scroll :: once
      $.fn.ptlScroller({
        nav_offset: (options.nav_offset)?parseInt(options.nav_offset):null,
        selector: '[data-scroll]',
        easing: _options['ptl-easing'],//easeInQuad,easeOutQuad,easeInOutQuad,easeInCubic,easeOutCubic,easeInOutCubic,easeInQuart,easeOutQuart,easeInOutQuart,easeInQuint,easeOutQuint,easeInOutQuint
        doc: options.scroller,
        before: function(e){

          options.scrolling = true;
          
        },
        after: function(e){

          options.scrolling = false; 
        }
      });
          
      //Add Animation :: Once
      if(options['ptl-anim-status']) {

        add_animation(options, $this);
      }
      //  Set the opacity to 1 when animation is disabled
      else {
        $this.find('.ptl-content-loaded').removeClass('ptl-content-loaded');
      }


      //  Add the load more
      loadmore_functionality($this, options);

      //  Add the video
      add_video_posts($this, options);

      //  Close the video after hide event on modal
      $this.find('.ptl-video-popup').on('hidden.bs.popout', function (e) {
        $this.find("#ptl-video").attr('src', '' ); 
      });

      // Create gallery popup
      post_gallery_popup($this, options);

      //  Add the video
      add_like_event($this, options);

      //  Add Popups for Images
      images_popup($this, options);

      //  Add Carousel
      add_carousel($this, options);

      if (options['ptl-lazy-load'] == 'on') {
        // pre fetch images
        prefetcher($this);
      }
      


         
      //  Navigation enable?
      if(options['ptl-nav-status']) {

        ptl_navigation_vertical.initialize($this);

        //sticky navigation func
        function ptl_yrmenu(fixmeTop) {

            var currentScroll = $(window).scrollTop();

            if (currentScroll >= fixmeTop) {
                
              $this.addClass('nav-fixed');
              
              $this.find('.yr_list').css({                      
                  position: 'fixed'
              });
            }
            else {
                
              $this.removeClass('nav-fixed');
              $this.find('.yr_list').css({
                  position: 'absolute'
              });
            }
        }

        //  Sticky navigation
        var TopDistance = ($this.offset().top) + -400;
        ptl_yrmenu(TopDistance);

        $(window).scroll(function() {
            
          ptl_yrmenu(TopDistance);
        });
      }     


    $this.find('.ptl-loader-overlay').addClass('d-none');
  };

    /*loop for each*/
    this.each(ptl_main);

    return this;
  };

  //   Main Loop
  $('.ptl-cont').each(function(e){

    //console.log('===> post-timeline.js ===> 1253');
      var ptl_config_id = $(this).attr('data-id'),
          ptl_config    = window['ptl_config_' + ptl_config_id];

      // console.log(this, '===> post-timeline.js ===> 1256', ptl_config_id);
      if(ptl_config) {
       $(this).post_timeline_regen(ptl_config);
      }
  });

  /**
   * [bState Change Button State]
   * @param  {[type]} _state [description]
   * @return {[type]}        [description]
   */
  jQuery.fn.bootButton = function(_state) {

      //  Empty
      if(!this[0])return;

      if(_state == 'loading')
        this.attr('data-reset-text', this.html());

      if(_state == 'loading') {

        if(!this[0].dataset.resetText) {
          this[0].dataset.resetText = this.html();
        }

        this.addClass('disabled').attr('disabled','disabled').html('<span class="'+PTL_REMOTE.loader_style+'"></span> ' + this[0].dataset.loadingText);
      }
      else if(_state == 'reset')
        this.removeClass('disabled').removeAttr('disabled').html(this[0].dataset.resetText);
      else if(_state == 'update')
        this.removeClass('disabled').removeAttr('disabled').html(this[0].dataset.updateText);
      else
        this.addClass('disabled').attr('disabled','disabled').html(this[0].dataset[_state+'Text']);
  };

}( jQuery ));


