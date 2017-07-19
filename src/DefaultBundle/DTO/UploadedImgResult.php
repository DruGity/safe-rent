<?php

namespace DefaultBundle\DTO;

class UploadedImgResult
{
    private $smallFileName;
    private $bigFileName;
    public function __construct($smallFileName, $bigFileName)
    {
        $this->smallFileName  = $smallFileName;
        $this->bigFileName = $bigFileName;
    }
    /**
     * @return mixed
     */
    public function getSmallFileName()
    {
        return $this->smallFileName;
    }
    /**
     * @return mixed
     */
    public function getBigFileName()
    {
        return $this->bigFileName;
    }
}