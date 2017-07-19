<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\Adverts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationList;


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
//
//
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

    /**
     * Lists all advert entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('DefaultBundle:Adverts')->findAll();

        $counters = $this->getCounters();

        return $this->render('adverts/index.html.twig', array(
            'adverts' => $adverts,
            'amountOfAdverts' => $counters[2],
            'amountOfUsers' => $counters[1],
            'amountOfComments' => $counters[0],
            'amount1' => $counters[3],
            'amount2' => $counters[4],
            'amount3' => $counters[5],
            'amount4' => $counters[6],
            'amount5' => $counters[7],

        ));
    }

    public function getCounters()
    {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('DefaultBundle:Adverts')->findAll();
        $users = $em->getRepository('DefaultBundle:Users')->findAll();
        $comments = $em->getRepository('DefaultBundle:CommentsToAdvert')->findAll();

        $query1 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Суворовский'");
        $filter1 = count($query1->getResult());

        $query2 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Коминтерновский'");
        $filter2 = count($query2->getResult());

        $query3 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Малиновский'");
        $filter3 = count($query3->getResult());

        $query4 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Приморский'");
        $filter4 = count($query4->getResult());

        $query5 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Киевский'");
        $filter5 = count($query5->getResult());

        $countA = 0;
        foreach ($adverts as $item) {
            $countA = $countA + 1;
        }
        $countU = 0;
        foreach ($users as $item) {
            $countU = $countU + 1;
        }
        $countC = 0;
        foreach ($comments as $item) {
            $countC = $countC + 1;
        }

        $counters = array($countC, $countU, $countA, $filter1, $filter2, $filter3, $filter4, $filter5);

        return $counters;
    }

    public function filter1Action()
    {
        $query = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Суворовский'");
        $adverts = $query->getResult();

        $counters = $this->getCounters();

        return $this->render('adverts/index.html.twig', array(
            'adverts' => $adverts,
            'amountOfAdverts' => $counters[2],
            'amountOfUsers' => $counters[1],
            'amountOfComments' => $counters[0],
            'amount1' => $counters[3],
            'amount2' => $counters[4],
            'amount3' => $counters[5],
            'amount4' => $counters[6],
            'amount5' => $counters[7],

        ));
    }

    public function filter2Action()
    {
        $query = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Коминтерновский'");
        $adverts = $query->getResult();

        $counters = $this->getCounters();

        return $this->render('adverts/index.html.twig', array(
            'adverts' => $adverts,
            'amountOfAdverts' => $counters[2],
            'amountOfUsers' => $counters[1],
            'amountOfComments' => $counters[0],
            'amount1' => $counters[3],
            'amount2' => $counters[4],
            'amount3' => $counters[5],
            'amount4' => $counters[6],
            'amount5' => $counters[7],
        ));
    }

    public function filter3Action()
    {
        $query = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Малиновский'");
        $adverts = $query->getResult();

        $counters = $this->getCounters();

        return $this->render('adverts/index.html.twig', array(
            'adverts' => $adverts,
            'amountOfAdverts' => $counters[2],
            'amountOfUsers' => $counters[1],
            'amountOfComments' => $counters[0],
            'amount1' => $counters[3],
            'amount2' => $counters[4],
            'amount3' => $counters[5],
            'amount4' => $counters[6],
            'amount5' => $counters[7],

        ));
    }

    public function filter4Action()
    {
        $query = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Приморский'");
        $adverts = $query->getResult();
        $counters = $this->getCounters();

        return $this->render('adverts/index.html.twig', array(
            'adverts' => $adverts,
            'amountOfAdverts' => $counters[2],
            'amountOfUsers' => $counters[1],
            'amountOfComments' => $counters[0],
            'amount1' => $counters[3],
            'amount2' => $counters[4],
            'amount3' => $counters[5],
            'amount4' => $counters[6],
            'amount5' => $counters[7],

        ));
    }

    public function filter5Action()
    {
        $query = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Киевский'");
        $adverts = $query->getResult();

        $counters = $this->getCounters();

        return $this->render('adverts/index.html.twig', array(
            'adverts' => $adverts,
            'amountOfAdverts' => $counters[2],
            'amountOfUsers' => $counters[1],
            'amountOfComments' => $counters[0],
            'amount1' => $counters[3],
            'amount2' => $counters[4],
            'amount3' => $counters[5],
            'amount4' => $counters[6],
            'amount5' => $counters[7],

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
            if ($errorList->count() > 0)
            {
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
            ->getForm()
        ;
    }
}
