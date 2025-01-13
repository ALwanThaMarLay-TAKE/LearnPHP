<?php
class Animal
{
    private $name;
    protected $species;
    public function __construct($species)
    {

        $this->species = $species;
    }
    public function run()
    {
        echo "$this->name is running...";
    }
}

class Dog extends Animal
{
    public function bark()
    {
        echo "wolf worf";
        echo $this->species; //work cause $species is protected and access for sub class
        //!  echo $this->name is barking //this will error cause of $name is private
    }
}
$bobby = new Dog("Bobby");
$bobby->run(); // Bobby is running...
$bobby->bark(); // Woof.. woof
//PHP not allow myltiple inheritance like 
//class Pussy extends Animal , Cat {  }




//overwrite

class Cat extends Animal
{
    public $color, $age;
    public  function __construct($color, $species)
    {
        parent::__construct($species);
        $this->color = $color;
    }
    public function profile()
    {
        echo "  $this->species is only available in Myanamar";
    }
}


//* final syntax
class People
{
    final public function work()
    {
        echo "people is working";
    }
}
class Man
{
    public function work()
    {
        echo " man is working";
    } //! error causer parent class use " final "
}

final class worker
{
    public function work()
    {
        echo "working ";
    }
}

class StoreKeeper extends worker
{ //! error cause final class is not allow interitance class
    public function go()
    {
        echo "go";
    }
}

abstract class Dancer
{
    public abstract function dance();
    public function perform()
    {
        echo "performance";
    }
}

class Disco extends  Dancer
{
    //* dance function must write cause parent class use abstract for dance function
    public function dance()
    {
        echo "Dancing";
    }
}

//interface
interface Singer
{
    public function sing();
}
interface Dancing
{
    public function dance();
}
class Rapper implements Singer
{
    public function  sing() //* if not create sing fun  , error will occur cuase interface have sing function
    {
        echo "rapping";
    }
}

function perform(Singer $obj)
{ //obj that implement Singer interface
    $obj->sing();
}
perform(new Rapper);


//multiple inheritace with interface

class Kpop implements Singer, Dancing
{ //* sing and dance must be write cause of implement of interface Singer and Dancing
    public function sing()
    {
        echo "sing";
    }
    public function dance()
    {
        echo "dance";
    }
}

//Traits

trait  Math
{
    public function add($a, $b)
    {
        echo $a + $b;
    }
}
trait Area
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
    use Math, Area; // calculaor now can use function of math and area 
}

$clac = new Calculator;
$calc->add(1, 2); // 3
$calc->circle(5); //78.5
$calc->getPI();


//Default constant
Calculator::class; // give you namespace of Calculator class


// Encapsulation is also called information hiding
//Inheritance is also called Composition ( using like Abstract and inheritance using extend)
//Polymorphism is also called Subtyping (working together similar obj using inerface )