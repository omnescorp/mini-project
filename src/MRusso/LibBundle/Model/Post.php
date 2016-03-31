<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use MRusso\LibBundle\Service\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Post extends DB {

    protected $entity = 'MRusso\LibBundle\Entity\Post';

    public function getAllFront() {
        $query = $this->em->createQueryBuilder();

        $query
                ->select('post')
                ->from($this->entity, 'post')
//                ->where('post.postStatus = 0')
                ->orderBy('post.postDate', 'desc')
        ;
//        echo $query->getQuery()->getSql();die;
//	return $this->getOne($query);
        return $this->OrmPaginator($query);
    }

    public function findAndUpdate() {
        if ($post = $this->find($this->request->get('id'))) {
            $visto = $post->getPostView();
            $post->setPostView(++$visto);
            $this->em->persist($post);
            $this->em->flush();
            return $post;
        }
        return false;
    }

    public function create($post = null) {
        $date = new \DateTime("now");
//        echo get_class($date);die;

        if (!$post) {
            $post = new $this->entity;
        }
        $post
                ->setPostTitle($this->request->get('post_title'))
//                ->setPostImage($this->request->get('post_title'))
                ->setPostDate($date)
                ->setPostStatus(1)
//                ->setPostUser($this->container->get('mrusso.user')->getUser())


        ;

        if ($target = $this->upload()) {
            $post->setPostImage($target);
            $this->em->persist($post);
            $this->em->flush();
            return $post;
        }
        return false;
    }

    private function setFile(UploadedFile $file = null) {
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

    private function upload() {
        if ($file = $this->request->files->get('media_file')) {
            $this->setFile($file);
            if ($target = $this->getFile()->move('bundles/mrussominiproject/img/', $this->path)) {
                return $target;
            }
            return false;
        }
        return false;
    }

}
