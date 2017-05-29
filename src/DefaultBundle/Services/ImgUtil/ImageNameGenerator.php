<?php

namespace DefaultBundle\Services\ImgUtil;

class ImageNameGenerator
{
    public function generateName()
    {
        return rand(1000, 9999999);
    }
}