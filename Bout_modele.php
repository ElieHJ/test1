<?php
//voici une modification du script
/* Connexion Serveur */
function bdd()
	{
		try
		{
			 return $bd = new PDO('mysql:host=localhost;dbname=db670299403;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}		
?>