<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\CommentPhoto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commentphoto controller.
 *
 */
class CommentPhotoController extends Controller
{
    /**
     * Lists all commentPhoto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commentPhotos = $em->getRepository('DefaultBundle:CommentPhoto')->findAll();

        return $this->render('commentphoto/index.html.twig', array(
            'commentPhotos' => $commentPhotos,
        ));
    }

    /**
     * Creates a new commentPhoto entity.
     *
     */
    public function newAction(Request $request)
    {
        $commentPhoto = new Commentphoto();
        $form = $this->createForm('DefaultBundle\Form\CommentPhotoType', $commentPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentPhoto);
            $em->flush();

            return $this->redirectToRoute('commentphoto_show', array('id' => $commentPhoto->getId()));
        }

        return $this->render('commentphoto/new.html.twig', array(
            'commentPhoto' => $commentPhoto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentPhoto entity.
     *
     */
    public function showAction(CommentPhoto $commentPhoto)
    {
        $deleteForm = $this->createDeleteForm($commentPhoto);

        return $this->render('commentphoto/show.html.twig', array(
            'commentPhoto' => $commentPhoto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commentPhoto entity.
     *
     */
    public function editAction(Request $request, CommentPhoto $commentPhoto)
    {
        $deleteForm = $this->createDeleteForm($commentPhoto);
        $editForm = $this->createForm('DefaultBundle\Form\CommentPhotoType', $commentPhoto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentphoto_edit', array('id' => $commentPhoto->getId()));
        }

        return $this->render('commentphoto/edit.html.twig', array(
            'commentPhoto' => $commentPhoto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentPhoto entity.
     *
     */
    public function deleteAction(Request $request, CommentPhoto $commentPhoto)
    {
        $form = $this->createDeleteForm($commentPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentPhoto);
            $em->flush();
        }

        return $this->redirectToRoute('commentphoto_index');
    }

    /**
     * Creates a form to delete a commentPhoto entity.
     *
     * @param CommentPhoto $commentPhoto The commentPhoto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommentPhoto $commentPhoto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentphoto_delete', array('id' => $commentPhoto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
