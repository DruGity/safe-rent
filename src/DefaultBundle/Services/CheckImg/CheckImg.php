<?php

namespace DefaultBundle\Services\CheckImg;

use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CheckImg
{
    private $uploadImageTypeList;
    public function __construct($uploadImageTypeList)
    {
        $this->uploadImageTypeList = $uploadImageTypeList;
    }

    public function check(UploadedFile $photoFile){
        $checkTrue= false;
        $mimeType = $photoFile->getCLientMimeType();
        foreach ($this->uploadImageTypeList as $imgType) {
            if ($mimeType == $imgType[1]) {
                $checkTrue = true;
            }
        }
            if($checkTrue !== true){
                throw new \InvalidArgumentException('MimeType is blocked');
            }


        $fileExt= $photoFile->getClientOriginalExtension();
        $checkTrue=false;
        foreach( $this->uploadImageTypeList as $imgType) {
            if ($fileExt == $imgType[0]) {
                $checkTrue = true;
            }
        }
            if($checkTrue !== true){
                throw new \InvalidArgumentException('Extension is blocked');
            }


        return true;
    }
}