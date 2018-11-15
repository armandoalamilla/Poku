$(document).ready(function(){
 
 fetch_data();

 function fetch_data()
 {
  var action = "fetch";
  $.ajax({
   url:"data/imagenService.php",
   method:"POST",
   data:{action:action},
   success:function(data)
   {
    $('#image_data').html(data);
   }
  })
 }
 $('#add').click(function(){
  $('#imageModal').modal('show');
  $('#image_form')[0].reset();
  $('.modal-title').text("Add Image");
  $('#image_id').val('');
  $('#action').val('insert');
  $('#insert').val("Insert");
 });
 $('#image_form').submit(function(event){
  event.preventDefault();
  var image_name = $('#image').val();
  var titulo = $('#titulo').val();
  var precio = $('#precio').val();
  var descripcion = $('#descripcion').val();
  var tipo = $('input[name=tipo]:checked','#image_form').val();
  if(image_name == '' && titulo == '' && precio == '' && descripcion == '')
  {
   alert("Por favor llena los campos");
   return false;
  }
  else
  {
   var extension = $('#image').val().split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1 && image_name != '')
   {
    alert("Formato del archivo invalido");
    $('#image').val('input[name=tipo]:checked','#');
    return false;
   }
   else
   {
    $.ajax({
     url:"data/imagenService.php",
     method:"POST",
     data:new FormData(this),
     contentType:false,
     processData:false,
     success:function(data)
     {
      
      fetch_data();
      $('#image_form')[0].reset();
      $('#imageModal').modal('hide');
     }
    });
   }
  }
 });
 $(document).on('click', '.update', function(){
  $('#image_id').val($(this).attr("id"));
  $('#action').val("update");
  $('.modal-title').text("Update Image");
  $('#insert').val("Update");
  $('#imageModal').modal("show");
 });
 $(document).on('click', '.delete', function(){
  var image_id = $(this).attr("id");
  var tipoClass = $(this).attr("class")
  var action = "delete";
  if(confirm("Estas seguro que quieres eliminar este producto?"))
  {
   $.ajax({
    url:"data/imagenService.php",
    method:"POST",
    data:{image_id:image_id,tipoClass:tipoClass, action:action},
    success:function(data)
    {
     fetch_data();
     location.reload();
    }
   })
  }
  else
  {
   return false;
  }
 });
});  