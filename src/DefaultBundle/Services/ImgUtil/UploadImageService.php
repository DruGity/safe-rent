<?php

namespace DefaultBundle\Services\ImageUtil;


use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadImageService
{
    /**
     * @var CheckImg
     */
    private $checkImg;

    /**
     * @var ImageNameGenerator
     */
    private $imageNameGenerator;
    private $uploadImageRootDir;
    private $supportUploadAvatarSizes;

    /**
     * @param mixed $imageRootDir
     */
    public function setUploadImageRootDir($imageRootDir)
    {
        $this->uploadImageRootDir = $imageRootDir;
    }

    public function __construct($checkImg, $imageNameGenerator, $avatarSizes)
    {
        $this->checkImg = $checkImg;
        $this->imageNameGenerator = $imageNameGenerator;
        $this->supportUploadAvatarSizes = $avatarSizes;
    }

    /**
     * @return string
     */
    public function uploadImage(UploadedFile $uploadedFile, $id, $photoFileName = null)
    {
        $imageNameGenerator = $this->imageNameGenerator;
        $checkImg = $this->checkImg;

        if ($photoFileName == null) {
            $photoFileName = $id . $imageNameGenerator->generateName() . "." . $uploadedFile->getClientOriginalExtension();

        }

        $photoDirPath = $this->uploadImageRootDir;
        if ($uploadedFile != null) {
            try {
                $checkImg->check($uploadedFile);
            } catch (\InvalidArgumentException $ex) {
                die("Image type error!");
            }
            try {
                $uploadedFile->move($photoDirPath, $photoFileName);
            } catch (\Exception $exception) {
                echo "Can not move file!";
                throw $exception;
            }
        }

        return $photoFileName;
    }

    /**
     * @return string
     */
    public function uploadAvatar(UploadedFile $uploadedFile, $id, $avatarFileName = null)
    {
        $imageNameGenerator = $this->imageNameGenerator;
        $checkImg = $this->checkImg;

        if ($avatarFileName == null) {
            $avatarFileName = $id . $imageNameGenerator->generateName() . "." . $uploadedFile->getClientOriginalExtension();
        }

        $avatarDirPath = $this->uploadImageRootDir . "../avatars/";

        try {
            $checkImg->check($uploadedFile);
        } catch (\InvalidArgumentException $ex) {
            die("Image type error!");
        }

        try {
            $uploadedFile->move($avatarDirPath, $avatarFileName);
        } catch (\Exception $exception) {
            echo "Can not move file!";
            throw $exception;
        }
        $img = Image::make($avatarDirPath . $avatarFileName);
        $height = $this->supportUploadAvatarSizes[0][0];
        $width = $this->supportUploadAvatarSizes[0][1];
        $img->resize($width, $height)->save($avatarDirPath . $avatarFileName);

        return $avatarFileName;
    }
}
