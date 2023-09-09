<?php

use App\Vendedor;
?>
<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre vendedor" value="<?php echo $vendedor->nombre ?>">
    <label for="apellido">apellido</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="apellido vendedor" value="<?php echo $vendedor->apellido ?>">
    <label for="telefono">telefono</label>
    <input type="text" name="vendedor[telefono]" id="telefono" placeholder="telefono vendedor" value="<?php echo $vendedor->telefono ?>">

</fieldset>