<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\Adverts;
use DefaultBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        $em = $this->getDoctrine()->getManager();

        $adverts = $em->getRepository('DefaultBundle:Adverts')->findAll();

        return $this->render('adverts/index.html.twig', array(
            'adverts' => $adverts,
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
            if ($errorList->count() > 0) {
                foreach ($errorList as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
                return $this->redirectToRoute("adverts_new");
            }

            $user = $this->getUser();
            $advert->setUserId(1);

            $em = $this->getDoctrine()->getManager();
            $filesAr = $request->files->get("defaultbundle_adverts");
            /** @var UploadedFile $photos */
            $photoFiles = $filesAr["photos"];

            foreach ($photoFiles as $photoFile) {
                $photo = new Media();
                $photoFileName = $this->get("image_upload")->uploadImage($photoFile, $advert->getId());
                $photo->setAdvert($advert);
                $photo->setFilename($photoFileName);
                $photo->setType("photo");

                $em->persist($photo);
            }
            $advert->setUserId(1);
            $advert->setCityId(1);
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
            ->getForm();
    }
}
