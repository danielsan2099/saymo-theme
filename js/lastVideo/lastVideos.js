// Plugin que carga los ultimos videos del la lista de reproduccion del usuario

(function($){
	
	$.fn.lastVideos = function(options){
		
		contenedor = $(this);
		
		//Opciones por defaul
		$.fn.options_default = {
			//Altura del video
			height : 315,
			//Numero de videos a mostrar
			numVideos : 1,
			//Funcion a ejecutar despues de terminar de traer los videos
			onSuccess : function(){},
			//Nombre de usuario
			user : 'FOVISSSTE',
			//Ancho del video
			width : 560
		}
		
		defaults = $.extend($.fn.options_default, options); 
		 
		 
		//Cargar el XML de la lista de reproduccion
		getXML = function() {
			
			//url = 'http://gdata.youtube.com/feeds/api/users/'+ defaults.user +'?v=2&alt=json';
			//url = 'http://gdata.youtube.com/feeds/users/'+ defaults.user +'/uploads?alt=json&max-results=' + defaults.numVideos;
			script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'http://gdata.youtube.com/feeds/users/'+ defaults.user +'/uploads?alt=json-in-script&callback=loadVideos&max-results=' + defaults.numVideos;
			head = document.getElementsByTagName('head').item(0);
			head.appendChild(script);

			/*
			$.ajax({
				'url' : url,
				type : 'get',
				cache : false,
				
				dataType: 'json',
				success : function(data){
				  
				  if($.type(data) == 'string'){
					  	//Convertir en objeto
				   		data = JSON.parse(data);  
				  }
				  loadVideos(data);
			  },
			  error : function(){
				  	//Maldito IE
				  	IE = null;
				  
				  	if (window.XMLHttpRequest) {
						IE = new XMLHttpRequest();
					} else if (window.ActiveXObject) {
						try {
							IE = new ActiveXObject("Msxml2.XMLHTTP");
						} catch (e) {
							try {
								IE = new ActiveXObject("Microsoft.XMLHTTP");
							} catch (e) {
								IE = false;
							}
						}
					}
				  
					IE.onreadystatechange = function(){
						loadVIdeos(IE.responseText);
					}
					IE.open("GET", url, true);
					IE.send(null);
			  }
			});*/
			
		}
		 
		 //Mostrar los videos
		 loadVideos = function(data){
			 
			 var feed = data.feed;
			 var entries = feed.entry || [];
			  
			 if (entries.length > 0) {
				
				contenedor.html(''); 

				$(entries).each(function(ind,itm){
					contenedor.append("<a class='link_video' title='"+ itm.title.$t +"' src='"+ itm.link[0].href +"'>"+
										"<img  class='tumb' src='"+ itm.media$group.media$thumbnail[0].url +"' />"+
										"<br/><span>"+itm.title.$t+"</span>"+
									"</a>");
				 });
				 
				 //Activar eventos para los links 
				 $('.link_video').click(abrirReproductor);
				 
				 defaults.onSuccess(); 
			  }
		 }
		 
		 abrirReproductor = function(){
			id = $.urlParam('v',$(this).attr("src"));
			cerrarReproductor();
			createReproductor();
			$('.reproductor').center();
			$('.pantalla_negra').fadeIn();
			$('.reproductor').fadeIn('slow');
			$('#ply_video').attr("src","http://youtube.com/embed/"+id+"?autoplay=1");
		 }
		 
		 
		 cerrarReproductor = function(){
			$('.reproductor').fadeOut('slow').remove();
			$('.pantalla_negra').fadeOut('slow').remove(); 
		 }
		 
		 $.urlParam = function(name,url){
			var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(url);
			return results[1] || 0;
		  }
		 
		 
		 //Crear Reproductor
		 createReproductor = function(){
			 
			 	reproductor = document.createElement('div');
				$(reproductor).addClass('reproductor')
							  .css({
									'z-index' : 1001  
							   });
				
				cierre = document.createElement('div');
				$(cierre).click(cerrarReproductor)
				         .addClass('cierre')
						 .css({
							background : '#f00',
							border : '1px solid #fff',
							'border-radius' : '4px',
							color : '#fff',
							cursor : 'pointer',
							left : '100%',
							'margin-left' : -20,
							position : 'relative',
							'text-align' : 'center',
							width : '20'
					      })
						 .html('X');
				
				ply_video = document.createElement('iframe');
				$(ply_video).attr('id','ply_video')
				            .css({
								border : 'none',
								height : defaults.height,
								width : defaults.width
							});
				
				
				$(reproductor).append(cierre)
							  .append(ply_video)
							  .hide();

				blackScreen = document.createElement('div');
				$(blackScreen).addClass('pantalla_negra')
				              .css({
								  	background : '#000',
									height : window.outerHeight + window.innerHeight ,
									opacity : '0.9',
									position: 'fixed',
									top : 0,
									width : '100%',
									'z-index' : 1000
								})
							  .hide();
				
								
				$('body').append(reproductor)
				         .append(blackScreen);
		 }
		 
     	return this.each(function () {
        	  getXML();
        });
		
	}
	
	$.fn.center = function () {
		this.css("position","absolute");
		this.css("top", (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + "px");
		this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
		return this;
	}
	
})(jQuery);