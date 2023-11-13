# Contexte
Ce projet fait référence au projet de numérisation de la feuille d'émargement au sien de mon école d'ingénieurs

## Fonctionnement

### Système de pointage
Premièrement, il faut comprendre que ce système est basé sur un pointage avec un lecteur de QR code.
Chaque étudiant possède un QR code unique qu'il viendra pointer 2 fois par jour (une présence le matin, une l'aprem) auprès du QR code.

Le controlleur qui contient le QRCode controle aussi les présences (faux QRcode, multiples présences etc...)
Une fois le contrôle réalisé, il va inscrire le pointage de l'élève dans une BDD dont les données seront accessibles depuis le programme que vous pouvez utiliser.

Voici un schéma qui explique la situation : 

![Cover](https://github.com/agordienproject/pointage_exemple/edit/main/img/schema_fonctionnement.png)


### Environnements utilisés
Pour réaliser ce projet, j'ai utilisé les environnements suivants :
+ Apache
+ Mysql
+ PHP
  
Pour ceux qui sont intéressés, vous pouvez avoir le tout en 1 en téléchargeant par exemple XAMPP via la lien suivant :
#### Lien vers le téléchargement de XAMPP
> https://www.apachefriends.org/fr/download.html

# Utilisation

## Connexion

## Présence du jour

## Liste des élèves

## Historique des présences

# Idées d'amélioration
