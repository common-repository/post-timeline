(function ($) {
  'use strict';

  var ptl_feedback_popup = {
    elements: {},
    bindEvents: function() {
      console.log('===> feedback.js ===> 7');
      var self = this;

      self.elements.$deactivator_link.on('click', function (event) {
        event.preventDefault();
        self.showModal();
      });      

      $(document).on('click','#ptl-feedback-submit',function(){
        self.sendFeedback();
      });      

      $(document).on('click','#ptl-feedback-skip',function(){
        self.deactivate();
      });

    },
    deactivate: function() {
      location.href = this.elements.$deactivator_link.attr('href');
    },
    ptl_escape_listener: function(e){

      var self = this;

      if(e.key === "Escape") {
        this.ptl_close_modal(self.elements.ptl_modal);
      }
    },
    ptl_close_modal: function(){

      var self = this;

      window.setTimeout(function() {
        $(self.elements.ptl_modal).modal('hide');
      }, 300);

      //  Clear the listener for Escape
      document.removeEventListener('keyup', self.ptl_escape_listener);
    },
    showModal: function() {
      var self = this;

      $(self.elements.ptl_modal).modal('show');
    
    },
    sendFeedback: function() {
      var self = this,
          formData = $(self.elements.ptl_modal.ptl_form).PTLSerializeObject();
        var data = {
          'action': 'ajax_post_timeline_deactivate_feedback',
          'formData': formData,
        };
      $.post(ajaxurl,data,function(_response){
        if (_response.success) {
          self.deactivate();
        }
      });
    },
    init: function() {

      this.elements.$deactivator_link  = $('#the-list').find('[data-slug="post-timeline"] span.deactivate a');
      this.elements.ptl_modal          = document.querySelector('#ptl-feedback-popup');
      this.elements.ptl_modal.ptl_form = document.querySelector('#ptl-feedback-form');
      this.bindEvents();
    }
  };

  $(function () {
    ptl_feedback_popup.init();
  });

})(jQuery);

