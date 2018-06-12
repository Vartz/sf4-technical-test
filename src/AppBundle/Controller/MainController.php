<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller {

	const API_URL = "https://api.github.com/search/users";

	/**
	* Affiche la page de connexion
	**/
	public function loginAction(Request $request) {
		return $this->render('default/login.html.twig');
	}

    /**
    * Affiche la HTP
    **/
    public function indexAction(Request $request) {
        return $this->render('default/index.html.twig');
    }

    /**
    * Affiche le menu (LEFT)
    * @param Symfony\Component\HttpFoundation\Request $request
    * @return Symfony\Component\HttpFoundation\Response
    **/
    public function displayLeftNavigationAction(Request $request) {
        return $this->render('default/left_navigation.html.twig');
    }

    public function searchUsersAction(Request $request) {

    	$data['users'] = array();
    	$data['search'] = $request->get('search');
    	if($data['search']) {

	    	$ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, Self::API_URL."?q=".$data['search']);
	        curl_setopt($ch, CURLOPT_USERAGENT, "Stadline");
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	        $result = curl_exec($ch);
	        $result = json_decode($result);

	        $data['users'] = $result->items;
	    }

        return $this->render('default/list_users.html.twig', $data);
    }

    /**
    * Affiche la page utilisateur
    * @param Symfony\Component\HttpFoundation\Request $request
    * @param string $name
    * @return Symfony\Component\HttpFoundation\Response
    **/
    public function userAction(Request $request, $name) {

    	$data = array();
    	return $this->render('default/list_users.html.twig', $data);
    }

}
