<?php

namespace MRusso\LibBundle\Twig;

use Symfony\Component\Templating\Helper\Helper;

class Cloud extends \Twig_Extension {

    protected $router;

    public function __construct($router, $container) {
	$this->router = $router;
	$this->container = $container;
	$this->translator = $container->get('translator');
    }

    public function getName() {
	return 'cloud';
    }

    public function getFunctions() {
	return array(
	    new \Twig_SimpleFunction('cloud', array($this, 'cloud')),
	);
    }

    public function cloud(array $tags = array()) {


	$category = $this->container->get('post')->getPesoPalabra();
	if (!$category) {
	    return;
	}
	$html = '<style>.eldiv{text-align: center;}.tag1{font-size:14px;}.tag2{font-size:15px;}.tag3{font-size:16px;font-weight:bold;}.tag4{font-size:17px;font-weight:bold;}.tag5{font-size:18px;font-weight:bold;}.tag6{font-size:19px;font-weight:bold;}.tag7{font-size:20px;font-weight:bold;}.tag8{font-size:21px;font-weight:bold;}.tag9{font-size:22px;font-weight:bold;}.tag10{font-size:23px;font-weight:bold;}.tag11{font-size:24px;font-weight:bold;}.tag12{font-size:25px;font-weight:bold;}.tag13{font-size:26px;font-weight:bold;}.tag14{font-size:27px;font-weight:bold;}.tag15{font-size:28px;font-weight:bold;}.tag16{font-size:29px;font-weight:bold;}.tag17{font-size:30px;font-weight:bold;}.tag18{font-size:31px;font-weight:bold;}.tag19{font-size:32px;font-weight:bold;}.tag20{font-size:33px;font-weight:bold;}</style>';
	$html .= '<div class="well well-sm">
        <h3 class="">
' . $this->translator->trans('Lo más buscado') . '
        </h3>
    ';

	$html .= '<div class="eldiv">';
	$max = $category['palabra'][0]['score'];
	$min = $category['palabra'][count($category['palabra']) - 1]['score'];
	if ($max > $min) {
	    $total = $max - $min;
	} else {
	    $total = $max;
	}
	$valor = 20;

	asort($category['palabra']);
	foreach ($category['palabra'] as $tag) {

	    $peso = round((($tag['score'] - $min) * $valor) / $total);
	    $html .='<a href="' . $this->container->get('router')->generate('listado_busca', array('palabra' => $tag['title'])) . '" class="tag' . $peso . '">' . $this->translator->trans($tag['title']) . '</a> ';
	}

	$html .= '</div>';
	$html .= '</div>';
	echo $html;
    }

}
