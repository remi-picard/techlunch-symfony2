Tech Lunch Symfony 2
====================

Installation
------------
https://symfony.com/download
http://symfony.com/doc/current/book/installation.html

Cloner le repository github https://github.com/symfony/symfony-demo
ou
```cmd
cd C:\wamp\www
php -r "readfile('http://symfony.com/installer');" > symfony
php symfony demo techlunch-symfony2
```

Lancer le serveur HTTP et la base.

Lancer l'application :
http://localhost/techlunch-symfony2/web/fr


Voir aussi
http://localhost/techlunch-symfony2/web/fr/blog/

<img alt="Page d'accueil" src="screenshots/page-accueil.png" width="600" />

Passer la base de données sqlite à Mysql

Ajout d'un bundle
-----
```cmd
cd techlunch-symfony2/
php app\console generate:bundle
```

Génération d'une entité
-----
```cmd
cd symfony-demo/
php app\console generate:doctrine:entity
```

Génération du crud
-----
```cmd
cd symfony-demo/
php app\console generate:doctrine:crud
```


Mise à jour de la base de données
-----
```cmd
php app\console doctrine:schema:update --dump-sql
php app\console doctrine:schema:update --force
```

Le conteneur de service
-----
http://symfony.com/doc/current/book/service_container.html

The service container helps you instantiate, organize and retrieve the many objects of your application.
The container makes your life easier, is super fast, and emphasizes an architecture that promotes reusable and decoupled code.

In large part, the service container is the biggest contributor to the speed and extensibility of Symfony.

Envoyer un mail
-----
http://symfony.com/doc/current/cookbook/email/email.html