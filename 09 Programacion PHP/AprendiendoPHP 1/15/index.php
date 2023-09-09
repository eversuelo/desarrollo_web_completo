<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Aprendiendo PHP</title>
    <link href="https://fonts.googleapis.com/css?family=Proza+Libre" rel="stylesheet">

    <link rel="stylesheet" href="css/estilos.css" media="screen" title="no title">
  </head>
  <body>

    <div class="contenedor">
      <h1>Aprendiendo PHP</h1>

        <div class="contenido">
                <?php 
                        $tecnologias = array('CSS', 'HTML', 'JavaScript', 'jQuery','Python');
                 ?>
                 
                 <h2>Lenguajes que Conozco</h2>
                 <ul>
                   <?php 
                   //Para Recorrer un Arreglo
                   foreach($tecnologias as $tecnologia): ?>
                        <li><?php echo $tecnologia; ?></li>  
                   <?php endforeach; ?>
                 </ul>
                 
                 
                 <?php 
                     $persona = array(
                         'nombre' => 'Juan',
                         'pais' => 'Mexico',
                         'profesion' => 'Desarrollador Web'
                     );
                  ?>
                  <h2>Datos Personales</h2>
                  <ul>
                        <?php 
                        // Otra Forma de Iterar  sobre un Array Asociativo
                        foreach($persona as $key => $val ){ ?>
                          
                              <li><?php echo $key . ': ' . $val ?></li>
                          
                          
                        <?php } ?>
                    
                    
                  </ul>
                  
    
        </div>
    </div>




  </body>
</html>
