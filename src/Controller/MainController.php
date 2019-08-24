<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Utils\Util;
use App\Utils\PageRenderer;

class MainController extends AbstractController {

    private $dbconn;
    private $util;
    private $page_renderer;

    public function __construct()
    {
        $this->util = new Util();
        $this->page_renderer = new PageRenderer();
    }

    /**
	* Matches /
	*
	* @Route("/", name="main_page")
    */

    public function main_page(Request $request)
    {
	return new Response($this->page_renderer->renderPage('index', $this->util->routing_options('index')));
    }

    /**
	* Matches /about
	*
	* @Route("/about", name="about")
    */

    public function about(Request $request)
    {
	return new Response($this->page_renderer->renderPage('about', $this->util->routing_options('about')));
    }

    /**
	* Matches /pricing
	*
	* @Route("/pricing", name="pricing")
    */

    public function pricing(Request $request)
    {
	return new Response($this->page_renderer->renderPage('pricing', $this->util->routing_options('pricing')));
    }

    /**
	* Matches /login
	*
	* @Route("/signin", name="signin")
	* @Route("/signup", name="signup")
    */
    public function signin(Request $request)
    {
	$response = new Response(json_encode([
		'success' => false,
		'message' => 'This route is still being worked on',
	]));
	$response->headers->set('Content-Type', 'application/json');
	return $response;
    }
}

