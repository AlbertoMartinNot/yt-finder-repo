<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Busqueda;
use AppBundle\Entity\BusquedaType;


class finderController extends Controller
{
    

     
    public function buscarAction(Request $request)
    {

      $busqueda= new Busqueda();
      $form=$this->createForm(BusquedaType::class,$busqueda);
      $form->handleRequest($request);   
      

      if($form->isValid()){

         $DEVELOPER_KEY = 'AIzaSyBumF7-YzvIocU9NKT7L1eO4RC0qM9tac8';
         $client = new \Google_Client();
         $client->setDeveloperKey($DEVELOPER_KEY);
         $youtube = new \Google_Service_YouTube($client);

         $searchResponse = $youtube->search->listSearch('id,snippet', array(
        'q' =>$busqueda-> getPalabra(),
        'maxResults' => 10,
         ));

         

         $videos = array();
         $channels = array();
        

         foreach ($searchResponse['items'] as $searchResult) {
          
             switch ($searchResult['id']['kind']) {
                case 'youtube#video':
                    $videos[]= array("title" => $searchResult['snippet']['title'],"thumbnail"=>$searchResult['snippet']['thumbnails']['default']['url'],"description"=>$searchResult['snippet']['description'],"date"=>$searchResult['snippet']['publishedAt'],"canal"=>$searchResult['snippet']['channelTitle'],);
                break;
                case 'youtube#channel':
                    $channels[]= array("title" => $searchResult['snippet']['title'],);
                break;
                   
               
                    
             }

         }


        


         return $this->render('list.html.twig',array(
            'youtube_videos'=>$videos,
            'youtube_channels'=>$channels,
        



           ));



      }

      return $this->render('buscar.html.twig',array('formu'=> $form->createView(),));
    }

}
