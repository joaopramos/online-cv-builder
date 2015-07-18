(function() {
  var laravel = {
    initialize: function() {
      this.methodLinks = jQuery('a[data-method]');
      this.registerEvents();
    },

    registerEvents: function() {
      this.methodLinks.on('click', this.handleMethod);
    },

    handleMethod: function(e) {
      var link = jQuery(this);
      var httpMethod = link.data('method').toUpperCase();
      var form;
      // If the data-method attribute is not PUT or DELETE,
      // then we don't know what to do. Just ignore.
      if ( jQuery.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
        return;
      }

      // Allow user to optionally provide data-confirm="Are you sure?"
      if ( link.data('confirm') ) {
        if ( ! laravel.verifyConfirm(link) ) {
          return false;
        }
      }

      form = laravel.createForm(link);
      form.submit();

      e.preventDefault();
    },

    verifyConfirm: function(link) {
      return confirm(link.data('confirm'));
    },

    createForm: function(link) {
      var form =
      jQuery('<form>', {
        'method': 'POST',
        'action': link.attr('href')
      });

      var token;
      if ( link.data('csrf') ) {
          token=jQuery('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value':  link.data('csrf')
            });
      };

      var hiddenInput =
      jQuery('<input>', {
        'name': '_method',
        'type': 'hidden',
        'value': link.data('method')
      });

      return form.append(token, hiddenInput)
                 .appendTo('body');
    }
  };

  laravel.initialize();

})();

