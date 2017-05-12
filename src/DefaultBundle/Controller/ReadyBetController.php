<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\ReadyBet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Readybet controller.
 *
 */
class ReadyBetController extends Controller
{
    /**
     * Lists all readyBet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $readyBets = $em->getRepository('DefaultBundle:ReadyBet')->findAll();

        return $this->render('readybet/index.html.twig', array(
            'readyBets' => $readyBets,
        ));
    }

    /**
     * Creates a new readyBet entity.
     *
     */
    public function newAction(Request $request)
    {
        $readyBet = new Readybet();
        $form = $this->createForm('DefaultBundle\Form\ReadyBetType', $readyBet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($readyBet);
            $em->flush();

            return $this->redirectToRoute('readybet_show', array('id' => $readyBet->getId()));
        }

        return $this->render('readybet/new.html.twig', array(
            'readyBet' => $readyBet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a readyBet entity.
     *
     */
    public function showAction(ReadyBet $readyBet)
    {
        $deleteForm = $this->createDeleteForm($readyBet);

        return $this->render('readybet/show.html.twig', array(
            'readyBet' => $readyBet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing readyBet entity.
     *
     */
    public function editAction(Request $request, ReadyBet $readyBet)
    {
        $deleteForm = $this->createDeleteForm($readyBet);
        $editForm = $this->createForm('DefaultBundle\Form\ReadyBetType', $readyBet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('readybet_edit', array('id' => $readyBet->getId()));
        }

        return $this->render('readybet/edit.html.twig', array(
            'readyBet' => $readyBet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a readyBet entity.
     *
     */
    public function deleteAction(Request $request, ReadyBet $readyBet)
    {
        $form = $this->createDeleteForm($readyBet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($readyBet);
            $em->flush();
        }

        return $this->redirectToRoute('readybet_index');
    }

    /**
     * Creates a form to delete a readyBet entity.
     *
     * @param ReadyBet $readyBet The readyBet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReadyBet $readyBet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('readybet_delete', array('id' => $readyBet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
