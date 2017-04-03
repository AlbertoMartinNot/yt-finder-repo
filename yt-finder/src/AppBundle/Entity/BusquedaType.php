<?php  
namespace AppBundle\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BusquedaType extends AbstractType{

	public function buildForm(FormBuilderInterface $builder,array $options){

		$builder
		->add('palabra',TextType::class,array('label'=>' ','attr'=>array('placeholder'=>'Introduce una palabra...',)))
		->add('send',SubmitType::class,array('label'=>'Buscar en YouTube'))
		;

	}

	public function getName(){

		return 'busqueda';

	}

}















?>