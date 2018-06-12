# StadLine Technical Test

### Tache

Le sujet de base est simple : Il faut créer une page sécurisée qui permet à un utilisateur de se loguer et de faire un commentaire sur un dépôt publique d'un utilisateur GitHub.
La fonctionnalité de commentaire n'existe pas sur Github, vous devrez donc stocker et afficher ces commentaires dans votre espace sécurisé.

### Règles

* Le temps est libre mais il est tout de même conseillé de passer moins de 4h sur le sujet (temps de setup d'environnement compris)
* Il est conseillé de finir les points requis avant de s'attaquer au bonus. 
* Il est aussi conseillé de faire un maximum de commit pour bien détailler les étapes de votre raisonnement au cours du développement.
* N'hésitez pas à nous faire des retours et nous expliquer les éventuelles problématiques bloquantes que vous auriez rencontrées durant le développement vous empéchant de finir.

### Setup

* La charte graphique n'est pas imposée et sera jugée en bonus. L'emploi d'un framework CSS type Twitter Bootstrap est fortement conseillé. 
* Vous aurez besoin d'un environnement php5.5, Symfony4 et un serveur pour l'application. 

### Les pré-requis

* Vous êtes libre d'utiliser un bundle d'authentification externe ou votre propre bundle. 
* Le formulaire de connexion doit avoir une validation coté serveur. 
* Toutes les pages doivent être sécurisées et pointer sur la page de login si l'utilisateur n'est pas connecté. 
* Le choix du client HTTP est laissé à discrétion pour appeller l'API de GitHub.
* Une fois connecté, il est nécessaire d'implémenter un champ de recherche qui permette de chercher les utilisateurs GitHub. La documentation est disponible ici : https://developer.github.com/v3/search/#search-users . 
* Vous devez appeller l'API suivante avec q=searchFieldContent :
```
https://api.github.com/search/users
```
* Une fois le champ de recherche validé et l'utilisateur sélectionné, on arrive sur l'url /{username}/comment, on affiche un formulaire qui sera composé des champs suivants : un champ texte pour le nom d'un dépôt ({user}/{repos}, e.g : stadline/sf2-technical-test), un textArea pour le commentaire, un bouton valider permettant d'ajouter un commentaire. 
* On affichera en dessous la liste des commentaires déjà saisis pour l'utilisateur.
* Lors de la validation du formulaire, on vérifiera que le repository sélectionné est bien un dépôt appartenant à l'utilisateur précédement recherché.
* On attend aussi de vous que le code soit testable et testé.

### Bonus

* On changera le choix du dépôt par un multiselect afin de lister directement dans le formulaire les dépôts de l'utilisateur. 
* Utilisation d'un frameworkJS pour afficher les résultats
* Toutes les fonctionnalités que vous aurez le temps d'ajouter seront aussi bonnes à prendre. Un bonus autour de votre créativité pourra être considéré.

### Délivrabilité

* Forkez le projet sur GitHub et codez directement dans le projet forké. 
* Commitez aussi souvent que possible et commentez vos commits pour détailler votre chemin de pensée. 
* Mettez à jour le README pour ajouter le temps passé et tout ce que vous jugerez nécessaire de nous faire savoir. 
* Envoyez le lien avec le projet à recrutement@stadline.com. 

**Bonne chance !**




Mise à jour des bundles
composer install

- Installer les assets
bin/console assets:install --symlink

# Infos
Temps passé ~ 3h30

J'ai du faire une petite pause entre 2, ça se verra surement au niveau des commits.
Mais à part la partie connexion, je n'ai pas vraiment retouché aux fonctionnalités par la suite.

J'ai affiché les commentaires des commits mais je ne suis pas tout à fait sûr que c'est ce qui était demandé.
Je n'ai pas réussi à trouver de fonction permettant d'ajouter des commentaires (normal j'imagine puisqu'il s'agit des commits), ce qui me fait penser que je me suis peu être trompé de "commentaires" et qu'il fallait peu être ajouter des commentaires en BDD et pas via l'API ?

Du coup la validation du formulaire d'ajout de commentaire n'a pas été terminée.
J'aurai pu recherche un peu plus longtemps sur l'API mais j'aurai surement depassé les 4h et comme dit précédemment, je ne suis pas sur d'être parti vers le fonctionnement attendu.

Pareil pour l'utilisation de l'API en loggé pour contourner la limitation du nombre d'appel...

Pour gagner un peu de temps, j'ai utilisé le même template pour toutes les pages, ce qui fait que le champs recherche ne fonctionne que sur la HP ;-) 