<?php
/**
 * Created by PhpStorm.
 * User: Client
 * Date: 10.07.2017
 * Time: 10:48
 */
namespace DefaultBundle\Services\CheckImg;
class ImageNameGen
{
    public function nameGen(){
        return rand(1000000, 9999999);
    }
}