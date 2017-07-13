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
    /**
     * Lists all advert entities.
     *
     */
    public function indexAction()
    {

        $query1 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Суворовский'");
        $a1 = $query1->getResult();
        $amount1 = count($a1);

        $query2 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Коминтерновский'");
        $a2 = $query2->getResult();
        $amount2 = count($a2);

        $query3 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Малиновский'");
        $a3 = $query3->getResult();
        $amount3 = count($a3);

        $query4 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Приморский'");
        $a4 = $query4->getResult();
        $amount4 = count($a4);

        $query5 = $this->getDoctrine()->getManager()->createQuery("select a from DefaultBundle:Adverts a where a.district = 'Киевский'");
        $a5 = $query5->getResult();
        $amount5 = count($a5);

        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('DefaultBundle:Adverts')->findAll();

        $counters = $this->getCounters();

        return $this->render('adverts/index.html.twig', array(
            'adverts' => $adverts,
            'amountOfAdverts' => $counters[2],
            'amountOfUsers' => $counters[1],
            'amountOfComments' => $counters[0],
            'amount1' => $amount1,
            'amount2' => $amount2,
            'amount3' => $amount3,
            'amount4' => $amount4,
            'amount5' => $amount5,

        ));
    }

    public function getCounters()
    {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('DefaultBundle:Adverts')->findAll();
        $users = $em->getRepository('DefaultBundle:Users')->findAll();
        $comments = $em->getRepository('DefaultBundle:CommentsToAdvert')->findAll();

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

        $counters = array($countC, $countU, $countA);

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
