<?php

namespace DefaultBundle\Services\CheckImg;


use DefaultBundle\DTO\UploadedImgResult;
use Eventviva\ImageResize;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadImageService
{

    /**
     * @var CheckImg
     */
    private $checkImg;

    /**
     * @var ImageNameGen
     */
    private $imageNameGen;
    private $imageRootDir;


    public function __construct(CheckImg $checkImg, ImageNameGen $imageNameGen)
    {
        $this->checkImg =$checkImg;
        $this->imageNameGen = $imageNameGen;
    }

    public function setImageRootDir($imageRootDir){
        $this->imageRootDir = $imageRootDir;
    }

    /**
     * @return UploadedImgResult
     */
    public function uploadImage(UploadedFile $uploadedFile, $advertId){
        $imageNameGen =$this->imageNameGen;

        $photoFileName = $advertId.$imageNameGen->nameGen()."." . $uploadedFile->getClientOriginalExtension();
        $photoDirPath= $this->imageRootDir;

        $uploadedFile->move($photoDirPath, $photoFileName);
        $img = new ImageResize($photoDirPath.$photoFileName);
        $img->resizeToHeight(200);
        $smallPhotoFileName = "small_".$photoFileName;
        $img->save($photoDirPath.$smallPhotoFileName);

        //return $smallPhotoFileName;
       $result = new UploadedImgResult($smallPhotoFileName,$photoFileName);
       return $result;
    }
}