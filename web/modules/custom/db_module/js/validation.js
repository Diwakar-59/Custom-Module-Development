(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.TaxonomyForm = {
    attach: function (context, settings) {
      var formContext = drupalSettings.db_module.formContext;

      // Log the form ID to console
      console.log('Form ID:', formContext.formId);
    }
  };
})(jQuery, Drupal, drupalSettings);
