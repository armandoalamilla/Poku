<?php
//action.php
if(isset($_POST["action"]))
{
 include ("conexion.php");
 if($_POST["action"] == "fetch")
 {
  $query = "SELECT * FROM skincare ORDER BY id DESC";
  $result = mysqli_query($conn, $query);
  $output = '
   <table class="table table-bordered table-striped" style="color:black;">  
    <tr>
     <th width="5%">Tipo</th>
     <th width="15%">Nombre</th>
     <th width="10%">Imagen</th>
     <th width="5%">Precio</th>
     <th width="25%">Descripcion</th>
     <th width="10%">Modificar</th>
     <th width="10%">Elimninar</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '

    <tr>
     <td>Skincare</td>
     <td>'.$row["titulo"].'</td>
     <td>
      <img src="data/portafolioDB/'.$row["titulo"].'.png" height="60" width="75" class="img-thumbnail" />
     </td>
     <td>$'.$row["precio"].'</td>
     <td>'.$row["descripcion"].'</td>
     <td><button type="button" name="update" class="btn btn-warning bt-xs update skincare" id="'.$row["id"].'">Modificar</button></td>
     <td><button type="button" name="delete" class="btn btn-danger bt-xs delete skincare" id="'.$row["id"].'">Eliminar</button></td>
    </tr>
   ';
  }
  
  $query = "SELECT * FROM makeup ORDER BY id DESC";
  $result = mysqli_query($conn, $query);
   while($row = mysqli_fetch_array($result))
  {
   $output .= '

    <tr>
     <td>Makeup</td>
     <td>'.$row["titulo"].'</td>
     <td>
      <img src="data/portafolioDB/'.$row["titulo"].'.png" height="60" width="75" class="img-thumbnail" />
     </td>
     <td>$'.$row["precio"].'</td>
     <td>'.$row["descripcion"].'</td>
     <td><button type="button" name="update" class="btn btn-warning bt-xs update makeup" id="'.$row["id"].'">Modificar</button></td>
     <td><button type="button" name="delete" class="btn btn-danger bt-xs delete makeup" id="'.$row["id"].'">Eliminar</button></td>
    </tr>
   ';
  }
  
  $output .= '</table>';
  echo $output;
 }

 if($_POST["action"] == "insert")
 {
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $titulo = $_POST['titulo'];
  $precio = $_POST['precio'];
  $descripcion = $_POST['descripcion'];
  $tipo = $_POST['tipo'];
  if($tipo=="skincare"){
       $query = "INSERT INTO skincare(titulo,descripcion,precio) VALUES ('$titulo','$descripcion','$precio')";
       if(mysqli_query($conn, $query))
       {
            $target_dir = "portafolioDB/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            
            // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            echo 'Se subio correctamente el producto';
       }
  }
  else{
      $query = "INSERT INTO makeup(titulo,descripcion,precio) VALUES ('$titulo','$descripcion','$precio')";
      if(mysqli_query($conn, $query))
      {
            $target_dir = "portafolioDB/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            
            // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            echo 'Se subio correctamente el producto';
      }
  }
 
 }
 if($_POST["action"] == "update")
 {
  $file = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
  $titulo = $_POST['titulo'];
  $precio = $_POST['precio'];
  $descripcion = $_POST['descripcion'];
  $tipo = $_POST['tipo'];
  if($tipo=="skincare"){
      if($file != ''){
        $target_dir = "portafolioDB/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            
            // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                unlink($target_file);
                $uploadOk = 1;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
      }
      if($titulo != ''){
        $query = "UPDATE skincare SET titulo = '$titulo' WHERE id = '".$_POST["image_id"]."'";
        if(mysqli_query($conn, $query))
          {
            //echo 'Se modifico correctamente el producto';
          }
      }
      if($precio != ''){
        $query = "UPDATE skincare SET precio = '$precio' WHERE id = '".$_POST["image_id"]."'";
        if(mysqli_query($conn, $query))
          {
            //echo 'Se modifico correctamente el producto';
          }
      }
      if($descripcion != ''){
        $query = "UPDATE skincare SET descripcion = '$descripcion' WHERE id = '".$_POST["image_id"]."'";
        if(mysqli_query($conn, $query))
          {
            //echo 'Se modifico correctamente el producto';
          }
      }
  }
  else{
        if($file != ''){
    
        $target_dir = "portafolioDB/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            
            // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                unlink($target_file);
                $uploadOk = 1;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
      
  }
  if($titulo != ''){
    $query = "UPDATE makeup SET titulo = '$titulo' WHERE id = '".$_POST["image_id"]."'";
    if(mysqli_query($conn, $query))
      {
        //echo 'Se modifico correctamente el producto';
      }
  }
  if($precio != ''){
    $query = "UPDATE makeup SET precio = '$precio' WHERE id = '".$_POST["image_id"]."'";
    if(mysqli_query($conn, $query))
      {
        //echo 'Se modifico correctamente el producto';
      }
  }
  if($descripcion != ''){
    $query = "UPDATE makeup SET descripcion = '$descripcion' WHERE id = '".$_POST["image_id"]."'";
    if(mysqli_query($conn, $query))
      {
        //echo 'Se modifico correctamente el producto';
      }
  }
  header("Refresh:0");
  }

  
 }
 
 $tipoClass = $_POST['tipoClass']; 
 
 if($_POST["action"] == "delete" && $tipoClass=="btn btn-danger bt-xs delete skincare")
 {
  $query = "DELETE FROM skincare WHERE id = '".$_POST["image_id"]."'";
  if(mysqli_query($conn, $query))
  {
   //echo 'Se elimino correctamente el producto';
  }
 }
 
 if($_POST["action"] == "delete" && $tipoClass=="btn btn-danger bt-xs delete makeup")
 {
  $query = "DELETE FROM makeup WHERE id = '".$_POST["image_id"]."'";
  if(mysqli_query($conn, $query))
  {
   //echo 'Se elimino correctamente el producto';
  }
 }
}
?>