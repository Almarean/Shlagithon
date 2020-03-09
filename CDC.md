# Cahier des charges


## Equipe

* Ludovic FEBVRE
* Paul MICHELS
* Thomas LAURE


## Problématiques

Des personnes souhaitent disposer d'une plateforme en ligne leur permettant de chercher / proposer / consulter / utiliser gratuitement des recettes.

Les problématiques rencontrées sont :

* Comment gérer simplement la publication de recettes ?
* Comment accéder rapidement à des recettes grâce à des tags ?
* Comment gagner du temps sur la préparation de recettes ?


## Besoins

Les besoins qui en découlent sont les suivants :
* Pour les administrateurs, contrôler les recettes publiées (les valider ou les refuser).
* Pour les administrateurs, gérer les comptes utilisateurs.
* Pour les visiteurs, consulter les recettes.
* Pour les membres, proposer des recettes.
* Pour les membres, mettre des recettes en favoris.
* Pour les visiteurs, avoir accès à la difficulté de réalisation d'une recette.
* Pour les visiteurs, avoir accès à la liste des allergènes de chaque recette.
* Pour les visiteurs, rechercher simplement des recettes.
* Pour les membres, accéder aux coordonnées de contact des administrateurs du site.
* Pour les membres, confirmer leur inscription depuis un lien envoyé par mail.


## Solutions fonctionnelles

D'un point de vue fonctionnel, ces besoins sont traduits par :
* Une interface visiteur qui permet de visualiser des recettes sans avoir à se connecter et d'en rechercher une spécifiquement.
* Une interface membre qui permet de poster des recettes, d'y ajouter des ingrédients, des allergènes, des prérequis, un niveau de difficulté et un temps estimé pour cette recette.
* Une interface d'administration qui permet de gérer les membres, les recettes, les ingrédients, les allergènes.
* Une interface d'enregistrement pour les personnes souhaitant devenir membre du site.
* Avoir un espace de connexion pour les personnes voulant poster des recettes et les mettre en favoris.
* Une interface qui propose, selon un ingrédient ou non, une recette aléatoire dans le cas où la personne manque d'inspiration.
* Une interface de contact avec le staff qui permet aux membres de faire remonter des problèmes concernant le site.
* Une interface visiteur qui renseigne les coordonnées des contacts de l'équipe qui gère le site de recette.
* Une interface d'administration qui affiche l'ensemble des membres permettant de les modifier et de les supprimer.
* Une interface d'administration qui affiche l'ensemble des recettes et permettant de les modifier et de les supprimer.


## Solutions techniques

Les étudiants qui vont travailler sur cette solution vont utiliser l'environnement suivant :
* HTML5 / CSS3 / JavaScript
* [PHP](https://www.php.net/) : Langage de programmation coté serveur
* [jQuery](https://jquery.com/) : Framework JavaScript simplifiant le parcours et l'exploitation du DOM.
* [Twig](https://twig.symfony.com/doc/2.x/) : Moteur de template
* [Bootstrap](https://getbootstrap.com/) : Framework CSS et JavaScript permettant de créer plus facilement des interfaces web responsives et mobile-first
* [Composer](https://getcomposer.org/) : Gestionnaire de dépendances pour PHP
* [MariaDB](https://mariadb.org/) : SGBD pour le stockage et la manipulation, solution gratuite et performante pour réaliser des opérations sur les données. Se déploie facilement.
* [Git](https://git-scm.com/) : Gestionnaire de versions permettant d'entériner les modifications fonctionnelles apportées à la solution, et de revenir à des versions précédentes si besoin.

Cet environnement permet d'assurer aux développeurs un développement plus rapide de la solution, mais également une maintenance et une évolutivité plus aisées.


## Livrables

Les développeurs livreront les éléments suivants :
* Les documents permettant la bonne compréhension de la base de données et le fonctionnement de l'application (MCD, MLD, diagramme de classes UML)
* Les documents décrivant l'intégralité du projet et son processus (note de cadrage, planning détaillé, identité visuelle)
* Le cahier des charges qui permettra aux utilisateurs de comprendre le fonctionnement global de la solution.
* La solution demandée.

De manière générale les normes de développement des technologies utilisées et de conception de la base de données seront respectées.


## Workflow

Le workflow choisi est le [Gitflow](https://buddy.works/blog/5-types-of-git-workflows#gitflow). Chaque feature aura sa propre branche et partira de la branche develop. Cette dernière sera poussée sur la branche master à chaque fin de sprint après avoir validé tous les tests nécessaires.

## Possibilités d'évolution
* Espace premium qui permet d'accéder à des recettes de chefs et leurs conseils.
* Possibilité de laisser des notes sur les recettes.
* Calcul des proportions en fonction du nombre de personnes.