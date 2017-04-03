<?php
namespace AppBundle\Entity;

class Busqueda{

private $palabra;

public function setPalabra($palabra){

$this->palabra=$palabra;

}
public function getPalabra(){

return $this->palabra;

}


}

  ?>