<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\CommentsToAdvert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commentstoadvert controller.
 *
 */
class CommentsToAdvertController extends Controller
{
    /**
     * Lists all commentsToAdvert entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commentsToAdverts = $em->getRepository('DefaultBundle:CommentsToAdvert')->findAll();

        return $this->render('commentstoadvert/index.html.twig', array(
            'commentsToAdverts' => $commentsToAdverts,
        ));
    }

    /**
     * Creates a new commentsToAdvert entity.
     *
     */
    public function newAction(Request $request)
    {
        $commentsToAdvert = new Commentstoadvert();
        $form = $this->createForm('DefaultBundle\Form\CommentsToAdvertType', $commentsToAdvert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $errorList = $this->get('validator')->validate($commentsToAdvert);
            if ($errorList->count() > 0)
            {
                foreach ($errorList as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
                return $this->redirectToRoute("commentstoadvert_new");
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($commentsToAdvert);
            $em->flush();

            return $this->redirectToRoute('commentstoadvert_show', array('id' => $commentsToAdvert->getId()));
        }

        return $this->render('commentstoadvert/new.html.twig', array(
            'commentsToAdvert' => $commentsToAdvert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentsToAdvert entity.
     *
     */
    public function showAction(CommentsToAdvert $commentsToAdvert)
    {
        $deleteForm = $this->createDeleteForm($commentsToAdvert);

        return $this->render('commentstoadvert/show.html.twig', array(
            'commentsToAdvert' => $commentsToAdvert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commentsToAdvert entity.
     *
     */
    public function editAction(Request $request, CommentsToAdvert $commentsToAdvert)
    {
        $deleteForm = $this->createDeleteForm($commentsToAdvert);
        $editForm = $this->createForm('DefaultBundle\Form\CommentsToAdvertType', $commentsToAdvert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentstoadvert_edit', array('id' => $commentsToAdvert->getId()));
        }

        return $this->render('commentstoadvert/edit.html.twig', array(
            'commentsToAdvert' => $commentsToAdvert,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentsToAdvert entity.
     *
     */
    public function deleteAction(Request $request, CommentsToAdvert $commentsToAdvert)
    {
        $form = $this->createDeleteForm($commentsToAdvert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentsToAdvert);
            $em->flush();
        }

        return $this->redirectToRoute('commentstoadvert_index');
    }

    /**
     * Creates a form to delete a commentsToAdvert entity.
     *
     * @param CommentsToAdvert $commentsToAdvert The commentsToAdvert entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommentsToAdvert $commentsToAdvert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentstoadvert_delete', array('id' => $commentsToAdvert->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
