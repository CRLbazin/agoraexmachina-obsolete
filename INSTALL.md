Installation d’AGORA Ex Machina - Plateforme de démocratie liquide
=====================================================================

0. Installation d'AGORA Ex Machina
---------------------------------------

Seulement 3 étapes pour faire fonctionner votre application de démocratie liquide : 

* Le paramétrage des fichiers de configuration config.xml et routes.xml se trouvant dans le répertoire /applications/config.
* Le paramétrage de la base de données via le script /documentations/script-installation-database.sql.



1. Paramétrage des fichiers de configuration
----------------------------------------------

Les fichiers config.xml et routes.xml se trouvent dans le répertoire /applications/config. 

Le fichier config.xml contient la configuration de base requise pour faire fonctionner AGORA Ex Machina. 

Il faut compléter les informations de la manière suivante :  

* SQL_HOTE : Adresse Internet (IP) de votre serveur de base de données.
* SQL_PORT : Port utilisé pour dialoguer avec votre base de données. Par défaut 3306.
* SQL_DB : Nom de votre base de données. Par défaut agoraexmachina.
* SQL_USR : Identifiant de connexion à la base de données.
* SQL_PWD : Mot de passe de connexion à la base de données.
* WEBSITE_DNS : Nom de domaine utilisé pour accéder à AEM.
* WEBSITE_ROOT : Racine d'AEM sur votre serveur web.
* WEBSITE_TITLE : Titre de votre plateforme de démocratie liquide. Est affiché en haut à gauche.
* WEBSITE_SUBTITLE : Sous-titre de votre plateforme de démocratie liquide. Est affiché à la suite du titre.

Exemple : 
***********
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
 
Si la base de données est hébergée sur le serveur WEB, vous pouvez utiliser 127.0.0.1 pour identifier le serveur local. 


La configuration du fichier routes.xml est plus simple à réaliser, mais plus compliqué à expliquer. 
Ce fichier contient l'ensemble des liens d'AGORA Ex Machina. 

Par défaut, le fichier est configuré pour une installation d'AEM dans un sous répertoire nommé agoraexmachina. 
Si ce n'est pas le cas et que AEM est hébergé dans un autre répertoire, il faut remplacer url="/agoraexmachina/ par url="/nom-de-votre-repertoire/
Si ce n'est pas le cas et que AEM est hébergé à la racine de votre serveur WEB, il faut supprimer le terme agoraexmachina. Donc, remplacer url="/agoraexmachina/ par url="/ 
 


2. Création et initialisation de la base de données
-----------------------------------------------------

Pour créer et initialiser les premières données dans AGORA, il faut exécuter le script SQL /agoraexmachina/documentations/script-installation-database.sql

Ce script initialiser AGORA Ex Machina, ses tables, et un compte utilisateur administrateur : 
Nom du compte : admin
Adresse mail du compte : admin@admin.net
Mot de passe du compte : admin


