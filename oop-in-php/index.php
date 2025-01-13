<?php trait Area
{
    private $PI = 3.14;
    const pi = 3.14;
    public function circle($r)
    {
        echo $this->PI * $r * $r;
    }
    public function getPI()
    {
        echo static::pi;
    }
}
class Calculator
{
    const radius = 3; // constant are static member 
    use Area; // calculaor now can use function of math and area 
}

$calc = new Calculator;

$calc->circle(5); //78.5
$calc->getPI();
echo Calculator::class; 