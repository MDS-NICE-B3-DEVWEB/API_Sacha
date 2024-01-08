

# API_SACHA| Création d'une API avec l'architecture REST

## Informations générales
- Nom du projet : API_SACHA
- Date du projet : 06/01/2024
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
```
{
"titre"= "titre de la pièce"
"description"="la description"
}
```
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
"email"="votre email qui doit être existant"
"password" = "votre mot de passe de 6 charactères minimum"
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



