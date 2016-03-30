<?php

namespace MRusso\LibBundle\Twig;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Templating\Helper\Helper;

/**
 * Clase que gestiona los elementos de Seo en la página
 */
class Seo extends \Twig_Extension implements \Twig_Extension_GlobalsInterface {
    /*
     * title y meta title
     * @var string
     */

    private $title;

    /*
     * description
     * @var string
     */
    private $description;

    /*
     * meta keywords
     * @var string
     */
    private $keywords;

    /*
     * meta D.C. date
     * @var \DateTime
     */
    private $date;

    /*
     * meta robots
     * @var string
     */
    private $robots;

    /**
     * url de la imagen para los metas open graph image y twitter image
     * @var
     */
    private $image;

    /**
      -    * Peticion http
     * @var Request
     */
    private $request;

    /**
     * activa o no el link canonical
     * @var bool
     */
    private $printCanonical = true;
    private $canonicalParams = array();

    /**
     * paginacion
     * @var Pagination
     */
    private $pagination;
    private $openGraph = false;

    /**
     * meta open graph type
     * @var string
     */
    private $openGraphType;

    /**
     * Activar o no los metas twitter card
     * @var string
     */
    private $twitterCard = false;

    /**
     * meta twitter acount site
     * @var
     */
    private $twitterAccount;

    /**
     * meta twitter creator
     * @var string
     */
    private $twitterCreator;

    /**
     * meta twitter domain
     * @var string
     */
    private $twitterDomain;

    /**
     * Activar o no los metas article
     * @var string
     */
    private $article = false;

    /**
     * meta article fecha de publicacion en formato yyyymmddhhiiss
     * @var DateTime
     */
    private $articleDatePublished;

    /**
     * meta article fecha de modificacion en formato ISO 8601 Por. ej: 2004-02-12T15:19:21+00:00
     * @var DateTime
     */
    private $articleDateModified;

    /**
     * meta article section
     * @var string
     */
    private $articleSection;

    /**
     * meta article tag
     * @var string
     */
    private $articleTag;

    /**
     * router interface
     * @var RouterInterface
     */
    private $router;

    /**
     * author id
     * @var string
     */
    private $author;

    /**
     * og_video
     * @var string
     */
    private $og_video;

    /**
     * og_video_secure
     * @var string
     */
    private $og_video_secure;

    /**
     * og_video_type
     * @var string
     */
    private $og_video_type;

    /**
     * og_video_wigth
     * @var integer
     */
    private $og_video_width;

    /**
     * og_video_height
     * @var integer
     */
    private $og_video_height;

    /**
     * @var string
     */
    private $twitter_image;

    /**
     * @var string
     */
    private $twitter_image_src;

    /**
     * @var string
     */
    private $twitter_player;

    /**
     * @var integer
     */
    private $twitter_player_width;

    /**
     * @var integer
     */
    private $twitter_player_height;

    /**
     * @var boolean
     */
    private $metaRefresh;

    /**
     * Constructor
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router) {
        $this->router = $router;
    }

    /**
     * Setter Request
     * @param Request $request
     */
    public function setRequest(RequestStack $request_stack) {
        $this->request_stack = $request_stack;
        $this->request = $request_stack->getCurrentRequest();
        return $this;
    }

    protected function getRequest() {
        $this->request = $this->request_stack->getCurrentRequest();
        return $this->request;
    }

    /**
     * Getter Pagination
     * @return Pagination
     */
    public function getPagination() {
        return $this->pagination;
    }

    /**
     * Setter Pagination
     * @param Pagination $pagination
     * @return Seo
     */
    public function setPagination($paginator = null) {
        $this->pagination['prev'] = null;
        $this->pagination['next'] = null;
        $page = $paginator['current_page_number'];
        $max_page = $paginator['count_page'];
        if ($page > 1) {
            $this->pagination['prev'] = $this->router->generate($this->getRequest()->get('_route'), array_merge($this->getRequest()->get('_route_params'), array('page' => ($page - 1 < 1 ? 1 : $page - 1))), 0);
        }
        if ($page < $max_page) {
            $this->pagination['next'] = $this->router->generate($this->getRequest()->get('_route'), array_merge($this->getRequest()->get('_route_params'), array('page' => ($page + 1 <= $max_page ? $page + 1 : $page))), 0);
        }
        return $this;
    }

    /**
     * setter printCanonical
     * @param bool $printCanonical
     * @return $this
     */
    public function printCanonical($printCanonical = true) {
        $this->printCanonical = $printCanonical;

        return $this;
    }

    /**
     * getter canonicalParams
     * @return array
     */
    public function getCanonicalParams() {
        return $this->canonicalParams;
    }

    /**
     * setter canonicalParams
     * @param array $canonicalParams
     * @return $this
     */
    public function setCanonicalParams(array $canonicalParams) {
        $this->canonicalParams = $canonicalParams;

        return $this;
    }

    /**
     * getter title y meta title
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * setter title y meta title
     * @param $title
     * @return $this
     */
    public function setTitle($title) {
        $this->title = strip_tags($title);

        return $this;
    }

    /**
     * getter meta description
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * setter meta description
     * @param $description
     * @return $this
     */
    public function setDescription($description) {
        $this->description = strip_tags($description);

        return $this;
    }

    /**
     * getter meta keywords
     * @return string
     */
    public function getKeywords() {
        return $this->keywords;
    }

    /**
     * setter meta keywords
     * @param $keywords
     * @return $this
     */
    public function setKeywords($keywords) {
        $this->keywords = strip_tags($keywords);

        return $this;
    }

    /**
     * getter meta D.C.date.issued
     * @return DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setDate(\DateTime $date) {
        $this->date = $date;

        return $this;
    }

    /**
     * getter meta robots
     * @return string
     */
    public function getRobots() {
        return $this->robots;
    }

    /**
     * setter meta robots
     * @param $robots
     * @return $this
     */
    public function setRobots($robots) {
        $this->robots = $robots;

        return $this;
    }

    /**
     * getter meta open graph image y twitter image
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * setter meta open graph image y twitter image
     * @param $image string
     * @return $this
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * getter meta article fecha primera publicacion
     * @return DateTime
     */
    public function getArticleDatePublished() {
        return $this->articleDatePublished;
    }

    /**
     * setter meta article fecha primera publicacion
     * @param $articleDatePublished DateTime
     * @return $this
     */
    public function setArticleDatePublished($articleDatePublished) {
        $this->articleDatePublished = $articleDatePublished;

        return $this;
    }

    /**
     * getter meta article fecha ultima modificacion
     * @return DateTime
     */
    public function getArticleDateModified() {
        return $this->articleDateModified;
    }

    /**
     * setter meta article fecha ultima modificacion
     * @param $articleDateModified DateTime
     * @return $this
     */
    public function setArticleDateModified($articleDateModified) {
        $this->articleDateModified = $articleDateModified;

        return $this;
    }

    /**
     * getter meta article section
     * @return string
     */
    public function getArticleSection() {
        return $this->articleSection;
    }

    /**
     * setter meta article section
     * @param $articleSection
     * @return $this
     */
    public function setArticleSection($articleSection) {
        $this->articleSection = $articleSection;

        return $this;
    }

    /**
     * getter meta article tag
     * @return string
     */
    public function getArticleTag() {
        return $this->articleTag;
    }

    /**
     * setter meta article tag
     * @param $articleTag
     * @return $this
     */
    public function setArticleTag($articleTag) {
        $this->articleTag = $articleTag;

        return $this;
    }

    /**
     * getter meta twitter site account
     * @return string
     * Retorna true si los metas article estan activados y false en caso contrario
     * @return bool
     */
    public function getTwitterAccount() {
        return $this->twitterAccount;
    }

    /**
     * setter meta twitter site account
     * @param string $twitterAccount
     * getter meta article
     * @return bool
     */
    public function setTwitterAccount($twitterAccount = null) {
        $this->twitterAccount = $twitterAccount;

        return $this;
    }

    /**
     * Retorna true si los metas article estan activados y false en caso contrario
     * @return bool
     */
    public function isArticle() {
        return $this->article;
    }

    /**
     * getter meta article
     * @return bool
     */
    public function getArticle() {
        return $this->article;
    }

    /**
     * setter meta article
     * @param bool $article
     * @return Seo
     */
    public function setArticle($article = true) {
        $this->article = $article;

        return $this;
    }

    /**
     * getter meta twitter creator
     * @return string
     */
    public function getTwitterCreator() {
        return $this->twitterCreator;
    }

    /**
     * setter meta twitter creator
     * @param $twitterCreator
     * @return Seo
     */
    public function setTwitterCreator($twitterCreator) {
        $this->twitterCreator = $twitterCreator;

        return $this;
    }

    /**
     * getter meta twitter domain
     * @return string
     */
    public function getTwitterDomain() {
        return $this->twitterDomain;
    }

    /**
     * setter meta twitter domain
     * @param $twitterDomain
     * @return Seo
     */
    public function setTwitterDomain($twitterDomain) {
        $this->twitterDomain = $twitterDomain;

        return $this;
    }

    /**
     * getter metas twitter card
     * @return bool
     */
    public function getTwitterCard() {
        return $this->twitterCard;
    }

    /**
     * setter metas twitter card
     * @param bool $twitterCard
     * @return Seo
     */
    public function setTwitterCard($twitterCard = true) {
        $this->twitterCard = $twitterCard;

        return $this;
    }

    /**
     * getter open graph
     * @return bool
     */
    public function getOpenGraph() {
        return $this->openGraph;
    }

    /**
     * setter open graph
     * @param bool $openGraph
     */
    public function setOpenGraph($openGraph = true) {
        $this->openGraph = $openGraph;

        return $this;
    }

    /**
     * getter meta open graph type
     * @return string
     */
    public function getOpenGraphType() {
        return $this->openGraphType;
    }

    /**
     * setter meta open graph type
     * @param $openGraphType
     * @return Seo
     */
    public function setOpenGraphType($openGraphType) {
        $this->openGraphType = $openGraphType;

        return $this;
    }

    public function setCanonical($canonical) {
        $this->canonical = $canonical;

        return $this;
    }

    /**
     * getter link canonical
     * @return null o link canonical
     */
    public function getCanonical($_locale = 'es') {
        if (!$this->printCanonical || null === $this->request) {
            return null;
        } elseif (!array_diff($this->request->query->keys(), $this->canonicalParams)) {
            // Si se activa este return, el canonical no se muestra si es idéntico a la url
//            return null;
        }
        //TODO: En el caso excepción, no hay route. Entonces no consigue comprobar el route existente.
        if (!$this->request->attributes->get('_route')) {
            return null;
        }
        $route = $this->request->attributes->get('_route') . '.' . $_locale;
        $routeParams = $this->request->attributes->get('_route_params');

        foreach ($this->canonicalParams as $param) {
            if ($this->request->query->has($param)) {
                $routeParams[$param] = $this->request->query->get($param);
            }
        }

        return $this->router->generate($route, $routeParams, 0);
    }

    /**
     * Retorna true si los metas open graph estan activados y false en caso contrario
     * @return bool
     */
    public function isOpenGraph() {
        return $this->openGraph;
    }

    /**
     * Retorna true si los metas twitter card estan activados y false en caso contrario
     * @return bool
     */
    public function isTwitterCard() {
        return $this->twitterCard;
    }

    /**
     * Insertar el ID de autor
     * @param string
     * @return Seo
     */
    public function setAuthor($author) {
        $this->author = $author;

        return $this;
    }

    /**
     * Retorna el ID del author
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setOgVideo($val) {
        $this->og_video = $val;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOgVideo() {
        return $this->og_video;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setOgVideoSecure($val) {
        $this->og_video_secure = $val;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOgVideoSecure() {
        return $this->og_video_secure;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setOgVideoType($val) {
        $this->og_video_type = $val;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOgVideoType() {
        return $this->og_video_type;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setOgVideoWidth($val) {
        $this->og_video_width = $val;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOgVideoWidth() {
        return $this->og_video_width;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setOgVideoHeight($val) {
        $this->og_video_height = $val;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOgVideoHeight() {
        return $this->og_video_height;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setTwitterImageSrc($val) {
        $this->twitter_image_src = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getTwitterImageSrc() {
        return $this->twitter_image_src;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setTwitterPlayer($val) {
        $this->twitter_player = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getTwitterPlayer() {
        return $this->twitter_player;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setTwitterPlayerWidth($val) {
        $this->twitter_player_width = $val;
        return $this;
    }

    /**
     * @return int
     */
    public function getTwitterPlayerWidth() {
        return $this->twitter_player_width;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setTwitterPlayerHeight($val) {
        $this->twitter_player_height = $val;
        return $this;
    }

    /**
     * @return int
     */
    public function getTwitterPlayerHeight() {
        return $this->twitter_player_width;
    }

    /**
     * @param $val
     * @return Seo
     */
    public function setTwitterImage($val) {
        $this->twitter_image = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getTwitterImage() {
        return $this->twitter_image;
    }

    /**
     * @param bool|true $metaRefresh
     * @return $this
     */
    public function setMetaRefresh($metaRefresh = true) {
        $this->metaRefresh = $metaRefresh;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMetaRefresh() {
        return $this->metaRefresh;
    }

    public function getName() {
        return 'seo';
    }

    public function getGlobals() {
        return array(
            'seo' => $this,
        );
    }

}
