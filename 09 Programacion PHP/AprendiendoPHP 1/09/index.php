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
                // versiones anteriores
                $tecnologias = ['CSS', 'HTML', 'JavaScript', 'jQuery'];
                echo $tecnologias[0] . "<hr>";
                echo $tecnologias[1] . "<hr>";
                echo $tecnologias[2] . "<hr>";
                echo $tecnologias[3] . "<hr>";
                
                $lenguajes = array('CSS', 'jQuery', 'PHP', 'MySQL');
                echo  "El Lenguaje" . $lenguajes[3];
            ?>
              
        </div>
    </div>




  </body>
</html>
