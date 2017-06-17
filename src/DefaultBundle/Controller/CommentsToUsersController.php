<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\CommentsToUsers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commentstouser controller.
 *
 */
class CommentsToUsersController extends Controller
{
    /**
     * Lists all commentsToUsers entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commentsToUsers = $em->getRepository('DefaultBundle:CommentsToUsers')->findAll();

        return $this->render('commentstouser/index.html.twig', array(
            'commentsToUsers' => $commentsToUsers,
        ));
    }

    /**
     * Creates a new commentsToUsers entity.
     *
     */
    public function newAction(Request $request)
    {
        $commentsToUsers = new CommentsToUsers();
        $form = $this->createForm('DefaultBundle\Form\CommentsToUsersType', $commentsToUsers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentsToUsers);
            $em->flush();

            return $this->redirectToRoute('commentstouser_show', array('id' => $commentsToUsers->getId()));
        }

        return $this->render('commentstouser/new.html.twig', array(
            'commentsToUsers' => $commentsToUsers,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentsToUsers entity.
     *
     */
    public function showAction(CommentsToUsers $commentsToUsers)
    {
        $deleteForm = $this->createDeleteForm($commentsToUsers);

        return $this->render('commentstouser/show.html.twig', array(
            'commentsToUsers' => $commentsToUsers,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commentsToUsers entity.
     *
     */
    public function editAction(Request $request, CommentsToUsers $commentsToUsers)
    {
        $deleteForm = $this->createDeleteForm($commentsToUsers);
        $editForm = $this->createForm('DefaultBundle\Form\CommentsToUsersType', $commentsToUsers);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentstouser_edit', array('id' => $commentsToUsers->getId()));
        }

        return $this->render('commentstouser/edit.html.twig', array(
            'commentsToUsers' => $commentsToUsers,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentsToUsers entity.
     *
     */
    public function deleteAction(Request $request, CommentsToUsers $commentsToUsers)
    {
        $form = $this->createDeleteForm($commentsToUsers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentsToUsers);
            $em->flush();
        }

        return $this->redirectToRoute('commentstouser_index');
    }

    /**
     * Creates a form to delete a commentsToUsers entity.
     *
     * @param CommentsToUsers $commentsToUsers The commentsToUsers entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommentsToUsers $commentsToUsers)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentstouser_delete', array('id' => $commentsToUsers->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
