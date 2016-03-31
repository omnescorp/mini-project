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
                ->orderBy('post.postDate', 'desc')
        ;
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

    public function getCountAll() {
        $query = 'select count(*) as total from post;';
        return $this->noCache()->execute($query);
    }
    public function getCountView($post_id = null) {
        $query = 'select sum(post.post_view) as total from post ';
        if($post_id){
            $query .= ' where post.id = '.$post_id;
        }
        return $this->noCache()->execute($query);
    }

    public function create($post = null) {
        $date = new \DateTime("now");

        if (!$post) {
            $post = new $this->entity;
        }
        $post
                ->setPostTitle($this->request->get('post_title'))
                ->setPostDate($date)
                ->setPostStatus(1)
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
        $types = array(
            'image/jpeg',
            'image/png',
            'image/gif'
            );
        $this->file = $file;
        if(!in_array($file->getClientMimeType(),$types)){
            return false;
        }
        
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = $this->file->getClientOriginalName();
        }
        return true;
    }

    public function getFile() {
        return $this->file;
    }

    private function upload() {
        if ($file = $this->request->files->get('media_file')) {
            
            if ($this->setFile($file) && $target = $this->getFile()->move('bundles/mrussominiproject/img/', $this->path)) {
                return $target;
            }
            return false;
        }
        return false;
    }

}
