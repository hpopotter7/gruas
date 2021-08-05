(function($) {

  var tiempo=10;

  $(".time_element").timepicki({
		show_meridian:false,
		min_hour_value:0,
		max_hour_value:23,
		increase_direction:'up'});

  "use strict"; // Start of use strict
  $("body").toggleClass("sidebar-toggled");
  $(".sidebar").toggleClass("toggled");
  // Toggle the side navigation
  $("#sidebarToggle").on('click', function(e) {
    e.preventDefault();
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
  });

  ver_choferes_disponibles();

  $('#c_tipo_grua').change(function(){
    ver_choferes_disponibles();
  });

  function ver_choferes_disponibles(){
    var tipo_grua=$('#c_tipo_grua').val();
    var datos={"tipo_grua":tipo_grua}
    $.ajax({
      data: datos,
      url:   'ver_choferes_disponibles.php',
      type:  'post',
      success:  function (response) {
        $('#example2').html(response);
      }
    });

  }

//$('#div_servicios').hide();
$('#div_servicio_salida').hide();
$('#div_servicio_llegada').hide();

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });


$('#btn_guardar_notas').on("click",function(e) {
  guardar_notas();
});

function guardar_notas(){
  var notas=$('#observaciones').val();
    var datos={"notas":notas}
    $.ajax({
      data: datos,
      url:   'guardar_notas.php',
      type:  'post',
      success:  function (response) {
        if(response.includes("Exito")){
          Swal.fire("Éxito","Notas guardadas", "success");
        }
        else{
          Swal.fire("Oops",response, "warning");
        }
      }
    });
}

$('#btn_salida').click(function(){
  $('#div_servicio_salida').show();
  $('#div_servicio_llegada').hide();
});
$('#btn_llegada').click(function(){
  $('#div_servicio_salida').hide();
  $('#div_servicio_llegada').show();
  recibir_servicio();
});

function recibir_servicio(){
  var pasa=true;
  var folio=$('#txt_folio_llegada').val();
  var tipo=$('#inputc_tipo_servicio').val();
  var hora_llegada=$('#txt_hora_llegada').val();
  var fecha_llegada=$('#txt_fecha_llegada').val();
  if(folio=="" || $('#txt_chofer_llegada').val()=="" || $('#txt_tipo_grua_llegada').val()==""){
    Swal.fire("Oops","Debe seleccionar un registro de la tabla servicios", "warning");
    pasa=false;
  }
  else if(fecha_llegada=="" || fecha_llegada==null){
    Swal.fire("Oops","Debe ingresar una fecha de llegada", "warning");
    pasa=false;
  }
  if(hora_llegada=="" || hora_llegada==null){
    Swal.fire("Oops","Debe ingresar una hora de llegada", "warning");
    pasa=false;
  }
  if(pasa){
    var llegada=fecha_llegada+ " "+hora_llegada;
    var datos={"folio":folio,"tipo":tipo,"llegada":llegada};
    $.ajax({
      url:   'recibir_servicio.php',
      data: datos,
      type:  'post',
      success:  function (response) {
        if(response.includes("recibido exitoso")){
          
          var arr=response.split("#");
          var chofer=arr[1];
          var grua=arr[2];
          var datos2={"chofer":chofer, "grua":grua};
          $.ajax({
            url:   'add_chofer_disponible.php',
            type:  'post',
            data: datos2,
            success:  function (response) {
              Swal.fire("Éxito","Se ha recibido el servicio correctamente", "success");
              $('#btn_cerrar_modal_1').click();
              ver_choferes_disponibles();
              $('#txt_folio_llegada').val('');
              $('#txt_chofer_llegada').val('');
              $('#txt_tipo_grua_llegada').val('');
              $('#txt_fecha_llegada').val('');
              $('#txt_hora_llegada').val('');
              $('#txt_hora_llegada').timepicki({reset: true});
              $('#inputc_tipo_servicio').val('Normal');
              $('#tab_01').click();
            }
          });
          
        }
        else{
          Swal.fire("Oops","Error: "+response, "warning");
        }
      }
    });
  }
  
}


var $tabButtonItem = $('#tab-button li'),
      $tabSelect = $('#tab-select'),
      $tabla = $('#dataTable tbody tr'),
      $tabContents = $('.tab-contents'),
      activeClass = 'is-active';

  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(':first').hide();

  $tabButtonItem.find('a').on('click', function(e) {
    var target = $(this).attr('href');

    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on('change', function() {
    var target = $(this).val(),
        targetSelectNum = $(this).prop('selectedIndex');
    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });

  $tabla.on('click', function() {
    var target = '#tab02',
        targetSelectNum = 1;
    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });

  $('#btn_seleccion_chofer').on('click',function(){
    var chofer=$('#c_lista_choferes_disponibles').val();
    $('#txt_chofer_siguiente').val(chofer);
    $('.btn_modal').click();
  });

$('#btn_lock').click(function(e){
  e.preventDefault();
  $.confirm({
    title: 'Ingresa la contraseña',
    theme: 'supervan',
    content: 'url:form.html',
    closeAnimation: 'scale',
    closeIcon: true,
    escapeKey: 'cancelAction',
    buttons: {
        sayMyName: {
            text: 'Aceptar',
            btnClass: 'btn-orange',
            action: function(){
                var input = this.$content.find('input#input-name');
                var errorText = this.$content.find('.text-danger');
                if(!input.val().trim()){
                    $.alert({
                        title: 'Error',
                        content: "Debes ingresar una contraseña",
                        type: 'red'
                    });
                    return false;
                }else{
                    if(input.val()=="gruas2021"){
                      $.ajax({
                        url:   'choferes_disponibles_lista.php',
                        type:  'post',
                        success:  function (response) {
                           
                          $('#c_lista_choferes_disponibles').html(response);
                          $("#exampleModal_lista").modal({
                            fadeDuration: 100
                          });
                        }
                      });
                    }
                    else{
                      alert("Contraseña incorrecta");
                    }
                    //$.alert(+ input.val() + ', i hope you have a great day!');
                }
            }
        },
        /*
        later: function(){
            // do nothing.
        }
        */
    }
  });
});

$('#notas').mouseover(function(){
  $(this).css("right","0");
});

$('#notas').mouseleave(function(){
  $(this).css("right","-600px");
});

$('#btn_candado').click(function(){
  $.confirm({
    title: 'Ingresa la contraseña',
    theme: 'supervan',
    content: 'url:form.html',
    closeAnimation: 'scale',
    closeIcon: true,
    escapeKey: 'cancelAction',
    buttons: {
        sayMyName: {
            text: 'Aceptar',
            btnClass: 'btn-orange',
            action: function(){
                var input = this.$content.find('input#input-name');
                var errorText = this.$content.find('.text-danger');
                if(!input.val().trim()){
                    $.alert({
                        content: "Please don't keep the name field empty.",
                        type: 'red'
                    });
                    return false;
                }else{
                    $.alert('Hello ' + input.val() + ', i hope you have a great day!');
                }
            }
        },
    }
  });
});

ver_servicios();
    
    function ver_servicios(){
              $.ajax({
                url:   'ver_servicios.php',
                type:  'post',
                success:  function (response) {
                   
                  $('#servicios').html(response);
                }
              });
        }

        $('#servicios').delegate( '.datos','click',  function () {
          //oTables.rows().eq(0).each( function ( index ) {
           // var row = oTables.row( oTables.row( this ).index() );
            //var data = row.data();
            $('#tab01').hide();
            $('#tab02').show();
            $('#tab-select').val('#tab02');
            var id=$(this).attr("id");
            
            ver_servicios_folio(id);
      
          //} );
      } );

      function ver_servicios_folio(folio){
        $('#txt_folio_llegada').val(folio);
        var datos={
          "folio": folio,
        };
        $.ajax({
          url:   'ver_servicios_folio.php',
          type:  'post',
          data: datos,
          dataType: "json",
          success:  function (response) {
            
            if(response.error.includes("Error")){
              alert(response.error);
            }else{
             $('#txt_chofer_llegada').val(response.chofer);
             $('#txt_tipo_grua_llegada').val(response.grua);
             
            }
            
          }
        });
  }

  ver_observaciones();

  function ver_observaciones(){
        
    $.ajax({
      url:   'ver_observaciones.php',
      type:  'post',
      success:  function (response) {
         $('#observaciones').html(response.trim());
      }
    });
}


function inicia_tiempo() {
  //cada 3 segundos se refresca la pantalla de servicios para ver si hay cambios
  
  if (tiempo == 0) {
    ver_servicios();
    ver_choferes_disponibles();
    ver_observaciones();
    tiempo=3;
    inicia_tiempo();
  } 
  else {
    tiempo -= 1;
      setTimeout(inicia_tiempo, 1000);
  }
}


inicia_tiempo();

$('#btn_agregar_chofer').click(function(){
  combo_choferes_disponibles();
  $("#modal_agregar_chofer").modal({
    fadeDuration: 100
  });
});

$('#btn_del_chofer').click(function(){
  combo_choferes_disponibles_eliminar();
  $("#modal_eliminar_chofer").modal({
    fadeDuration: 100
  });
});

$('#menu_add_chofer_catalogo').click(function(){
  $("#modal_catalogo_add_chofer").modal({
    fadeDuration: 100
  });
});

$('#menu_del_chofer_catalogo').click(function(){
  $.ajax({
    url:   'ver_catalogo_choferes.php',
    type:  'post',
    success:  function (response) {
      console.log(response);
      $('#c_del_chofer_catalogo').html(response);
    }
  });
  $("#modal_catalogo_del_chofer").modal({
    fadeDuration: 100
  });
});



//combo_choferes_disponibles();//modal1
function combo_choferes_disponibles() {
  var grua=$('#c_tipo_grua').val();
  var datos={"grua":grua};
  $.ajax({
    url:   'c_choferes_disponibles.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      console.log(response);
      $('#c_add_chofer').html(response);
    }
  });
}



combo_choferes_disponibles_eliminar(); // modal2
function combo_choferes_disponibles_eliminar() {
  var grua=$('#c_tipo_grua').val();
  var datos={"grua":grua};
  $.ajax({
    url:   'c_choferes_disponibles_eliminar.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      console.log(response);
      $('#c_del_chofer').html(response);
    }
  });
}


$('#btn_add_chofer').click(function(){
  var chofer=$('#c_add_chofer').val();
  var grua=$('#c_tipo_grua').val();
  if(chofer==""){
    alert("Debe seleccionar a un chofer de la lista");
  }
  else{
    var datos={"chofer":chofer, "grua":grua};
  $.ajax({
    url:   'add_chofer_disponible.php',
    type:  'post',
    data: datos,
    success:  function (response) {;
      Swal.fire("Éxito","El chofer ha sido agregado", "success");
      $('#btn_cerrar_modal_1').click();
      ver_choferes_disponibles();
    }
  });
  }
  
});

$('#btn_borrar_chofer').on('click',function(){
  var chofer=$('#c_del_chofer').val();  
    var datos={"chofer":chofer};
    $.ajax({
      url:   'del_chofer_disponible.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        Swal.fire("Éxito","Chofer eliminado", "success");
        $('#btn_cerrar_modal_2').click();
        ver_choferes_disponibles();
      }
    });  
});

$('#c_tipo_grua_2').on('change',function(){
  ver_chofer_siguiente();
});


function ver_chofer_siguiente(){
  var grua=$('#c_tipo_grua_2').val();
  if(grua!=""){
    $('#txt_chofer_siguiente').val("");
    var datos={"grua":grua};
    $.ajax({
      url:   'siguiente_chofer.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        console.log(response);
        if(response.includes("vacio")){
          
          Swal.fire("Oops!","no hay choferes dsiponibles para ese tipo de grua","info");
          $('#txt_chofer_siguiente').val("");
          grua=$('#c_tipo_grua_2').val('');
        }
        else{
          $('#txt_chofer_siguiente').val(response);
        }
      }
    });
  }
  else{
    $('#txt_chofer_siguiente').val("");
  }
}
$('#btn_salida').click(function(){
  var grua=$('#c_tipo_grua_2').val();
  var chofer=$('#txt_chofer_siguiente').val();
  var destino=$('#area_destino').val();
  var folio=$('#txt_folio').val();
  if(grua==""){
    Swal.fire("Oops!","Debe de seleccionar un tipo de grua", "warning");
  }
  else if(chofer==""){
    Swal.fire("Oops!","El chofer no puede ir vacio", "warning");
  }
  else if(destino==""){
    alert("Debe ingresar un destino");
    Swal.fire("Oops!","Debe de ingresar un destino", "warning");
  }
  else if(folio==""){
    Swal.fire("Oops!","Debe de ingresar un folio", "warning");
  }
  else{
    var datos={
      "grua": grua,
      "chofer":chofer,
      "destino": destino,
      "folio": folio,
    };
    $.ajax({
      url:   'agregar_servicio.php',
      type:  'post',
      data: datos,
      success:  function (response) {        
        if(response.includes("xito")){
          $('#area_destino').val("");
          $('#txt_folio').val("");
          $('#txt_chofer_siguiente').val("");
          ver_chofer_siguiente();
          Swal.fire("Éxito","Se ha despachado el servicio "+folio, "success");
          $('#c_tipo_grua_2').val('');
          $('#txt_chofer_siguiente').val('');
          $('#area_destino').val('');
          $('#txt_folio').val('');
          tiempo=1;
        }
        else if(response.includes("duplicado")){
          Swal.fire("Oops","El folio <b>"+folio+"</b> ya existe", "warning");
        }
      }
    });
  }
});



$('#btn_add_chofer_catalogo').click(function(e){
  e.preventDefault();
  if($('#txt_nombre').val()==""){
    Swal.fire("Oops","Debe ingresar un nombre", "warning");
  }
  else if($('#txt_phone').val()==""){
    Swal.fire("Oops","Debe ingresar un teléfono", "warning");
  }
  else{
    $.ajax({
      url:   'agregar_chofer_catalogo.php',
      type:  'post',
      data: $('#agregar_chofer_catalogo').serialize(),
      success:  function (response) {
        if(response.includes("Exito")){
          $('#btn_cerrar_modal_3').click();
          Swal.fire("Éxito","El chofer ha sido agregado", "success");
        }
        else{
          Swal.fire("Oops",response, "warning");
        }                
      }
    });
  } 
});

$('#btn_del_chofer_catalogo').click(function(){
  var chofer=$('#c_del_chofer_catalogo option:selected').text();
  var id=$('#c_del_chofer_catalogo').val();
  var lista=$('#example2').html();
  var servicios=$('#dataTable').html();
  alert(chofer);
  alert(servicios);
  if(chofer=="Selecciona..."){
    Swal.fire("Oops","Debe seleccionar a un chofer de la lista", "warning");
  }
  else if(lista.includes(chofer)){
      Swal.fire("Oops!","El chofer "+chofer+" esta en la lista de choferes disponibles.\nDebe eliminarlo primero de la lista.","warning");
  }
  else if(servicios.includes(chofer)){
    Swal.fire("Oops!","El chofer "+chofer+" esta servicio.\nDebe recibir el servicio primero y eliminarlo de la lista de disponible.","warning");
}
  else{
  var datos={"id":id};
    $.ajax({
      url:   'borrar_chofer_catalogo.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        if(response.includes("Exito")){
          $('#btn_cerrar_modal_4').click();
          Swal.fire("Éxito","El chofer ha sido eliminado", "success");
        }
        else{
          Swal.fire("Oops",response, "warning");
        }  
        
      }
    } );
  }
});


$('#menu_add_user').click(function(){
  $("#modal_user_add").modal({
    fadeDuration: 100
  });
});


$('#btn_add_user').on("click",function(e){
  e.preventDefault();
    $.ajax({
      url:   'agregar_usuario.php',
      type:  'post',
      data: $('#form_agregar_usuario').serialize(),
      success:  function (response) {
        if(response.includes("xito")){
          $('#btn_cerrar_modal_5').click();
          Swal.fire("Éxito","Usuario creado", "success");
        }
        else{
          Swal.fire("Oppr","Error: "+response, "warning");
        }
        
      }
    });
});

$('#menu_borrar_user').click(function(){
  $.ajax({
    url:   'c_usuarios.php',
    type:  'post',
    success:  function (response) {
      $('#c_usuarios').html(response);
    }
  });
  $("#modal_user_borrar").modal({
    fadeDuration: 100
  });
});

$('#btn_borrar_usuario').click(function(e){
  e.preventDefault();
  var id=$('#c_usuarios').val();
  var datos={
      "id": id,
  };
    $.ajax({
      url:   'borrar_usuario.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        if(response.includes("xito")){
          $('#btn_cerrar_modal_6').click();
          Swal.fire("Éxito","Usuario eliminado", "success");
        }
        else{
          Swal.fire("Oppr","Error: "+response, "warning");
        }
        
      }
    });
});

$('#btn_guardar_pass').on('click', function(e){
  var pass=$('#txt_nuevo_pass').val();
  if(pass=="" || pass==null){
    Swal.fire("Opps","Debes ingresar un valor válido", "warning");
  }
  else if(pass.length<4){
    Swal.fire("Opps","La contraseña debe contener mínimo 5 caracteres", "warning");
  }
  else if(pass=="gruas2021"){
    
  }
  else{
    var datos={
      "pass": pass,
  };
    $.ajax({
      url:   'actualizar_pass.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        if(response.includes("Error")){
          Swal.fire("Opps","Error: "+response, "warning");
        }
        else{
          $('#txt_nuevo_pass').val("");
          $('#btn_cerrar_modal').click();
          Swal.fire("Éxito","La contraseña ha sido actualizada", "success");
        }
        
      }
    });
  }  
});

$('#btn_especial').on('click', function(){
  alert("Mostrar tabla de multiples choferes ");
});

})(jQuery); // End of use strict
