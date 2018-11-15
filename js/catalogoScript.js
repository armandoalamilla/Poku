$(document).ready(function(){
var action = "fetch";
  $.ajax({
   url:"data/catalogoService.php",
   method:"POST",
   data:{action:action},
   success:function(data)
   {
    $('#catalogo_data').html(data);
   }
  });


});