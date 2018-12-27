# Notes sur Symfony 4

## Installation de Symfony

**Installer Composer**

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"
```

Vérifier les lignes à copier/coller dans le Terminal directement sur le site Composer : https://getcomposer.org/download/

Si besoin, en cas de changement de version de PHP ou réinstallation de Composer : `composer clear-cache`

**Initialiser un projet**

* Initialiser un projet : `composer init`
* Ajouter une dépendance (vérifier sur https://packagist.org/) : `composer require who/packqge`
* Pour demander à Composer de parcourir le fichier composer.json afin d'installer les pré-requis du projet : `composer install` (voir aussi `composer update`)

## Installer Symfony 4

* Pour un projet web classique : `composer create-project symfony/website-skeleton my_project`
* Pour un microservice, une application/API : `composer create-project symfony/skeleton my_project`
* Pour installer un projet Symfony 3.4 : `composer create-project symfony/framework-standard-edition my_project "3.4.*"`

## Démarrer un serveur en local

* `bin/console server:run` ou `php bin/console server:run` (la mention php est facultative)
* Pour arrêter le serveur : **Ctrl + C** dans le Terminal

## Créer un controller

* `bin/console make:controller`

## Debug pour les routes

`bin/console debug:router`

## Exemple d'une route en annotation avec @ParamConverter

```
    /**
     * @Route("/movie/{movie_id}/person/{person_id}", name="casting", methods={"GET","POST"})
     * @ParamConverter("movie", options={"mapping": {"movie_id": "id"}})
     * @ParamConverter("person", options={"mapping": {"person_id": "id"}})
     */
    public function casting(Movie $movie, Person $person, EntityManagerInterface $em)
    {
        // TODO

        return $this->render('default/index.html.twig', [
            // TODO
        ]);

        // ou
        // return $this->redirectToRoute('homepage');
    }
```

## Créer une base de données et des entités

1. Après avoir renseigné les informations dans le fichier **.env** : `bin/console doctrine:database:create`
2. Créer ou mettre à jour une entité : `bin/console make:entity` avec si besoin `bin/console make:entity --help` et pour écraser toutes les méthode existantes : `bin/console make:entity --regenerate --overwrite`
3. Créer une nouvelle migration basée sur les changements de la BDD : `bin/console make:migration`
4. Exécuter une migration : `bin/console doctrine:migration:migrate` ou  pour spécifier une migration avec un alias `bin/console doctrine:migrations:migrate prev` (alias possibles : first, latest, prev, current and next)

Si reprise d'un projet en cours, simplemen effectuer l'étape **1** et **4**.