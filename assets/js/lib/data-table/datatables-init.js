(function ($) {
    //    "use strict";

    $('#tabla-categorias', '#tabla-empresas', '#tabla_usuarios', '#tabla_videos', '#tabla_documentos', '#tabla_valoraciones').DataTable({
	    lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "Todo"]],
	    select: true,
	    responsive: true
  	});
    
})(jQuery);