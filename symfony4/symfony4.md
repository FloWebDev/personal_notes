# Notes sur Symfony 4

## Installation de Symfony

**Initialiser un projet**

* Initialiser un projet : `composer init`
* Ajouter une dépendance (vérifier sur https://packagist.org/) : `composer require who/packqge`
* Pour demander à Composer de parcourir le fichier composer.json afin d'installer les pré-requis du projet : `composer install` (voir aussi `composer update`)

## Installer Symfony 4

* Pour un projet web classique : `composer create-project symfony/website-skeleton my_project`
* Pour un microservice, une application/API : `composer create-project symfony/skeleton my_project`
* Pour installer un projet Symfony 3.4 : `composer create-project symfony/framework-standard-edition my_project "3.4.*"`

| Symfony 3 | Symfony 4 |
| - | - |
| web | public |
| app | src |

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
4. Exécuter une migration : `bin/console doctrine:migration:migrate` ou  pour spécifier une migration avec un alias `bin/console doctrine:migration:migrate prev` (alias possibles : first, latest, prev, current and next)

Si reprise d'un projet en cours, effectuer simplement les étapes **1** et **4**.
