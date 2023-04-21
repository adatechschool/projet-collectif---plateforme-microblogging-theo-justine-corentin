Snippet
=============

__Authors__ Corentin Monvillers, Justine Rougeulle, Théo Seugé

Projet réalisé dans le cadre de la formation à Ada Tech School en 6 jours

Vous pouvez accéder au projet via ce lien (informations de connexion sur la page d'accueil) :
_ _ _ _ 

Objectifs du projet
---------------
- [x] Appréhender un framework MVC (Laravel 8)
- [x] Utiliser un gestionnaire de conteneurs (Docker)
- [x] Utiliser un ORM
- [x] Manipuler un moteur de templates (Blade)
- [x] Interagir avec une base de données (Supabase)


Features & réalisations
---------------
* Implémentation de la partie authentification avec Breeze (page login, register, édition du profil)
* Création de la base de données relationnelle (users, posts, etc.)
* Création d'un formulaire pour la publication de posts par l'utilisateur connecté
* Création d'une page affichant les informations et les posts de l'utilisateur connecté ("Wall")
* Création des pages pour afficher les posts des autres utilisateurs lorsqu'on clique sur leur nom
* Page de visualistion de tous les posts de la plateforme ("Explore")
* Implémentation d'un bouton "load more" pour afficher plus de posts
* Barre de recherche (pour les noms des utilisateurs uniquement)
* Fonction "like" / "unlike" sur les posts + affichage du noombre de likes sur les posts
* Fonction "suppression" pour les posts créés par l'utilisateur connecté
* Fonction "s'abonner" / "se désabonner" sur les posts et profils des autrs utilisateurs
* Création d'une page affichant les posts des utilisateurs auxquels on est abonné ("Feed")
* Customisation du design Laravel, création de logo (home + navbar), ajout d'un favicon


Pistes d'amélioration
---------------
* Ajouter une fonction "commentaires"
* Ajouter une fonction "hashtags"
* Ajouter une fonction pour que l'utilisateur connecté puisse modifier ses posts
* Améliorer la barre de recherche pour accéder à d'autres éléments sur la plateforme (posts, biographies, hashtags, etc.)
* Ajouter dans le dropdown menu une section pour visualiser les abbonements et abonnés de l'utilisateur connecté
* Implémenter un moteur de recommandations 
* Mettre en place des tests unitaires et tests navigateur

Photos du projet 
---------------

Page Register :
<img width="1416" alt="register" src="https://user-images.githubusercontent.com/115532914/233619039-fb571ffd-86c3-4873-a022-94ad0f0df1b3.png">

Page Login :
<img width="1416" alt="login" src="https://user-images.githubusercontent.com/115532914/233619111-da6c3ed0-c9b7-4480-8808-2305f38326ff.png">

Page Explore :
<img width="1416" alt="explore" src="https://user-images.githubusercontent.com/115532914/233619142-2403f9d6-ae92-4927-af07-9b37a9d785d0.png">

Page Wall (autre utilisateur) :
 <img width="1416" alt="wall_user" src="https://user-images.githubusercontent.com/115532914/233619428-4d2c0401-bcbd-4063-945c-e5a3b68456da.png">

Page Dashboard :
<img width="1417" alt="dashboard" src="https://user-images.githubusercontent.com/115532914/233619457-80590cd0-71cf-4ceb-b2f5-0c89f971b4fc.png">
