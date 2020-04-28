<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CatchTheCart extends AbstractController
{
    /**
     * @Route("/catchTheCart", name="catch2") methods={"GET","POST"}
     */
    public function index()
    {
        $request = Request::createFromGlobals();

        // catch the variables we sent from the JavaScript.
        $placedby = $request->request->get('placedby', 'this is the default');

        $address = $request->request->get('address', 'this is the default');

        $ser = $request->request->get('ser', 'this is the default');

        $orderPrice = $request->request->get('orderPrice', '0');

        $status = $request->request->get('status', 'this is the default');


        /*
        foreach($data as $record) {


            $item = explode('-',$record);
            echo 'Item: ' . $item[0] . '<br>';
            echo 'Qty: ' . $item[1] . '<br>';

        }
        */


        // to work the objects
        $entityManager = $this->getDoctrine()->getManager();

        // create blank entity of type "Orders"
        $order = new Orders();

        $order->setPlacedBy($placedby);

        $order->setAddress($address);

        $order->setOrdered(substr($ser, 0, -1));

        $order->setOrderPrice($orderPrice);

        $order->setStatus($status);



        $entityManager->persist($order);


        $entityManager->flush();





        return new Response(
            'all ok ' . $ser
        );




    }
}
