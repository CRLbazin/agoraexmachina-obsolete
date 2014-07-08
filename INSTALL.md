Installation d’AGORA Ex Machina - Plateforme de démocratie liquide
=====================================================================

0. Installation d'AGORA Ex Machina
---------------------------------------

Seulement 3 étapes pour faire fonctionner votre application de démocratie liquide : 

* Copier les sources d'AEM sur votre serveur WEB dans un répertoire nommé "agoraexmachina" (sans majuscule, espace, ou autre caractère)
* Paramétrer le fichier de configuration config.xml se trouvant dans le répertoire /applications/config. (Voir paragraphe 1)
* Paramétrer la base de données via le script /documentations/script-installation-database.sql. (Voir paragraphe 2)



1. Paramétrage du fichier de configuration
----------------------------------------------

Le fichier config.xml se trouve dans le répertoire /applications/config. 

Il contient la configuration de base, requise pour faire fonctionner AGORA Ex Machina. 

Il faut compléter les informations de la manière suivante :  

* SQL_HOTE : Adresse Internet (IP) de votre serveur de base de données.
* SQL_PORT : Port utilisé pour dialoguer avec votre base de données. Par défaut 3306.
* SQL_DB : Nom de votre base de données. Par défaut agoraexmachina.
* SQL_USR : Identifiant de connexion à la base de données.
* SQL_PWD : Mot de passe de connexion à la base de données.
* WEBSITE_DNS : Nom de domaine utilisé pour accéder à AEM.
* WEBSITE_ROOT : Répertoire d'installation d'AEM suivi de /web.
* WEBSITE_TITLE : Titre de votre plateforme de démocratie liquide. (Affiché en haut à gauche)
* WEBSITE_SUBTITLE : Sous-titre de votre plateforme de démocratie liquide. (Affiché à la suite du titre en haut à gauche)

Exemple : 
```html
<?xml version="1.0" encoding="iso-8859-1" ?>
<definitions>
	<define var="SQL_HOTE" value="10.234.0.147" />
	<define var="SQL_PORT" value="3306" />
	<define var="SQL_DB" value="agoraexmachina" />
	<define var="SQL_USR" value="loginDbJason" />
	<define var="SQL_PWD" value="motDePasseDbJason" />
	<define var="WEBSITE_DNS" value="www.agoraexmachina-le-site.net" />
	<define var="WEBSITE_ROOT" value="/agoraexmachina/web" />
	<define var="WEBSITE_404" value="/agoraexmachina/web/404" />
	<define var="WEBSITE_TITLE" value="AGORA Ex Machina" />
	<define var="WEBSITE_SUBTITLE" value="Sous titre" />
	<define var="VAR_ENABLE_REDIRECT_404" value="1" />
	<define var="VAR_ENABLE_MAIL_REGISTRATION" value="0" />
	<define var="WEBSITE_EMAIL" value="agoraexmachina@gmail.Com" />	
</definitions>
 
Tips : Si la base de données est hébergée sur le même serveur que le serveur WEB, vous pouvez utiliser 127.0.0.1 pour identifier le serveur local. 
 


2. Création et initialisation de la base de données
-----------------------------------------------------

Pour créer et initialiser les premières données dans AGORA Ex Machina, il faut exécuter le script SQLscript-installation-database.sql se trouvant dans le répertoire  /agoraexmachina/documentations.

Pré-requis : Le script ne va pas créer la base, uniquement les tables. Vous devrez la créer avant d'exécuter le script. 

Ce script initialisera AEM, ses tables, et un compte utilisateur administrateur : 
Nom du compte : admin
Adresse mail du compte : admin@admin.net
Mot de passe du compte : admin


