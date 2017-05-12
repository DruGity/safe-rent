<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\CommentsToRenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commentstorenter controller.
 *
 */
class CommentsToRenterController extends Controller
{
    /**
     * Lists all commentsToRenter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commentsToRenters = $em->getRepository('DefaultBundle:CommentsToRenter')->findAll();

        return $this->render('commentstorenter/index.html.twig', array(
            'commentsToRenters' => $commentsToRenters,
        ));
    }

    /**
     * Creates a new commentsToRenter entity.
     *
     */
    public function newAction(Request $request)
    {
        $commentsToRenter = new Commentstorenter();
        $form = $this->createForm('DefaultBundle\Form\CommentsToRenterType', $commentsToRenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentsToRenter);
            $em->flush();

            return $this->redirectToRoute('commentstorenter_show', array('id' => $commentsToRenter->getId()));
        }

        return $this->render('commentstorenter/new.html.twig', array(
            'commentsToRenter' => $commentsToRenter,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentsToRenter entity.
     *
     */
    public function showAction(CommentsToRenter $commentsToRenter)
    {
        $deleteForm = $this->createDeleteForm($commentsToRenter);

        return $this->render('commentstorenter/show.html.twig', array(
            'commentsToRenter' => $commentsToRenter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commentsToRenter entity.
     *
     */
    public function editAction(Request $request, CommentsToRenter $commentsToRenter)
    {
        $deleteForm = $this->createDeleteForm($commentsToRenter);
        $editForm = $this->createForm('DefaultBundle\Form\CommentsToRenterType', $commentsToRenter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentstorenter_edit', array('id' => $commentsToRenter->getId()));
        }

        return $this->render('commentstorenter/edit.html.twig', array(
            'commentsToRenter' => $commentsToRenter,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentsToRenter entity.
     *
     */
    public function deleteAction(Request $request, CommentsToRenter $commentsToRenter)
    {
        $form = $this->createDeleteForm($commentsToRenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentsToRenter);
            $em->flush();
        }

        return $this->redirectToRoute('commentstorenter_index');
    }

    /**
     * Creates a form to delete a commentsToRenter entity.
     *
     * @param CommentsToRenter $commentsToRenter The commentsToRenter entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommentsToRenter $commentsToRenter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentstorenter_delete', array('id' => $commentsToRenter->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
