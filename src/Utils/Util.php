<?php namespace App\Utils;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Session\Session;

class Util {

    private $client;
    private $user;
    public function __construct()
    {

	$dotenv = new Dotenv();
	$dotenv->load(__DIR__.'/../../.env');

	$this->client = new \ConfigCat\ConfigCatClient(getenv('CONFIGCAT_APIKEY'));
	$this->user = new \ConfigCat\User(substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10));
    }

    /* Function to get the renderer options for the routing name/type */
    public function routing_options($route){
	if($route == 'index'){
	        $response_array = [
			'assets_host' => 'https://assets-cdn.ratelimited.me/website',
			'cookieNotice' => $this->client->getValue("cookieNotice", true),
			'tagline' => $this->client->getValue("tagline", "Default", $this->user),
			'secondaryTagline' => $this->client->getValue("secondaryTagline", "Default"),
			'thirdTagline' => $this->client->getValue("thirdTagline", "Default"),
		];
		return $response_array;
	}elseif($route == 'about'){
		$response_array = [
			'assets_host' => 'https://assets-cdn.ratelimited.me/website'
		];
		return $response_array;
	}elseif($route == 'pricing'){
		$response_array = [
			'assets_host' => 'https://assets-cdn.ratelimited.me/website',
			'freeUploadLimit' => $this->client->getValue("freeUploadLimit", "500MB"),
			'premiumUploadLimit' => $this->client->getValue("premiumUploadLimit", "1GB"),
			'deluxeUploadLimit' => $this->client->getValue("deluxeUploadLimit", "5GB"),
			'premiumPrice' => $this->client->getValue("premiumPrice", 5.99),
			'deluxePrice' => $this->client->getValue("deluxePrice", 11.99),
			'premiumApiKeys' => $this->client->getValue("premiumApiKeys", 10),
			'deluxeApiKeys' => $this->client->getValue("deluxeApiKeys", "Unlimited"),
			'premiumUsersPerBucket' => $this->client->getValue("premiumUsersPerBucket", 8),
			'deluxeUsersPerBucket' => $this->client->getValue("deluxeUsersPerBucket", 16),
			'premiumPrivateDomains' => $this->client->getValue("premiumPrivateDomains", 2),
			'deluxePrivateDomains' => $this->client->getValue("deluxePrivateDomains", "Unlimited"),
		];
		return $response_array;
	}else{
		$response_array = [
			'' => ''
		];
		return $response_array;
	}
    }
}
