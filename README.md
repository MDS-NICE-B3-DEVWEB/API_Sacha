<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# API_SACHA| Création d'une API avec l'architecture REST

## Informations générales
- Nom du projet : API_SACHA
- Date du projet : 17/01/2024
- Résumé : Création d'une API REST sur Laravel pour avoir des informations détaillé sur les pièces qui se joue à Nice.

## Objectifs de l'API REST
- Offrir des informations détaillées sur les spectacles
- Aider les spectateurs à choisir les spectacles qui correspondent le mieux à leurs goûts.
- Promouvoir la scène théâtrale local
- Favoriser l'échange d'opinions entre les amateurs de théâtre
- Créer une API en respectant l'architecture REST
- Créer une base de données
- Utilisation d'un framework pour l'API REST
- Utilisation de Docker pour l'API REST et la base de données

## Outil utilisé
- [Insomnia] pour tester les fonctionnalités de l'API web
- [Wireshark] pour analyser le trafic réseau
- [Docker]pour exécuter l'API web et la base de données




## Architecture du Projet

### Voici la structure du projet ainsi qu'une brève expliquation des differents dossier et fichier :

#### Modèles (Models) :
- Emplacement : ```app\Models```
- Cette section contient les modèles responsables de la création des différents éléments de l'API.

#### Modèles (Models) :

- Emplacement : app\Http\Requests
- Les règles définissant les validations et les contraintes pour les éléments sont définies dans cette section.

#### Contrôleurs (Controllers) :

- Emplacement : app\Http\Controllers\Api
- Les contrôleurs situés ici et sont chargés de traiter les requêtes en fonction des routes choisies.

#### Requêtes (Requests) :

- Emplacement : app\Http\Requests
- Les règles définissant les validations et les contraintes pour les éléments sont définies dans cette section.

#### Migrations :
- Emplacement : database\migrations
- Les migrations, présentes ici, facilitent la génération des schémas de base de données.


#### Routes de l'API :
- Emplacement : routes\api.php
- Ce fichier contient les définitions des routes de l'API, définissant ainsi le point d'accès pour les différentes fonctionnalités.`

## Routes
### Posts

Permet la gestion des pièces

- Recuperer la liste des pièces :  
``` GET     theatre ```
Rien à écrire

- Ajouter un pièce : 
``` POST    theatre/create ```
à écrire sur le fichier json:
{
"titre"= "titre de la pièce"
"description"="la description"
}

- Editer un pièce : 
``` PUT     theatre/edit/{id} ```
à écrire sur le fichier json:
{
"titre"= "nouveau titre de la pièce"
"description"="nouvelle description"
}


- Suprimer un pièce :
``` DELETE  theatre/delete/{id} ```
Rien à écrire

Permet d'ajouter un commentaire:

- Ajoute un commentaire :
``` POST  /comments```
à écrire sur le fichier json:
{
"note"= 0-5
"commentaire"="votre commentaire"
"theatre_titre" = "le titre de la pièce"
}

Permet de gérer les utilisateurs:

Connecte un utilisateur:
```POST  /login```
à écrire sur le fichier json:
{
"name"="nom"
"email"="votre email"
"password" = "votre mot de passe"
}

Inscrit un utilisateur:
```POST  /register```
à écrire sur le fichier json:
{
"name"="nom"
"email"="votre email"
"password" = "votre mot de passe"
"password_confirmation= "confirmez mot de passe"
}

Supprime un utilisateur:
```DELETE   /delete/{id}```
Rien à mettre sur le json

Modifie un utilisateur:
```UPDATE  /update/{id}```
à écrire sur le fichier json:
{
"name"="nouveau nom"
"email"="nouvel email"
"password" = "nouveau mot de passe"
}

### Comment télécharger le projet :

1. Clonez le projet à parti de github.

   ```bash
      git clone https://github.com/MDS-NICE-B3-DEVWEB/API_FRANCK
    ```

3. Créer une base de données

2. Adapter le fichier `.env` à votre base de données.

   ```bash
      PORT=<port>
      DB_TYPE=<type de votre SGBD mysql,mariadb,postgresql etc...>
      DB_HOST=<votre hôte>
      DB_USER=<utilisateur de votre base de données>
      DB_PASS=<mot de passe de votre base de données>
      DB_NAME=<nom de votre base de données>
    ```



## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
