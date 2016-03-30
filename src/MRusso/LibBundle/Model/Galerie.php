<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use MRusso\LibBundle\Service\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Galerie extends DB {

    private $file;
    protected $entity = 'MRusso\LibBundle\Entity\Galerie';

    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = $this->file->getClientOriginalName();
        }
    }

    public function getFile() {
        return $this->file;
    }

    public function upload() {
        if($this->request->files->get('media_file')){
            $files = array();
            if(is_array($this->request->files->get('media_file'))){
                $files = $this->request->files->get('media_file');
            }else{
                $files[] = $this->request->files->get('media_file');
            }
        foreach ($files as $file) {

            if (null === $file) {
                continue;
            }
            $this->setFile($file);
            if ($target = $this->getFile()->move('bundles/mrussogalerie/img/', $this->path)) {

                $galerie = new $this->entity;
                $galerie->setGalerieFile($target);
                $this->em->persist($galerie);
                $this->em->flush();
                continue;
            }

            // check if we have an old image
//            if (isset($this->temp)) {
//                // delete the old image
//                unlink($this->getUploadRootDir() . '/' . $this->temp);
//                // clear the temp image path
//                $this->temp = null;
//            }
            $this->file = null;
        }
    }
    }
}
