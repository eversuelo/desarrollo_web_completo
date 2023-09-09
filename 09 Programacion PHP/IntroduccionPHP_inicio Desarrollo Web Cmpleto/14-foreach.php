<?php include 'includes/header.php';

$productos = [
    [
        'nombre' => 'Tablet',
        'precio' => 200,
        'disponible' => true
    ], [
        'nombre' => 'Audifonos',
        'precio' => 180,
        'disponible' => true
    ],
    [
        'nombre' => 'Television 24',
        'precio' => 300,
        'disponible' => false
    ]
];
foreach ($productos as $producto) { ?>
    <li>
        <p>Producto: <?php echo $producto['nombre']; ?> </p>
        <p>Precio:<?php echo "$ " . $producto['precio']; ?> </p>
        <?php
        if ($producto['disponible']) {
            echo "<p> Disponible</p>";
        } else {
            echo "<p> Agotado</p>";
        }
        ?>

    </li>
<?php
}


include 'includes/footer.php';
