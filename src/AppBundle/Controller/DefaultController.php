<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Peticion;
use AppBundle\Entity\Direccion;

class DefaultController extends Controller
{
    /**
     * @Route("/nuptic42", name="nuptic")
     */
    public function nuptic42Action(Request $request)
    {
        return $this->render('default/nuptic42.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/orval", name="orval")
     */
    public function orvalAction(Request $request)
    {
        $requestData = json_decode($request->getContent(), true);

        $direccion = new Direccion(
            $requestData['direccion']['norte'],
            $requestData['direccion']['sur'],
            $requestData['direccion']['este'],
            $requestData['direccion']['oeste']
        );

        try {
            $peticion = new Peticion(
                $requestData['id_simulador'],
                $requestData['num'],
                $direccion,
                $requestData['recorrido']
            );

            //persisting this request
            ////////////////////////////////////////////////////////////
            $em = $this->getDoctrine()->getManager();
            $em->persist($direccion);
            $em->persist($peticion);
            $em->flush();
            
            if ($direccion->getEste() > 0) {
                $logger = $this->get('logger');
                $logger->info($peticion);
            }

            //We store in redis num of request for the current date
            ////////////////////////////////////////////////////////////
            
            //just we need to know tomorow at 00:00:00 (to reset request's amount)
            $tomorowInit = \DateTime::createFromFormat('dmYHis', (date('d')+1) . date('mY') . "000000")->getTimestamp();

            $client = new \Predis\Client();
            //just contatenate dmY to key to store historical daily requests (without expire at)
            $client->incr('peticiones');
            $client->expireat('peticiones', $tomorowInit);
            $value = $client->get('peticiones');

            //prepare data to return
            ////////////////////////////////////////////////////////////
            $data = array(
                'idPeticion' => $peticion->getid(),
                'recorrido' => $peticion->getRecorrido(),
                'direccion' => array(
                    'norte' => $direccion->getNorte(),
                    'sur' => $direccion->getSur(),
                    'este' => $direccion->getEste(),
                    'oeste' => $direccion->getOeste()
                 )
            );

            return new JsonResponse($data);
        } catch (NumHaveToBeInteger $e) {
            return new Response(
                500
            );
        }
    }
}
