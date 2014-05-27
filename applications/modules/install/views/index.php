<h1>Installation</h1>
<h4>0. Bienvenue dans l'installation d'AGORA Ex Machina.</h4>
<hr />
Seulement 3 &eacute;tapes pour faire fonctionner votre application de d&eacute;mocratie liquide : 
<br /><br />
<ul>
<li>Le param&eacute;trage des fichiers de configuration <b class="fg-blue">config.xml</b> et <b class="fg-blue">routes.xml</b> se trouvant dans le r&eacute;pertoire /applications/config.</li>
<li>La param&eacute;trage de la base de donn&eacute;es via le bouton <b class="fg-blue">Cr&eacute;ation de la base de donn&eacute;es</b> ci-dessous.</li>
<li>La suppression du r&eacute;pertoire <b class="fg-blue">install</b></li>
</ul> 

<br /><br /><br />
<h4>1. Param&eacute;trage des fichiers de configuration <b class="fg-blue">config.xml</b> et <b class="fg-blue">routes.xml</b> se trouvant dans le r&eacute;pertoire /applications/config</h4>
<hr/>
Les fichiers <b class="fg-blue">config.xml</b> et <b class="fg-blue">routes.xml</b> se trouvant dans le r&eacute;pertoire /applications/config.
<br /><br /><br />
Le fichier <b class="fg-blue">config.xml</b> contient toute la configuration de base pour faire fonctionner AEM.
<br /><br />
Il faut compl&eacute;ter les informations suivantes :  
<br /><br />
<ul>
	<li>SQL_HOTE : Adresse Internet (IP) de votre serveur de base de donn&eacute;es.</li>
	<li>SQL_PORT : Port utilis&eacute; pour dialoguer avec votre base de donn&eacute;es. Par defaut 3306.</li>
	<li>SQL_DB : Nom de votre base de donn&eacute;es. Par defaut aem.</li>
	<li>SQL_USR : Identifiant de connexion &agrave; votre base de donn&eacute;es.</li>
	<li>SQL_PWD : Mot de passe de connexion &agrave; votre base de donn&eacute;es.</li>
	<li>WEBSITE_DNS : Nom de domaine utilis&eacute; pour acc&eacute;der &agrave; AEM.</li>
	<li>WEBSITE_ROOT : Racine d'AEM sur votre serveur web.</li>
	<li>WEBSITE_TITLE : Titre de votre plateforme de d&eacute;mocratie liquide. Est affich&eacute; en haut &agrave; gauche.</li>
	<li>WEBSITE_SUBTITLE : Sous-titre de votre plateforme de d&eacute;mocratie liquide. Est affich&eacute; &agrave; la suite du titre.</li>
</ul>
<br />
Si votre base de donn&eacute;es est h&eacute;berg&eacute;e sur le serveur 10.234.0.147, il faut param&eacute;trer le fichier config.xml de la mani&egrave;re suivante : <code>define var="SQL_HOTE" value="10.234.0.147"</code>
<br />
Vous pouvez utiliser 127.0.0.1 pour identifier le serveur actuel.

<br /><br /><br />
La configuration du fichier <b class="fg-blue">routes.xml</b> est plus simple &agrave; r&eacute;aliser, mais plus compliqu&eacute; &agrave; expliquer.
<br />
Ce fichier contient l'ensemble des liens d'AGORA Ex Machina.
<br /><br />
Par d&eacute;faut, ce fichier est configur&eacute; pour une installation dans un sous  r&eacute;pertoire nomm&eacute; agoraexmachine.
<br />
Si ce n'est pas le cas et que AEM est h&eacute;berg&eacute; &agrave; la racine de votre serveur WEB, il faut remplacer <code>url="/agoraexmachina/</code> par <code>url="/</code>
<br />
Si ce n'est pas le cas et que AEM est h&eacute;berg&eacute; dans un autre r&eacute;pertoire, il faut remplacer <code>url="/agoraexmachina/</code> par <code>url="/<i class="fg-gray">nom-de-votre-repertoire</i>/</code>
<br /><br /><br />
<h4>2. Param&eacute;trage de la base de donn&eacute;es</h4>
<hr/>
Pour cr&eacute;er et param&eacute;trer une nouvelle base de donn&eacute;es, il suffit de cliquer sur le lien ci-dessous : 
<br /><br />
<a class="btn btn-primary"  data-toggle="modal" data-target="#myModal"  id="addDbButton" href="<?php echo WEBSITE_ROOT ."/install/addDb"?>">
	<span class='glyphicon glyphicon glyphicon-cog'></span>
	Cr&eacute;er une nouvelle base de donn&eacute;es
</a>
