<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller {

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
}
