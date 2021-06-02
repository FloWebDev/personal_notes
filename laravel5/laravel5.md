# Notes sur Laravel 5

## Notes sur Laravel 5.2
Notes sur Laravel 5 en lien avec le cours que j'ai suivi sur le site OpenClassrooms : **Découvrez le framework PHP Laravel
Ce cours traite de la version 5.2 de Laravel.**

## Installation

### Installer dernière version Laravel

> composer create-project --prefer-dist laravel/laravel projet



Installer version précise Laravel

> composer create-project --prefer-dist laravel/laravel projet "5.2.*"



### Le composant Html

1. Modifier le fichier composer.json

```
"require": {
    "php": ">=5.5.9",
    "laravel/framework": "5.2.*",
    "laravelcollective/html": "5.2.*"
},
```

2. Effectuer une mise à jour de l'installation

`composer update`

3. Modifier le fichier **config/app.php**

    3.1. Providers

    > Collective\Html\HtmlServiceProvider::class,

    3.2 Alias

```
'Form'  => Collective\Html\FormFacade::class,
'Html'  => Collective\Html\HtmlFacade::class,
```


### Permissions

> sudo chown -R user:www-data . && sudo chmod -R 775 storage/ && sudo chmod -R 775 bootstrap/cache/

(au besoin)

> sudo chmod -R 775 resources/files/

## Artisan

### Commandes utiles Artisan

Remove the configuration cache file

> php artisan config:clear

Flush the application cache

> php artisan cache:clear

Clear all compiled view files

> php artisan view:clear

Optimize the framework for better performance

> php artisan optimize

Remove the compiled class file

> php artisan clear-compile 

Créer un contrôleur

> php artisan make:controller SomethingController

Créer une requête (cas des formulaires)

> php artisan make:request SomethingRequest


## BDD

**Configurer le fichier .env**

Créer la table des migrations

> php artisan migrate:install

Créer une migration

> php artisan make:migration create_something_table

Lancer une migration

> php artisan migrate

Annuler la dernière migration effectuée

> php artisan migrate:rollback

Rafraîchissement de toutes les migrations (rollback de toutes les migrations et nouveau lancement de toutes les migrations)

> php artisan migrate:refresh

Supprimer toutes les tables

> php artisan migrate:reset

Créer un modèle

> php artisan make:model something


## RESSOURCE

Créer une ressource

> php artisan make:controller SomethingController --resource

**Les 7 méthodes créées pour une Ressource (ex : utilisateurs) :**
1. index : pour afficher la liste des utilisateurs,
2. create : pour envoyer le formulaire pour la création d'un nouvel utilisateur,
3. store : pour créer un nouvel utilisateur,
4. show : pour afficher les données d'un utilisateur,
5. edit : pour envoyer le formulaire pour la modification d'un utilisateur,
6. update : pour modifier les données d'un utilisateur,
7. destroy : pour supprimer un utilisateur. 

## ROUTE

Pour connaître toutes les routes crées

> php artisan route:list

## AUTHENTIFICATION

Création des vues, controller et routes pour l'authentification

> php artisan make:auth

Le contrôleur **AuthController** est destiné à gérer :
- l'enregistrement des utilisateurs
- la connexion
- la déconnexion

Le contrôleur **PasswordController** est destiné uniquement à permettre la réinitialisation du mot de passe en cas d'oubli par l'utilisateur.

## POPULATION (= FIXTURES)

Lancer la population

> php artisan db:seed

Pour effectuer en bloc une mirgation ET une population
> php artisan migrate --seed

Si message disant que la classe somethingTableSeeder, ou autre, n'est pas trouvée effectuer la commande `composer dumpautoload` et/ou `php artisan optimize`, puis relancer la population.


Laravel dispose de l'outil **tinker** qui permet d'entrer des commandes dans la console et ainsi interagir directement avec l'application. Il faut le démarrer avec la commande :

> php artisan tinker


## Middlewares

Créer un middleware

> php artisan make:middleware Something


## MODEL

Créer un modèle

> php artisan make:model MonModele

Créer un modèle avec création d'une migration

> php artisan make:model MonModele --migrayion

Créer un modèle dans un sous-dossier

> php artisan make:model App\Models\MonModele


## COMMANDE

Créer un nouvelle commande avec Artisan

> php artisan make:console ModelMakeCommand

## DEPLOIEMENT D'UN PROJET LARAVEL

**Modifier le fichier .env**
```
APP_ENV=production
APP_DEBUG=false
```

Si besoin de rendre inaccessible certaines parties du site
- Créer un fichier .htaccess avec
- `Deny from all`

## MAINTENANCE

Mettre en maintenance le site

> php artisan down

Enlever la maintenance du site

> php artisan up

## PROVIDER

Créer un provider

> php artisan make:provider SomethingProvider


## PHPUNIT

Créer un test

> php artisan make:test SomethingTest

Pour obtenir de l'aide sur PHPUNIT

> ./vendor/bin/phpunit -h

Pour exécuter PHPUNIT

> ./vendor/bin/phpunit

## CLE

Générer une clé d'application

> php artisan key:generate

## LISTENER/EVENT


Créer un listener

> php artisan make:listener Something --event=Illuminate\Auth\Events\Login

On donne le nom de l'observateur et celui de l'événement que l'on veut observer (ici Login).


Créer un événement

> php artisan make:event Something
