<?php

use Transporte as GlobalTransporte;

include 'includes/header.php';
abstract class Transporte
{

    protected int $ruedas;
    protected int $capacidad;
    public function __construct(int $ruedas, int $capacidad)
    {
        $this->ruedas = $ruedas;
        $this->capacidad = $capacidad;
    }
    public function getInfo(): string
    {
        return "El transporte tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas";
    }
    public function getRuedas()
    {
        return $this->ruedas;
    }
}
class Bicicleta extends Transporte
{
    public function getInfo(): string
    {
        return "El transporte tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas, y NO GASTA GASOLINA";
    }
}

class Automovil extends Transporte
{
    protected string $transmision;
    public function __construct(int $ruedas, int $capacidad, string $transmision)
    {
        $this->ruedas = $ruedas;
        $this->capacidad = $capacidad;
        $this->transmision = $transmision;
       
    }
    public function getTransmision():string
    {
        return $this->transmision;
    }
}
// $transpote=new Transporte(5,1);
// echo $transpote->getInfo();
// echo "<hr>";
$bicicleta = new Bicicleta(2, 1);
echo $bicicleta->getInfo();

echo "<hr>";
$automovil = new Automovil(4, 5,"Estandar");
echo $automovil->getInfo();


include 'includes/footer.php';
