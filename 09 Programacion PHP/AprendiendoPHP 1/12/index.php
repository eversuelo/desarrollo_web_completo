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
                $persona = array(
                    'nombre' => 'Juan',
                    'pais' => 'Mexico',
                    'profesion' => 'Desarrollador Web'
                );
             ?>
            <pre>
               <?php print_r($persona); ?>
             </pre>

            <?
             /*En un Array Asociativo no se puede acceder
             *por posiciones como en un array normal, es decir, no aplica
             * $persona[0]; es una manera invalida*/
             echo $persona['profesion'];
             ?>

            <pre>
               <?php 
               /* array_values y array keys ponen el array como un 
               *arreglo indexado */
               print_r(array_values( $persona ) ); ?>
             </pre>

            <pre>
               <?php print_r( array_keys( $persona ) ); ?>
             </pre>

        </div>
    </div>




</body>

</html>