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


  //tecla enter en el textarea de notas
  /*
  $('#observaciones').keypress(function(ev) {
    var keycode = (ev.keyCode ? ev.keyCode : ev.which);
    console.log(keycode);
    if(keycode == 13) {
      var valor=$('#observaciones').val();
        $('#observaciones').val(valor+"\n==========================");
    }
});
*/
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
          alert("Notas guardadas");
        }
        else{
          alert("Error: "+response);
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
    alert("Debe seleccionar un registro de la tabla servicios");
    pasa=false;
  }
  if(fecha_llegada=="" || fecha_llegada==null){
    alert("Debe ingresar una fecha de llegada");
    pasa=false;
  }
  if(hora_llegada=="" || hora_llegada==null){
    alert("Debe ingresar una hora de llegada");
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
          console.log(response);
          var arr=response.split("#");
          var chofer=arr[1];
          var grua=arr[2];
          var datos2={"chofer":chofer, "grua":grua};
          $.ajax({
            url:   'add_chofer_disponible.php',
            type:  'post',
            data: datos2,
            success:  function (response) {
              alert("Se ha recibido el servicio correctamente");
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
          alert("Error:"+response);
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
                           // console.log(response);
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
                   // console.log(response);
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
         $('#observaciones').html(response);
      }
    });
}


function inicia_tiempo() {
  //cada 10 segundos se refresca la pantalla de servicios para ver si hay cambios
  console.log(tiempo);
  if (tiempo == 0) {
    ver_servicios();
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
    alert("se agregará chofer");
    var datos={"chofer":chofer, "grua":grua};
  $.ajax({
    url:   'add_chofer_disponible.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      alert(response);
      $('#btn_cerrar_modal_1').click();
      ver_choferes_disponibles();
    }
  });
  }
  
});

$('#btn_borrar_chofer').click(function(){
  var chofer=$('#c_del_chofer').val();
  var datos={"chofer":chofer};
  $.ajax({
    url:   'del_chofer_disponible.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      alert(response);
      $('#btn_cerrar_modal_2').click();
      ver_choferes_disponibles();
    }
  });
});

$('#c_tipo_grua_2').change(function(){
  ver_chofer_siguiente();
});


function ver_chofer_siguiente(){
  var grua=$('#c_tipo_grua_2').val();
  var datos={"grua":grua};
  $.ajax({
    url:   'siguiente_chofer.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      console.log(response);
      if(response.includes("vacio")){
        alert("no hay choferes dsiponibles para ese tipo de grua");
        $('#txt_chofer_siguiente').val("");
      }
      else{
        $('#txt_chofer_siguiente').val(response);
      }
    }
  });
}
$('#btn_salida').click(function(){
  var grua=$('#c_tipo_grua_2').val();
  var chofer=$('#txt_chofer_siguiente').val();
  var destino=$('#area_destino').val();
  var folio=$('#txt_folio').val();
  if(chofer==""){
    alert("Debe de seleccionar un chofer");
  }
  else if(destino==""){
    alert("Debe ingresar un destino");
  }
  else if(folio==""){
    alert("Debe de ingresar un folio");
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
        console.log(response);
        if(response.includes("xito")){
          $('#area_destino').val("");
          $('#txt_folio').val("");
          $('#txt_chofer_siguiente').val("");
          ver_chofer_siguiente();
          alert("Se ha despachado el servicio "+folio);
          ver_choferes_disponibles();
          tiempo=1;
        }
        else if(response.includes("duplicado")){
          alert("El folio ya existe");
        }
      }
    });
  }
});



$('#btn_add_chofer_catalogo').click(function(e){
  e.preventDefault();
  if($('#txt_nombre').val()==""){
    alert("Debe ingresar un nombre");
  }
  else if($('#txt_phone').val()==""){
    alert("Debe ingresar un teléfono");
  }
  else{
    $.ajax({
      url:   'agregar_chofer_catalogo.php',
      type:  'post',
      data: $('#agregar_chofer_catalogo').serialize(),
      success:  function (response) {
        console.log(response);
        alert(response);
        $('#btn_cerrar_modal_3').click();
      }
    });
  } 
});

$('#btn_del_chofer_catalogo').click(function(){
  var chofer=$('#c_del_chofer_catalogo').val();
  var datos={"chofer":chofer};
    $.ajax({
      url:   'borrar_chofer_catalogo.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        alert(response);
        $('#btn_cerrar_modal_4').click();
      }
    });
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
        alert(response);
        $('#btn_cerrar_modal_5').click();
      }
    });
});

$('#menu_borrar_user').click(function(){
  $.ajax({
    url:   'c_usuarios.php',
    type:  'post',
    success:  function (response) {
      console.log(response);
      $('#c_usuarios').html(response);
    }
  });
  $("#modal_user_borrar").modal({
    fadeDuration: 100
  });
});

$('#btn_borrar_usuario').click(function(e){
  e.preventDefault();
  var nombre=$('#c_usuarios').val();
  var datos={
      "nombre": nombre,
  };
    $.ajax({
      url:   'borrar_usuario.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        alert(response);
        $('#btn_cerrar_modal_6').click();
      }
    });
});
/*
$('#btn_del_chofer').on('click', function(){
  alert("response");
});
*/

$('#btn_guardar_pass').on('click', function(e){
  var pass=$('#txt_nuevo_pass').val();
  if(pass=="" || pass==null){
    alert("Debes ingresar un valor válido");
  }
  else if(pass.length<4){
    alert("La contraseña debe contener mínimo 5 caracteres");
  }
  else if(pass=="gruas2021"){
    alert("La contraseña no puede ser la misma que la default");
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
        alert(response);
        $('#txt_nuevo_pass').val("");
        $('#btn_cerrar_modal').click();
      }
    });
  }  
});

$('#btn_especial').on('click', function(){
  alert("Mostrar tabla de multiples choferes ");
});

})(jQuery); // End of use strict
