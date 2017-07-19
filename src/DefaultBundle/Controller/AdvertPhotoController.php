<?php
namespace DefaultBundle\Controller;
use DefaultBundle\Entity\AdvertPhoto;
use DefaultBundle\Form\AdvertPhotoType;
use Eventviva\ImageResize;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertPhotoController extends Controller
{
    public function addAction(Request $request, $idAdvert)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('DefaultBundle:Adverts')->find($idAdvert);
        if ($advert == null) {
            return $this->createNotFoundException("Advert not found!");
        }
        $photo = new AdvertPhoto();
        $form = $this->createForm(AdvertPhotoType::class, $photo);
        if ($request->isMethod("POST")) {
            $form->handleRequest($request);
            $filesArray = $request->files->get("defaultbundle_advertphoto");
            /*@var UploadedFile $photoFile */
            $photoFile = $filesArray['photoFile'];
            $imageCheckService = $this->get("check_image");
            try {
                $imageCheckService->check($photoFile);
            } catch (\InvalidArgumentException $ex) {
                die("Image loading error!!!!");
            }
            $result= $uploadImageService= $this->get("upload_image_service")->uploadImage($photoFile, $idAdvert);
            $photo->setSmallImage($result->getSmallFileName());
            $photo->setOriginalImage($result->getBigFileName());
            $photo->setAdvert($advert);
            $em->persist($photo);
            $em->flush();
            return $this->redirectToRoute('advert_photo_list', array('idAdvert' =>$idAdvert));
        }
        return $this->render('advertphoto/add.html.twig', array(
            'form'=>$form->createView(),
            'advert'=>$advert
        ));
    }
    public function editAction(Request $request, $id)
    {
        $photo = $this->getDoctrine()->getRepository("DefaultBundle:AdvertPhoto")->find($id);
        $form = $this->createForm(AdvertPhotoType::class, $photo);
        if ($request->isMethod("POST")) {
            $form->handleRequest($request);
            $filesArray = $request->files->get("defaultbundle_advertphoto");
            /*@var UploadedFile $photoFile */
            $photoFile = $filesArray['photoFile'];
            $imageCheckService = $this->get("check_image");
            try {
                $imageCheckService->check($photoFile);
            } catch (\InvalidArgumentException $ex) {
                die("Image loading error!!!!");
            }
            $result= $uploadImageService= $this->get("upload_image_service")->uploadImage($photoFile, $id);
            $photo->setSmallImage($result->getSmallFileName());
            $photo->setOriginalImage($result->getBigFileName());
            //$photo->setAdvert($advert);
            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();
            return $this->redirectToRoute('advert_photo_list', array('idAdvert' =>$photo->getAdvert()->getId()));
        }
        return  $this->render('advertphoto/edit.html.twig', array(
            'form'=>$form->createView(),
            'photo'=>$photo
        ));
    }
    public function listAction($idAdvert)
    {
        $advert = $this->getDoctrine()->getRepository("DefaultBundle:Adverts")->find($idAdvert);
        return  $this->render('advertphoto/list.html.twig', array(
            "advert" => $advert
        ));
    }
    public function deleteAction($id)
    {
        $photo = $this->getDoctrine()->getRepository("DefaultBundle:AdvertPhoto")->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($photo);
        $manager->flush();
        return $this->redirectToRoute('advert_photo_list', array('idAdvert' =>$photo->getAdvert()->getId()));
    }
}