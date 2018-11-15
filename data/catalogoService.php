<?php

 include ("conexion.php");
 if($_POST["action"] == "fetch")
 {
  $query = "SELECT * FROM skincare ORDER BY id DESC";
  $result = mysqli_query($conn, $query);
  $output = '';
  while($row = mysqli_fetch_assoc($result))
  {
   $output .= '
        <figure class="effect-oscar  wowload fadeInUp">
        <img src="data/portafolioDB/'.$row["titulo"].'.png" class="img-responsive" alt="">
        <figcaption>
            <h1><p>Skincare<br></h1> 
            <h3><p>'.$row["titulo"].'<br></h3>
            <p>'.$row["descripcion"].'<br>
            <h2><p>$'.$row["precio"].'<br></h2>
            <p><a class="btn btn-success btn-buy" href="#" data-gallery>BUY</a></p>            
        </figcaption>
    </figure>
    
   ';
  
  }
  
  $query = "SELECT * FROM makeup ORDER BY id DESC";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
   $output .= '
        <figure class="effect-oscar  wowload fadeInUp">
        <img src="data/portafolioDB/'.$row["titulo"].'.png" class="img-responsive" alt="">
        <figcaption>
            <h1><p>Makeup<br></h1>
            <h3><p>'.$row["titulo"].'<br></h3>
            <p>'.$row["descripcion"].'<br>
            <h2><p>$'.$row["precio"].'<br></h2>
            <p><a class="btn btn-success btn-buy" href="#" data-gallery>BUY</a></p>              
        </figcaption>
    </figure>
    
   ';
  
  }
  
  echo $output; 
}
?>