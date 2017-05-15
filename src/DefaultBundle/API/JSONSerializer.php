<?php

namespace DefaultBundle\API;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class JSONSerializer
{
    protected $encoders;
    protected $normalizers;
    protected $serializer;

    public function __construct()
    {
        $this->encoders = array(new XmlEncoder(), new JsonEncoder());
        $this->normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    /*
     * string(174) "{"id":1,"login":"AAAAAAAa","password":"1111111111","photo":"1111111111111",
     * "phoneNumber":"0636208667","email":"shadowflame724@gmail.com","fBlink":"AAAAA","vKlink":"AAAAAAAA"}"
     * USE in controller - $json = $this->get("api.json_serializer")->serialize($user);
     */
    public function serialize($obj)
    {
        $result = $this->serializer->serialize($obj, 'json');

        return $result;
    }

    /*
     * object(DefaultBundle\Entity\Users)#744 (8) {
  ["id":"DefaultBundle\Entity\Users":private]=>
  NULL
  ["login":"DefaultBundle\Entity\Users":private]=>
  string(8) "AAAAAAAa"
  ["password":"DefaultBundle\Entity\Users":private]=>
  string(10) "1111111111"
  ["photo":"DefaultBundle\Entity\Users":private]=>
  string(13) "1111111111111"
  ["phoneNumber":"DefaultBundle\Entity\Users":private]=>
  string(10) "0636208667"
  ["email":"DefaultBundle\Entity\Users":private]=>
  string(24) "shadowflame724@gmail.com"
  ["fBlink":"DefaultBundle\Entity\Users":private]=>
  string(5) "AAAAA"
  ["vKlink":"DefaultBundle\Entity\Users":private]=>
  string(8) "AAAAAAAA"
}
     * USE in controller - $obj = $this->get("api.json_serializer")->deSerialize($json, Users::class);
     */
    public function deSerialize($data, $class)
    {
        $obj = $this->serializer->deserialize($data, $class, 'json');

        return $obj;
    }
}