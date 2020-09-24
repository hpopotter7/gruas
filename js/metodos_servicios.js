function inicio(){

    ver_servicios();
    
    function ver_servicios(){
              $.ajax({
                
                url:   'ver_servicios.php',
                type:  'post',
                success:  function (response) {
                    //console.log(response);
                  $('#servicios').html(response);
                }
              });
        }
}