<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\Adverts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;


/**
 * Advert controller.
 *
 */
class AdvertsController extends Controller
{
    /**
     * Lists all advert entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('DefaultBundle:Adverts')->findAll();
        $arr=[];
        foreach ($adverts as $advert){//---------сделать метод serialize!!!!!!!!
            $ar = [
                'title' => $advert->getTitle(),
                'adress' => $advert->getAdress(),
                'roomCount' => $advert->getRoomCount(),
                'district' => $advert->getDistrict(),
                'description' => $advert->getDiscription(),
                'floor' => $advert->getFloor(),
                'pricePerMonth' => $advert->getPricePerMonth(),
                'endDateOfAuction' => $advert->getEndDateOfAuction()->format('d.m.Y'),
                'dateOfRenting' => $advert->getDateOfRenting()->format('d.m.Y')

            ];
           array_push($arr,json_encode($ar, true));
        }
print_r($arr);

        $response = new JsonResponse($arr);
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    /**
     * Creates a new advert entity.
     *
     */

    public function newAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $advert = new Adverts();
        $user = $this->getUser();
        $advert->setUserId(1);//------------------- ид юзера??
        $advert->setAdress($data['adress']);
        $advert->setFloor($data['floor']);
        $advert->setDistrict($data['district']);
        $advert->setDiscription($data['description']);
        $advert->setTitle($data['title']);
        $advert->setRoomCount($data['roomCount']);
        $advert->setPricePerMonth($data['pricePerMonth']);
        if (isset($data['endDateOfAuction'])) {
            $data['endDateOfAuction'] = new \DateTime($data['endDateOfAuction']);
            $advert->setEndDateOfAuction($data['endDateOfAuction']);
        }
        if (isset($data['dateOfRenting'])) {
            $data['dateOfRenting'] = new \DateTime($data['dateOfRenting']);
            $advert->setDateOfRenting($data['dateOfRenting']);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush();

        $resp = new Response("ok");//-----------------------респонс со стасум выполнения----добавить валидацию и вывод ошибки------
        return $resp;
    }

    /**
     * Finds and displays a advert entity.
     *
     */
    public function showAction(Adverts $advert)
    {
//        $deleteForm = $this->createDeleteForm($advert);
//        $serializer = $this->get('api.json_serializer');
//      $obj=  $serializer->serialize($advert);
        $ar = [
            'title' => $advert->getTitle(),
            'adress' => $advert->getAdress(),
            'roomCount' => $advert->getRoomCount(),
            'district' => $advert->getDistrict(),
            'description' => $advert->getDiscription(),
            'floor' => $advert->getFloor(),
            'pricePerMonth' => $advert->getPricePerMonth(),
            'endDateOfAuction' => $advert->getEndDateOfAuction()->format('d.m.Y'),
            'dateOfRenting' => $advert->getDateOfRenting()->format('d.m.Y')

        ];
        $response = new Response(json_encode($ar));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    /**
     * Displays a form to edit an existing advert entity.
     *
     */
    public function editAction(Request $request)          //-----отдавать или принимать api?
    {
       $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $advert=$this->getDoctrine()->getManager()->getRepository('DefaultBundle:Adverts')->find($id);

        $user = $this->getUser();
       $advert->setUserId(1);//------------------- ид юзера??
       $advert->setAdress($data['adress']);
       $advert->setFloor($data['floor']);
        $advert->setDistrict($data['district']);
        $advert->setDiscription($data['description']);
        $advert->setTitle($data['title']);
        $advert->setRoomCount($data['roomCount']);
        $advert->setPricePerMonth($data['pricePerMonth']);
        if (isset($data['endDateOfAuction'])) {
            $data['endDateOfAuction'] = new \DateTime($data['endDateOfAuction']);
            $advert->setEndDateOfAuction($data['endDateOfAuction']);
        }
        if (isset($data['dateOfRenting'])) {
            $data['dateOfRenting'] = new \DateTime($data['dateOfRenting']);
            $advert->setDateOfRenting($data['dateOfRenting']);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush();

        $resp = new JsonResponse("ok");//-----------------------респонс со стасум выполнения----добавить валидацию и вывод ошибки-
//
    }

    /**
     * Deletes a advert entity.
     *
     */
    public function deleteAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $id = $data["id"];
        $advert=$this->getDoctrine()->getManager()->getRepository('DefaultBundle:Adverts')->find($id);
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();

            $resp = new Response("ok");//-----------------------респонс со стасум выполнения----добавить валидацию и вывод ошибки--
        return $resp;
    }

//    /**
//     * Creates a form to delete a advert entity.
//     *
//     * @param Adverts $advert The advert entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(Adverts $advert)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('adverts_delete', array('id' => $advert->getId())))
//            ->setMethod('DELETE')
//            ->getForm();
//    }
}
