<?php
/**
* file of functions
* @package cu.functions
* @copyright GNU GPL
* @filesource
* @version 1.1
* @author cyril bazin
*/

/**
* automatic load function of classes
*/
function autoload($class)
{
	if(file_exists('../'.str_replace('\\', '/', $class).'.class.php'))
		require '../'.str_replace('\\', '/', $class).'.class.php';
}

spl_autoload_register('autoload');


/**
* encode an HTML string
* @param string string to encode
* @return string string encoded
*/
function encodeHtmlString($string)
{
	$string = str_replace("é", "&eacute;", $string);
	$string = str_replace("è", "&egrave;", $string);
	$string = str_replace("à", "&agrave;", $string);
	$string = str_replace("ù", "&ugrave;", $string);
	$string = str_replace("ô", "&ocirc;", $string);
	$string = str_replace("î", "&icirc;", $string);
	$string = str_replace("ê", "&ecirc;", $string);	
	$string = str_replace("'", "&#39;", $string);	
	$string = str_replace("\\", "/", $string);	
	
	return $string;
}

/**
* keep string from sql injection
* @param string string to secure
* @return string string secured
*/
function secureString($string)
{
	$string = str_replace("'", "\'", $string);
	
	return $string;
}

/**
* encode a string to use in URL
* @param string string to encode
* @return string string encoded
*/
function url($string)
{
	$string = str_replace(" ", "-", $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("à", "e", $string);
	$string = str_replace("ù", "e", $string);
	$string = str_replace("ô", "o", $string);
	$string = str_replace("î", "i", $string);
	$string = str_replace("ê", "e", $string);	
	$string = str_replace("\"", "", $string);	
	$string = str_replace("'", "", $string);	
	$string = str_replace("\\", "", $string);	
	$string = strtolower($string);
	
	return $string;
}


/**
* upload files on the server
* @param $_file file to upload
* @param string path where the file will be stored
* @param string name of the file
* @todo add to the function the possibility to resize images and control the extensions
*/
function uploadFile($upload, $path, $name)
{
	$content_dir = $path;
	$tmp_file = $upload['tmp_name'];
	
	switch($upload['error'])
	{
		case 1:
			exit("Le fichier téléchargé excède la taille de upload_max_filesize, configurée dans le php.ini.");
			break;
		case 2;
			exit("Le fichier téléchargé excède la taille de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.");
			break;		
		case 3:
			exit(" Le fichier n'a été que partiellement téléchargé.");
			break;		
		case 4:
			exit(" Aucun fichier n'a été téléchargé.");
			break;		
		case 6:
			exit("Un dossier temporaire est manquant.");
			break;		
		case 7:
			exit("Échec de l'écriture du fichier sur le disque.");
			break;		
		case 8:
			exit("Une extension PHP a arrêté l'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L'examen du phpinfo() peut aider. ");
			break;				
	}
	

	if( !is_uploaded_file($tmp_file) )
	{
		exit("Le fichier est introuvable");
	}

	$type_file = $upload['type'];
	
	if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif')&& !strstr($type_file, 'png') )
	{
		exit("Le fichier n'est pas une image");
	}

	$name_file = $upload['name'];

	if( !move_uploaded_file($tmp_file, $content_dir . $name) )
	{
		exit("Impossible de copier le fichier dans $content_dir");
	}

}

/**
* summarize a text
* @param string text to summarize
* @param int lenght of summary
* @return string text "summarized"
*/
function summarize($text, $len)
{
	return substr($text, 0, $len);
}


/**
* convert applications codes  
* @param int code to be converted
* @return string code converted
*/
function convertCodes($code)
{
	$code = (int)$code;
	
	switch($code)
	{
		case 100:
			return _TR_InProgess;
			break;
		case 101:
			return  _TR_Finished;
			break;
		case 102:
			return  _TR_Canceled;
			break;
		case 103:
			return  _TR_Proposed;
			break;
		case 104:
			return  _TR_Valided;
			break;
		case 0:
			return _TR_no;
			break;
		case 1:
			return _TR_yes;
			break;	
		case 1000:
			return _TR_Validation;
			break;	
		case 1001:
			return _TR_SimpleSelect;
			break;	
		case 1002:
			return _TR_MultipleSelect;
			break;	
		case 1003:
			return _TR_Textarea;
			break;	
		case 1004:
			return _TR_ImportDoc;
			break;	
		case 1005:
			return _TR_ValidationDoc;
			break;			
	}
}

/**
* display an error message box
* @param string text to display
* @return string message 
*/
function msgError($msg)
{
	return  
		"<div class='alert alert-danger'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			<strong>". strtoupper(_TR_Warning) ." ! </strong> ". $msg ."
		</div> <!-- /alert -->";
}

/**
* display a success message box
* @param string text to display
* @return string message
*/
function msgSuccess($msg)
{
	return  
		"<div class='alert alert-success'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			<strong>". strtoupper("Information") ." ! </strong> ". $msg ."
		</div> <!-- /alert -->";
}

/**
* display a alert message box
* @param string text to display
* @return string message
*/
function msgAlert($msg)
{
	return  
		"<div class='alert alert-info'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			<strong>". strtoupper("Information") ." ! </strong> ". $msg ."
		</div> <!-- /alert -->";
}


?>
