<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType as Form;

class MainController extends Controller {

	const API_SEARCH_URL = "https://api.github.com/search/users?q=";
	const API_USER_URL = "https://api.github.com/users/";
	const API_REPOSITORIES_URL = "https://api.github.com/search/repositories?q=user:";

	const USER_AGENT = "Stadline";

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

	        $result = $this->executeCurl(Self::API_SEARCH_URL.$data['search']);
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

    	$repositories = $this->executeCurl(self::API_REPOSITORIES_URL.$name);
    	$data['repositories'] = $repositories->items;
        $data['user'] = $this->executeCurl(self::API_USER_URL.$name);

        $form = $this->createForm(Form::class, new Comment(), array('repositories'=>$repositories));
        $data['form'] = $form->createView();

    	return $this->render('default/user.html.twig', $data);
    }

    /**
    * Récupère les commentaires d'un utilisateur
    * @param Symfony\Component\HttpFoundation\Request $request
    * @param string $user
    * @param string $git
    * @return Symfony\Component\HttpFoundation\Response
    **/
    public function findCommentsAction(Request $request, $user, $git = null) {
    	
        $manager = $this->getDoctrine()->getManager();

        $search['user_target'] = $user;
        if($git) $search['git'] = $git;

    	$data['comments'] = $manager->getRepository('AppBundle:Comment')->findBy($search);

    	return $this->render('default/comments.html.twig', $data);
    }

    /**
    * Valide un commande
    * @param Symfony\Component\HttpFoundation\Request $request
    * @param string $name
    * @return Symfony\Component\HttpFoundation\Response
    **/
    public function sendCommentAction(Request $request, $name) {
    	$form = $request->get('comment');
    	return new JsonResponse(1);
    }

    /**
    * Execute un appel CURL
    **/
    private function executeCurl($url) {

    	$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/vnd.github.cloak-preview'));
	    curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	    $result = curl_exec($ch);
	    return json_decode($result);
    }
}
