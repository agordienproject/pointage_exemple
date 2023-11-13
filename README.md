# Contexte
Ce projet fait référence au projet de numérisation de la feuille d'émargement au sien de mon école d'ingénieurs

## Fonctionnement

### Système de pointage
Premièrement, il faut comprendre que ce système est basé sur un pointage avec un lecteur de QR code.
Chaque étudiant possède un QR code unique qu'il viendra pointer 2 fois par jour (une présence le matin, une l'aprem) auprès du QR code.

Le controlleur qui contient le QRCode controle aussi les présences (faux QRcode, multiples présences etc...)
Une fois le contrôle réalisé, il va inscrire le pointage de l'élève dans une BDD dont les données seront accessibles depuis le programme que vous pouvez utiliser.

Voici un schéma qui explique la situation : 

![image](./img/schema_fonctionnement.png)

Pour voir le programme du controlleur, vous pouvez y accéder en allant vers ce lien [controlleur](./private/controller.py)
### Environnements utilisés
Pour réaliser ce projet, j'ai utilisé les environnements suivants :
+ Apache
+ Mysql
+ PHP
  
Pour ceux qui sont intéressés, vous pouvez avoir le tout en 1 en téléchargeant par exemple XAMPP via la lien suivant :
#### Lien vers le téléchargement de XAMPP
> https://www.apachefriends.org/fr/download.html

Pour cette exemple de projet, vous n'avez pas besoin d'utiliser une BDD ou Apache, seul PHP est nécessaire.

Lien pour télécharger PHP : 

> https://www.php.net/downloads.php

# Utilisation

## Lancement du serveur PHP

Avant d'ouvir votre fichier html, placez vous dans le dossier principale (pointage_exemple) et lancez la commande suivante : 

`php -S localhost:8000`

Cette commande va lancer un serveur PHP, cliquez sur le lien généré pour découvrir le projet.

## Connexion

Pour accéder aux présences, il vous faut d'abord vous connecter, car il y a un minimum de sécurité.
Pour vous connecter, utilisez celui-ci :
+ Utilisateur : admin
+ mot de passe : admin

Vous pouvez retrouver la liste des noms d'utilisateurs et les mots de passses (chiffrés) qui sont stockés dans [data](data/data-admin.php)

Il est évident que ces données dans le projet réel sont stockées en Base et que le mot de passe est chiffré, vous ne pouvez pas y accéder aussi facilement.

## Présence du jour

La fonctionnalité de présence du jour n'est pas très intéressante dans cet exemple puisqu'elle utilise des données brutes qui ne peuvent pas être mises à jour facilement, mais vous pouvez tout de même y accéder.
Pour ce faire sélectionnez la promotion que vous souhaitez observer, puis cliquez sur le bouton "Accéder aux présences du jour" :

![image](./img/ecran_accueil.png)

Une fois le formulaire validé, vous basculerez vers une page php qui récapitule les présences des étudiants du jour sur la promotion choisie.

![image](./img/ecran_presence.png)


## Liste des élèves

## Historique des présences

# Idées d'amélioration
