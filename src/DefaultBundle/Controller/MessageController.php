<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\Users;
use DefaultBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Message controller.
 *
 */
class MessageController extends Controller
{
    /**
     * Lists all message entities.
     *
     */
    public function indexAction()
    {

        $toId = $this->getUser()->getId();
        $query = $this->getDoctrine()->getManager()->createQuery("select m from DefaultBundle:Message m WHERE m.toId = :toId");
        $query->setParameter('toId', $toId);
        $messages = $query->getResult();

        $fromId = $messages[0]->getFromId();
        $manager = $this->getDoctrine()->getManager();
        $user = $manager->getRepository("DefaultBundle:Users")->find($fromId);

/*        $query2 = $this->getDoctrine()->getManager()->createQuery("select u from DefaultBundle:Users u WHERE u.id = :fromId");
        $query2->setParameter('fromId', $fromId);
        $user = $query2->getResult();*/

        return $this->render('message/index.html.twig', array(
            'messages' => $messages,
            'user'=> $user,
        ));
    }

    /**
     * Creates a new message entity.
     *
     */
    public function newAction(Request $request, $idUser)
    {

        $manager = $this->getDoctrine()->getManager();
        $user = $manager->getRepository("DefaultBundle:Users")->find($idUser);
        $to = $user->getId();
        $from = $this->getUser()->getId();

        $message = new Message();
        $form = $this->createForm('DefaultBundle\Form\MessageType', $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message->setToId($to);
            $message->setFromId($from);

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('message_index');
        }

        return $this->render('message/new.html.twig', array(
            'message' => $message,
            'form' => $form->createView(),
            'user' => $user,
        ));
    }

    /**
     * Finds and displays a message entity.
     *
     */
    public function showAction(Message $message)
    {
        $deleteForm = $this->createDeleteForm($message);

        return $this->render('message/show.html.twig', array(
            'message' => $message,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing message entity.
     *
     */
    public function editAction(Request $request, Message $message)
    {
        $deleteForm = $this->createDeleteForm($message);
        $editForm = $this->createForm('DefaultBundle\Form\MessageType', $message);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_edit', array('id' => $message->getId()));
        }

        return $this->render('message/edit.html.twig', array(
            'message' => $message,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a message entity.
     *
     */
    public function deleteAction(Request $request, Message $message)
    {
        $form = $this->createDeleteForm($message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush();
        }

        return $this->redirectToRoute('message_index');
    }

    /**
     * Creates a form to delete a message entity.
     *
     * @param Message $message The message entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Message $message)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('message_delete', array('id' => $message->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
