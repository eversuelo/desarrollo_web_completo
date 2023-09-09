<?php include 'includes/header.php';
interface TransporteInterfaz{
    public function getInfo(): string;
    public function getRuedas(): int;
}

class Transporte implements TransporteInterfaz
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
    public function getRuedas():int
    {
        return $this->ruedas;
    }
}

include 'includes/footer.php';