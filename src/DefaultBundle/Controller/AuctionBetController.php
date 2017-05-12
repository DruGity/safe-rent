<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\AuctionBet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auctionbet controller.
 *
 */
class AuctionBetController extends Controller
{
    /**
     * Lists all auctionBet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $auctionBets = $em->getRepository('DefaultBundle:AuctionBet')->findAll();

        return $this->render('auctionbet/index.html.twig', array(
            'auctionBets' => $auctionBets,
        ));
    }

    /**
     * Creates a new auctionBet entity.
     *
     */
    public function newAction(Request $request)
    {
        $auctionBet = new Auctionbet();
        $form = $this->createForm('DefaultBundle\Form\AuctionBetType', $auctionBet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($auctionBet);
            $em->flush();

            return $this->redirectToRoute('auctionbet_show', array('id' => $auctionBet->getId()));
        }

        return $this->render('auctionbet/new.html.twig', array(
            'auctionBet' => $auctionBet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a auctionBet entity.
     *
     */
    public function showAction(AuctionBet $auctionBet)
    {
        $deleteForm = $this->createDeleteForm($auctionBet);

        return $this->render('auctionbet/show.html.twig', array(
            'auctionBet' => $auctionBet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing auctionBet entity.
     *
     */
    public function editAction(Request $request, AuctionBet $auctionBet)
    {
        $deleteForm = $this->createDeleteForm($auctionBet);
        $editForm = $this->createForm('DefaultBundle\Form\AuctionBetType', $auctionBet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('auctionbet_edit', array('id' => $auctionBet->getId()));
        }

        return $this->render('auctionbet/edit.html.twig', array(
            'auctionBet' => $auctionBet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a auctionBet entity.
     *
     */
    public function deleteAction(Request $request, AuctionBet $auctionBet)
    {
        $form = $this->createDeleteForm($auctionBet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($auctionBet);
            $em->flush();
        }

        return $this->redirectToRoute('auctionbet_index');
    }

    /**
     * Creates a form to delete a auctionBet entity.
     *
     * @param AuctionBet $auctionBet The auctionBet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AuctionBet $auctionBet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('auctionbet_delete', array('id' => $auctionBet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
