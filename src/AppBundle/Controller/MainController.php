<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType as Form;

class MainController extends Controller {

	/**
	* Affiche la page de connexion
	* @param Symfony\Component\HttpFoundation\Request $request
    * @return Symfony\Component\HttpFoundation\Response
    **/
	public function loginAction(Request $request) {
		return $this->render('default/login.html.twig');
	}

    /**
    * Affiche la HP
    * @param Symfony\Component\HttpFoundation\Request $request
    * @return Symfony\Component\HttpFoundation\Response
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

    /**
    * AJAX : affiche la liste des utlilisateurs trouvés
    * @param Symfony\Component\HttpFoundation\Request $request
    * @return Symfony\Component\HttpFoundation\Response
    **/
    public function searchUsersAction(Request $request) {

    	$data['users'] = array();
    	$data['search'] = $request->get('search');
        
    	if($data['search'])
	        $data['users'] = $this->get('api.git')->searchUsers($data['search']);

        return $this->render('default/list_users.html.twig', $data);
    }

    /**
    * Affiche la page utilisateur
    * @param Symfony\Component\HttpFoundation\Request $request
    * @param string $name
    * @return Symfony\Component\HttpFoundation\Response
    **/
    public function userAction(Request $request, $name) {

    	$data['repositories'] = $this->get('api.git')->findRepositories($name);
        $data['user'] = $this->get('api.git')->findUser($name);

        $session = new Session();
        $session->set('repositories', $data['repositories']);

        $options['repositories'] = $data['repositories'];
        $options['action'] = $this->generateUrl('send_comment');
        $options['method'] = "POST";

        $comment = new Comment();
        $comment->setUserSource($this->getUser()->getUsername());
        $comment->setUserTarget($name);

        $form = $this->createForm(Form::class, $comment, $options);
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
    public function sendCommentAction(Request $request) {

        $session = new Session();
        $options['repositories'] = $session->get('repositories');

        $comment = new Comment();

        $form = $this->createForm(Form::class, $comment, $options);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {

                $comment = $form->getData();

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($comment);
                $manager->flush();
            }
        }

    	return new JsonResponse(1);
    }

}
