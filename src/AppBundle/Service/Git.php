<?php

namespace AppBundle\Service;

class Git {

    const API_SEARCH_URL = "https://api.github.com/search/users?q=";
    const API_USER_URL = "https://api.github.com/users/";
    const API_REPOSITORIES_URL = "https://api.github.com/search/repositories?q=user:";

    const USER_AGENT = "Stadline";

    /**
    * Effectue une recherche sur les utilisateurs
    * @param string $search
    * @return array
    **/
    public function searchUsers($search) {
        $result = $this->executeCurl(Self::API_SEARCH_URL.$search);
        return $result->items ?? array();
    }

    /**
    * Récupère les informations d'un utilisateur
    * @param $user
    * @return StdClass
    **/
    public function findUser($user) {
        return $this->executeCurl(self::API_USER_URL.$user);
    }

    /**
    * Récupère la liste des dépots d'un utilisateur
    * @param string $user
    * @return array
    **/
    public function findRepositories($user) {

        $result = $this->executeCurl(self::API_REPOSITORIES_URL.$user);
        return $result->items ?? array();
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