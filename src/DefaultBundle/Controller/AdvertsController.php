<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\Adverts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Advert controller.
 *
 */
class AdvertsController extends Controller
{
//    /**
//     * Lists all advert entities.
//     *
//     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//        $adverts = $em->getRepository('DefaultBundle:Adverts')->findAll();
//
//        $arr=[];
//        foreach ($adverts as $advert){
//            $ar= $advert->jsonSerialize();
//            array_push($arr,$ar);
//        }
//
//        $response = new JsonResponse($arr);
//        $response->headers->set('Content-Type', 'application/json');
//        return $response;
//    }
//
//    /**
//     * Creates a new advert entity.
//     *
//     */
//    public function newAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $advert = new Adverts();
//        $data = json_decode($request->getContent(), true);
//
//        $user = $this->getUser();
//        $advert->jsonDeSerialize($data);
//        $advert->setUser($user);
//
//        $em->persist($advert);
//        $em->flush();
//
//        return new Response("Advert was created");
//    }
//
//    /**
//     * Finds and displays a advert entity.
//     *
//     */
//    public function showAction($id)
//    {
//        $advert = $this->getDoctrine()->getManager()->getRepository('DefaultBundle:Adverts')->find($id);
//       $photos= $advert->getPhotos();
//        $arr= $advert->jsonSerialize();
//
//        $response = new JsonResponse($arr);
//        $response->headers->set('Content-Type', 'application/json');
//        return $response;
//
//    }
//
//    /**
//     * Displays a form to edit an existing advert entity.
//     *
//     */
//    public function editAction(Request $request, $id)
//    {
//       $advert = $this->getDoctrine()->getManager()->getRepository('DefaultBundle:Adverts')->find($id);
//        $data = json_decode($request->getContent(), true);
//        $user = $this->getUser();
//        $advert->jsonDeSerialize($data);
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($advert);
//        $em->flush();
//
//        $resp = new Response("Advert was edited");
//        return $resp;
//    }
//
//    /**
//     * Deletes a advert entity.
//     *
//     */
//    public function deleteAction($id)
//    {
//        $advert = $this->getDoctrine()->getManager()->getRepository('DefaultBundle:Adverts')->find($id);
//        $em = $this->getDoctrine()->getManager();
//        $em->remove($advert);
//        $em->flush();
//
//        $resp = new Response("Advert was deleted");
//        return $resp;
//
//   }
//
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
//            ->getForm()
//        ;
//    }
//
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('DefaultBundle:Adverts')->findAll();
//        $serializer = $this->get('api.json_serializer');
//       // $jsAr= {'user':7,'title':'cccccc','adress':'ccc','roomCount':4,'district':'ccca','description':'aaaaaaaa','floor':5,'pricePerMonth':555,'dateOfRenting':'05.07.2013','iconFileName':'icon_9725330.jpg'};
//         $res =$serializer->serialize($advert);
//         var_dump($res);
//         die();
        //$user = $em->getRepository('DefaultBundle:Users')->find(idUser);
        return $this->render('adverts/index.html.twig', array(
            'adverts' => $adverts,
        ));
    }

    /**
     * Creates a new advert entity.
     *
     */
    public function newAction(Request $request)
    {
        $advert = new Adverts();
        $form = $this->createForm('DefaultBundle\Form\AdvertsType', $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errorList = $this->get('validator')->validate($advert);
            if ($errorList->count() > 0) {
                foreach ($errorList as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
                return $this->redirectToRoute("adverts_new");
            }
            $filesArray = $request->files->get("defaultbundle_adverts");

            /*@var UploadedFile $photoFile */
            $photoFile = $filesArray['photoFile'];

            $imageCheckService = $this->get("check_image");
            try {
                $imageCheckService->check($photoFile);
            } catch (\InvalidArgumentException $ex) {
                die("Image loading error!!!!");
            }

            $iconFileName = $uploadImageService = $this->get("upload_image_service")->uploadIcon($photoFile);
            $advert->setIconFileName($iconFileName);


            $userId = $this->getUser()->getId();

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('DefaultBundle:Users')->find($userId);

            $advert->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('adverts_show', array('id' => $advert->getId()));
        }

        return $this->render('adverts/new.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a advert entity.
     *
     */
    public function showAction(Adverts $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);

        return $this->render('adverts/show.html.twig', array(
            'advert' => $advert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing advert entity.
     *
     */
    public function editAction(Request $request, Adverts $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);
        $editForm = $this->createForm('DefaultBundle\Form\AdvertsType', $advert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adverts_edit', array('id' => $advert->getId()));
        }

        return $this->render('adverts/edit.html.twig', array(
            'advert' => $advert,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a advert entity.
     *
     */
    public function deleteAction(Request $request, Adverts $advert)
    {
        $form = $this->createDeleteForm($advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();
        }

        return $this->redirectToRoute('adverts_index');
    }

    /**
     * Creates a form to delete a advert entity.
     *
     * @param Adverts $advert The advert entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Adverts $advert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adverts_delete', array('id' => $advert->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

}
