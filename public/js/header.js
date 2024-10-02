$(document).ready(function() {
    $(".user-menu").click(function() {
      $(this).find(".user-options").toggle();
    });
  
    $(document).on('click', function(event) {
      var userMenu = $('.user-menu');
      var userOptions = userMenu.find('.user-options');
      
      // Comprobar si el clic fue fuera del menú desplegable o en el icono de usuario
      if (!userMenu.is(event.target) && userMenu.has(event.target).length === 0 &&
          !userOptions.is(event.target) && userOptions.has(event.target).length === 0) {
        userOptions.hide();
      }
    });
  });
  