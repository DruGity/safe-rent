<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\CommentsToAdvert;
use DefaultBundle\Entity\Adverts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commentstoadvert controller.
 *
 */
class CommentsToAdvertController extends Controller
{

    public function indexAction($idAdvert)
    {

        $advert = $this->getDoctrine()->getManager()->getRepository("DefaultBundle:Adverts")->find($idAdvert);
        $comments = $advert->getComments();
        $arr=[];
        foreach ($comments as $comment){
            $ar= $comment->jsonSerialize();
            array_push($arr,$ar);
        }
        $response = new JsonResponse($arr);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;

    }

    /**
     * Creates a new commentsToAdvert entity.
     *
     */
    public function newAction(Request $request, $idAdvert)
    {
        $manager = $this->getDoctrine()->getManager();
        $advert = $manager->getRepository("DefaultBundle:Adverts")->find($idAdvert);

        $commentator = $this->getUser()->getName();

        if ($advert == null) {
            return $this->createNotFoundException("Advert not found!");
        }

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

            $commentsToAdvert->setAdvert($advert);
            $commentsToAdvert->setCommentator($commentator);

            $em = $this->getDoctrine()->getManager();
            $em->persist($commentsToAdvert);
            $em->flush();

            return $this->redirectToRoute('adverts_index');
        }

        return $this->render('commentstoadvert/new.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentsToAdvert entity.
     *
     */
    public function showAction($id)
    {
        $comment = $this->getDoctrine()->getManager()->getRepository('DefaultBundle:CommentsToAdvert')->find($id);

        $arr= $comment->jsonSerialize();

        $response = new JsonResponse($arr);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;

    }

    /**
     * Displays a form to edit an existing commentsToAdvert entity.
     *
     */
    public function editAction(Request $request, CommentsToAdvert $commentsToAdvert) //, Adverts $advert
    {
        $deleteForm = $this->createDeleteForm($commentsToAdvert);
        $editForm = $this->createForm('DefaultBundle\Form\CommentsToAdvertType', $commentsToAdvert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('commentstoadvert_index', array('idAdvert' => $advert->getId()));

            return $this->redirectToRoute('adverts_index');
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

        return $this->redirectToRoute('adverts_index');
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
