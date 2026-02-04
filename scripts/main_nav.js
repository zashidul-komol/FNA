function initMainNav() {
  jQuery('#main_nav ul').hide();
  //$('#main_nav ul:first').show();
  jQuery('#main_nav li a').click(
    function() {
		
      var checkElement = jQuery(this).next();
      if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        return false;
        }
      if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        jQuery('#main_nav ul:visible').slideUp('normal');
        checkElement.slideDown('normal');
        return false;
        }
      }
    );
  }
jQuery(document).ready(function() {initMainNav();});