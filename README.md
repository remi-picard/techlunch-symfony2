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
http://localhost/techlunch-symfony2/web/app_dev.php/fr
<img alt="Page d'accueil" src="screenshots/page-accueil.png" width="600" />

Voir aussi
http://localhost/techlunch-symfony2/web/app_dev.php/fr/blog/

Le premier chargement est assez long, Symfony construit le cache de l'application.


Passer la base de données sqlite à Mysql en modifiant le fichier app/config/parameter.yml en s'inspirant du fichier app/config/parameter.yml.dist
Par exemple
```mon app/config/parameter.yml
parameters:
    database_driver: pdo_mysql
    database_host: 127.0.0.1
    database_port: ~
    database_name: techlunch_symfony2
    database_user: root
    database_password: null
    database_path: null
```

Créer la base de données
```cmd
php app\console doctrine:database:create
```
Mettre à jour le schéma de la base
```cmd
php app\console doctrine:schema:update --dump-sql
php app\console doctrine:schema:update --force
```
Retourner sur http://localhost/techlunch-symfony2/web/app_dev.php/fr/blog/
Il n'y a plus d'article. 

Recharger les données
```cmd
php app/console doctrine:fixtures:load
```
Cette commande est rappelée sur http://localhost/techlunch-symfony2/web/app_dev.php/fr/login

Retourner sur http://localhost/techlunch-symfony2/web/app_dev.php/fr/blog/
Les articles apparaissent à nouveau.

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