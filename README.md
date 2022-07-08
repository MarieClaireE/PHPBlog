# PHPBlog

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/e317bc2492924d81a9b0a305f113c312)](https://app.codacy.com/gh/MarieClaireE/PHPBlog?utm_source=github.com&utm_medium=referral&utm_content=MarieClaireE/PHPBlog&utm_campaign=Badge_Grade_Settings)

BLOG PHP

Projet OpenClassroom : Création d'un blog

**Installation de la base de données**:
- Récupérer le fichier blog.sql dans le dossier sql;
- Créer la base de données `PHPBlog` dans votre serveur; 
- Modifier les informations dans le fichier Public/Core/Cnx.php;
![alt text](Capture d’écran 2022-07-08 à 08.56.30.png);

- Importer les données du fichier blog.sql dans votre base de données;


**Installation du projet** :
 - Dans un premier temps rendez-vous sur le repository PHPBlog et faites : `Télécharger ZIP` : ça va télécharger le dossier sur votre ordinateur en format zip.
 - Dézipper le projet 

**Installation de COMPOSER** : 
- ouvrez un terminal sur le projet et tapez : `composer install`
- ensuite tapez la commande : `npm install`

Le projet est maintenant prêt ! 

**Pour lancer le projet en local** : 
- tapez dans le terminal : `cd public/` et `php -S localhost:8000`