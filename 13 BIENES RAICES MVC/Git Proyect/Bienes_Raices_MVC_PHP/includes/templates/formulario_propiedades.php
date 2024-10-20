<?php

use App\Propiedad;
?>
<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo</label>
    <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $propiedad->titulo ?>">

    <label for="precio">Precio</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio Propiedad" min="1" max="100000000" value="<?php echo s($propiedad->precio) ?>">

    <label for="imagen">Imagen</label>
    <input name="propiedad[imagen]" type="file" id="imagen" accept="image/jpeg, image/png">
    <?php if ($propiedad->imagen) : ?>
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">descripcion</label>
    <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10" style="resize:none"><?php echo s($propiedad->descripcion) ?></textarea>

</fieldset>
<fieldset>
    <legend>Informacion de Propiedad</legend>
    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3 Habitaciones" min="1" max="100" value="<?php echo s($propiedad->habitaciones) ?>">
    <label for="wc">Baños:</label>
    <input type="number" id="wc" placeholder="Ej: 3 baños" name="propiedad[wc]" min="1" max="100" value="<?php echo s($propiedad->wc) ?>">
    <label for="estacionamiento:">Estacionamiento::</label>
    <input type="number" id="estacionamiento:" value="<?php echo ($propiedad->estacionamiento) ?>" name="propiedad[estacionamiento]" placeholder="Ej: 3 estacionamiento:" min="1" max="100">
</fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name=propiedad[vendedorId]" id="vendedor">
        <?php foreach ($vendedores as $vendedor) { ?>
            <option
            <?php echo $propiedad->vendedorId===$vendedor->id ?'selected':'' ?>    
            value="<?php echo s($vendedor->id);?>"><?php echo  s($vendedor->nombre). " ".s($vendedor->apellido);?></option>
        <?php } ?>
    </select>
</fieldset>