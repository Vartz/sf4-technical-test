<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity()
**/
class Comment {

	/**
	* @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    private $id;

    /**
    * @ORM\Column(name="title", type="text")
    **/
    private $title;

    /**
    * @ORM\Column(name="content", type="text")
    **/
    private $content;

    /**
    * @ORM\Column(name="user_source", type="text")
    **/
    private $user_source;

    /**
    * @ORM\Column(name="user_target", type="text")
    **/
    private $user_target;

    /**
    * @ORM\Column(name="git", type="text")
    **/
    private $git;

	// SETTERS
	public function getId()					{ return $this->id; }
	public function getTitle()				{ return $this->title; }
	public function getContent()			{ return $this->content; }
	public function getUserSource()			{ return $this->user_source; }
	public function getUserTarger()			{ return $this->user_target; }
	public function getGit()				{ return $this->git; }

	// SETTERS
	public function setId($id)				{ $this->id = $id; return $this; }
	public function setTitle($title)		{ $this->title = $title; return $this; }
	public function setContent($content)	{ $this->content = $content; return $this; }
	public function setUserSource($user)	{ $this->user_source = $user; return $this; }
	public function setUserTarget($user)	{ $this->user_target = $user; return $this; }
	public function setGit($git)			{ $this->git = $git; return $this; }
}