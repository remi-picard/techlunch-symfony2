# Techlunch Symfony 2

## Installation
[Télécharger Symfony2](https://symfony.com/download)

Cloner le [repository github](https://github.com/symfony/symfony-demo)

ou utiliser l'installeur symfony : 
```cmd
cd C:\wamp\www
php -r "readfile('http://symfony.com/installer');" > symfony
php symfony demo techlunch-symfony2
```

Lancer le serveur HTTP et la base (ex : WAMP).

Lancer l'application :
<http://localhost/techlunch-symfony2/web/app_dev.php/fr>
<img alt="Page d'accueil" src="screenshots/page-accueil.png" width="800" />

Voir aussi
<http://localhost/techlunch-symfony2/web/app_dev.php/fr/blog/>

Le premier chargement est assez long, Symfony construit le cache de l'application.


Passer la base de données sqlite à Mysql en modifiant le fichier app/config/parameter.yml en s'inspirant du fichier app/config/parameter.yml.dist

Exemple de fichier app/config/parameter.yml
``` 
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
Cette commande est rappelée sur <http://localhost/techlunch-symfony2/web/app_dev.php/fr/login>

Retourner sur <http://localhost/techlunch-symfony2/web/app_dev.php/fr/blog/>
Les articles apparaissent à nouveau.

## Mon premier bundle
### Génération en ligne de commande
```cmd
php app\console generate:bundle
```


```cmd
  Welcome to the Symfony2 bundle generator



Your application code must be written in bundles. This command helps
you generate them easily.

Each bundle is hosted under a namespace (like Acme/Bundle/BlogBundle).

Bundle namespace: AbonnementBundle

Keep AbonnementBundle as the bundle namespace (choose no to try again)
? [yes]: yes

Bundle name [AbonnementBundle]:

Target directory [C:\wamp\www\techlunch-symfony2/src]:

Determine the format to use for the generated configuration.

Configuration format (yml, xml, php, or annotation): annotation

To help you get started faster, the command can generate some
code snippets for you.

Do you want to generate the whole directory structure [no]? yes


  Summary before generation


You are going to generate a "AbonnementBundle\AbonnementBundle" bundle
in "C:\wamp\www\techlunch-symfony2/src/" using the "annotation" format.

Do you confirm generation [yes]?


  Bundle generation


Generating the bundle code: OK
Checking that the bundle is autoloaded: OK
Confirm automatic update of your Kernel [yes]?
Enabling the bundle inside the Kernel: OK
Confirm automatic update of the Routing [yes]?
Importing the bundle routing resource: OK


  You can now start using the generated code!
```


### Génération d'une entité Doctrine

```cmd
php app\console generate:doctrine:entity
```


```cmd
  Welcome to the Doctrine2 entity generator



This command helps you generate Doctrine2 entities.

First, you need to give the entity name you want to generate.
You must use the shortcut notation like AcmeBlogBundle:Post.

The Entity shortcut name: AbonnementBundle:Abonne                                                                                             

Determine the format to use for the mapping information.

Configuration format (yml, xml, php, or annotation) [annotation]:

Instead of starting with a blank entity, you can add some fields now.
Note that the primary key will be added automatically (named id).

Available types: array, simple_array, json_array, object,
boolean, integer, smallint, bigint, string, text, datetime, datetimetz,
date, time, decimal, float, binary, blob, guid.

New field name (press <return> to stop adding fields): mail
Field type [string]:
Field length [255]:

New field name (press <return> to stop adding fields): dateEnregistrement
Field type [string]: datetime

New field name (press <return> to stop adding fields):

Do you want to generate an empty repository class [no]? yes


  Summary before generation


You are going to generate a "AbonnementBundle:Abonne" Doctrine2 entity
using the "annotation" format.

Do you confirm generation [yes]?


  Entity generation


Generating the entity code: OK


  You can now start using the generated code!
```


### Mise à jour de la base de données
```cmd
php app\console doctrine:schema:update --dump-sql
```

```cmd
CREATE TABLE Abonne (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, dateEnregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAUL
T CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
```

```cmd
php app\console doctrine:schema:update --force
```

### Génération d'un CRUD
```cmd
php app\console generate:doctrine:crud
```

```cmd
  Welcome to the Doctrine2 CRUD generator



This command helps you generate CRUD controllers and templates.

First, you need to give the entity for which you want to generate a CRUD.
You can give an entity that does not exist yet and the wizard will help
you defining it.

You must use the shortcut notation like AcmeBlogBundle:Post.

The Entity shortcut name: AbonnementBundle:Abonne

By default, the generator creates two actions: list and show.
You can also ask it to generate "write" actions: new, update, and delete.

Do you want to generate the "write" actions [no]? yes

Determine the format to use for the generated CRUD.

Configuration format (yml, xml, php, or annotation) [annotation]:

Determine the routes prefix (all the routes will be "mounted" under this
prefix: /prefix/, /prefix/new, ...).

Routes prefix [/abonne]: /abonnement


  Summary before generation


You are going to generate a CRUD controller for "AbonnementBundle:Abonne"
using the "annotation" format.

Do you confirm generation [yes]?


  CRUD generation


Generating the CRUD code: OK
Generating the Form code: OK


  You can now start using the generated code!
```

L'URL <http://localhost/techlunch-symfony2/web/app_dev.php/abonnement/> est maintenant disponible.

Formulaire d'ajout : 
<img alt="Page d'ajout d'un abonné" src="screenshots/page-abonne-creation.png" width="800" />

Liste des éléments ajoutés :
<img alt="Page de la liste des abonnés" src="screenshots/page-abonne-liste.png" width="800" />


### Ajout de la validation de formulaire


On ajoute les annotations de validation de format, d'unicité et l'ajout d'événement sur l'entité Abonne.

Mettre à jour la base pour prendre en compte la contrainte d'unicité :
```cmd
techlunch-symfony2>php app\console doctrine:schema:update --dump-sql
```

```cmd
CREATE UNIQUE INDEX UNIQ_719E8EC65126AC48 ON abonne (mail);
```

```cmd
techlunch-symfony2>php app\console doctrine:schema:update --force
```

Retourner sur le formulaire http://localhost/techlunch-symfony2/web/app_dev.php/abonnement/new et saisisser une adresse mail déjà existante :


<img alt="Page validation formulaire en erreur" src="screenshots/page-abonne-creation-unicite.png" width="800" />


### Modification des routes

Créer une controleur Abonnement pour la partie ADMIN (/admin/abonnement).
Ne laisser que l'action de création dans le controleur accessible à tous (/abonnement).

Mise à jour des routes du bundle et ajout du contrôleur Abonnement partie ADMIN.

Prise en compte de la locale dans les routes.

Ne pas oublier de renommer toutes les routes pour ne pas avoir de conflits entre les 2 contrôleurs.

On a maintenant l'abonnement accessible à tous via http://localhost/techlunch-symfony2/web/app_dev.php/fr/abonnement/

Et la gestion des abonnés via http://localhost/techlunch-symfony2/web/app_dev.php/fr/admin/abonnement/


### Modification des vues


Modification du layout, des vues et des fichiers traduction


### Ajout d'un service d'envoi de mail

On ajoute un objet de modèle et un service d'envoi de mail. 

Ce service a besoin d'autres services pour pouvoir fonctionner.
C'est le conteneur de services qui se charge de l'instanciation et de l'injection des services.

Enfin, on appelle le service lors de l'ajout d'un article sur le blog.

### Ajout d'un message flash

Suite à l'abonnement, on redirige l'utilisateur sur la liste des billets et on affiche un message de succès. 

## Documentation :
* [Installer Symfony](http://symfony.com/doc/current/book/installation.html)
* [Le conteneur de service](http://symfony.com/doc/current/book/service_container.html)
* [Comment envoyer un mail avec Symfony ?](http://symfony.com/doc/current/cookbook/email/email.html)