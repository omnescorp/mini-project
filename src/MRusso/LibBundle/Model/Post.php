<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use MRusso\LibBundle\Service\DB;

class Post extends DB {

    protected $entity = 'MRusso\LibBundle\Entity\Post';

    public function getAllFront() {
        $query = $this->em->createQueryBuilder();

        $query
                ->select('post')
                ->from($this->entity, 'post')
                ->where('post.postStatus = 0')
                ->orderBy('post.postDate', 'desc')
        ;
//        echo $query->getQuery()->getSql();die;
//	return $this->getOne($query);
        return $this->OrmPaginator($query);
    }

    public function create($post = null) {
        $date = new \DateTime("now");
//        echo get_class($date);die;

        if (!$post) {
            $post = new $this->entity;
        }
        $post
                ->setPostTitle($this->request->get('post_title'))
                ->setPostImage($this->request->get('post_title'))
                ->setPostDate($date)
//                ->setPostUser($this->container->get('mrusso.user')->getUser())


        ;
        $this->em->persist($post);
        $this->em->flush();
        return $post;
    }

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
        if ($this->request->files->get('media_file')) {
            $files = array();
            if (is_array($this->request->files->get('media_file'))) {
                $files = $this->request->files->get('media_file');
            } else {
                $files[] = $this->request->files->get('media_file');
            }
            foreach ($files as $file) {

                if (null === $file) {
                    continue;
                }
                $this->setFile($file);
                if ($target = $this->getFile()->move('bundles/mrussominiproject/img/', $this->path)) {

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
