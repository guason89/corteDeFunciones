<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token"> 
****************************************
alertify.confirm('NECESITA CONFIRMACIÓN',"desea contunuar?",
      function(){ 
        var tk = $("#token").val();
        $.ajax({
          data:{_token:tk,valores:values},
          url:   "{{route('route.route')}}",
          type:  'post',
         
          beforeSend: function() {
              $('body').modalmanager('loading');
          },
          success:  function (response){
                  $('body').modalmanager('loading');
                  //console.log(response);
                  if(response.status==200){
                    alertify.alert("Mensaje de Sistema","<strong><p class='text-justify'>Información  registrada de forma exitosa!</p></strong>",function(){
                      //var obj =  JSON.parse(response);
                      table.ajax.reload();
                    });
                    
                  }else{                     
                    //console.log(response);
                    alertify.alert("Mensaje de Sistema","<strong><p class='text-warning text-justify'>ADVERTENCIA:"+ response.message +"</p></strong>")
                  }
                },
          error: function(jqXHR, textStatus, errorThrown) {
              $('body').modalmanager('loading');
              alertify.alert("Mensaje de Sistema","<strong><p class='text-danger text-justify'>ERROR: No se pudo registrar la información!</p></strong>");
                    console.log("Error en peticion AJAX!");  
                }
        });
      },
      function(){
        alertify.error('Acción cancelada');    
      }
    );