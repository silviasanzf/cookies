<?php
//session_start();


require 'inc/head.php'; ?>
<?php

/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 21/10/18
 * Time: 10:36
 */$title ="panier";
//require("connexion/auth.php");
//if(isset($_POST) && !empty($_POST['mail']) && !empty($_POST['mdp']))
//{
    //$conn=mysql_connect("localhost","root","");
    //mysql_select_db("test",$conn);
    //Requete si il y a dans la table un mail et un mot de passe égale à ceux saisie dans le formulaire
    //$sql = " SELECT * FROM membres WHERE email='".addslashes($_POST['mail'])."' AND pass1='".addslashes(sha1($_POST['mdp']))."'";
    //$req = mysql_query($sql,$conn) or die(mysql_error());
    // Si il a une réponse à la requete alors la session recupère les infos
    //if (mysql_num_rows($req))
    //{
        //$_SESSION['Auth'] = array(
          //  'mail' => $_POST['mail'],
           // 'mdp' => $_POST['mdp'],
           // 'panier' => array()
        //);
    /*}
    else //Si il n'y a pas de réponse alors on renvois un message d'erreur
    {
        header('location:index.php?erreur=6');
    }
}
// Gestion des messages d'erreurs  par la methode GET
$message="Pour mieux vous connaitre ?";
if(isset($_GET["erreur"]))
{
    $erreur=$_GET["erreur"];
    switch($erreur)
    {
        case 0:
            $message="Pour mieux vous connaitre"; break;
        case 1:
            $message = '<font color="red">Problème d\'envoi formulaire!</font>'; break;
        case 2:
            $message = '<font color="green">Inscription réussie !</font>'; break;
        case 3:
            $message = '<font color="red">Les mots de passes sont différents</font> '; break;
        case 4:
            $message = '<font color="red">Ce mail est déjà pris</font>'; break;
        case 5:
            $message = '<font color="red">Tous les champs doivent être remplis</font>'; break;
        case 6:
            $message = '<font color="red">Mauvaise combinaison identifiant/mot de passe</font>'; break;
        default:
            $message = '<font color="red">Erreur merci de recommencer</font>'; break;
    }
}
// Fonction qui gènere le haut du site
function hautPage($title, $description)
{
    echo'
<!DOCTYPE HTML>
<html>
<head>
       <title>'. $title .'</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <meta name="description" content="' .$description. '" />
       <link href="css/style.css" rel="stylesheet" />
     <link href=\'http://fonts.googleapis.com/css?family=Playfair+Display+SC\' rel=\'stylesheet\' type=\'text/css\'>
     <link href=\'http://fonts.googleapis.com/css?family=Source+Code+Pro\' rel=\'stylesheet\' type=\'text/css\'>
       <link rel="icon" type="image/x-icon" href="img/favicon.png" />
     <SCRIPT LANGUAGE=Javascript SRC="script/verrif_passe.js"> </SCRIPT>
       <script type="text/javascript" src="menu.js"></script>
       <!--[if lt IE 9]>
                         <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
                         <link rel="stylesheet" href="css/styles-ie.css" media="screen">
       <![endif]-->
</head>';
}
hautPage("$title - Yamaël", 'Inscription au site Yamaël');
// Affichage du menu du site
require("inc/haut.php");*/
//*****************************************************
// SCRIPT PANIER
//*****************************************************
if (! isset($_SESSION['panier']))  $_SESSION['panier'] = array();

// Voici les données externes utilisées par le panier
$id_article   = isset($_GET['cookie'])   ? $_GET['cookie']   : null;
//$nom_article  = isset($_GET['nom_article'])  ? $_GET['nom_article']  : null;
//$prix_article = isset($_GET['prix_article']) ? $_GET['prix_article'] : '?';
//$qte_article  = isset($_GET['qte_article'])  ? $_GET['qte_article']  : 1;

// Voici les traitements du panier
if ($id_article == null) echo 'Veuillez sélectionner un article pour le mettre dans le panier!'; // Message si pas d'acticle sélectionné
else
    if (isset($_GET['add_to_cart'])){ // Ajouter un nouvel article
        $_SESSION['panier'][$id_article]['nom']  = $nom_article;
        //$_SESSION['panier'][$id_article]['prix'] = $prix_article;
        $_SESSION['panier'][$id_article]['qte']  = $qte_article;
    }
    //else if (isset($_GET['modifier']))  $_SESSION['Auth']['panier'][$id_article]['qte'] = $qte_article; // Modifier la quantité achetée
    //else if (isset($_GET['supprimer']))  unset($_SESSION['Auth']['panier'][$id_article]); // Supprimer un article du panier
echo '<div id="wrapper_news">
   <h4>Inscription</h4>
    <h3>'. $message .'</h3>
    <div id="wrapper_inscription"> ';
// Voici l'affichage du panier
echo '<h2>Contenu de votre panier</h2><ul>';
if (isset($_SESSION['panier']) && count($_SESSION['panier'])>0)
{
    $total_panier = 0;
    foreach($_SESSION['panier'] as $id_article=>$article_acheté)
    {
        // On affiche chaque ligne du panier : nom, prix et quantité modifiable + 2 boutons : modifier la qté et supprimer l'article
        if (isset($article_acheté['nom']) && isset($article_acheté['prix']) && isset($article_acheté['qte'])){
            echo '<li><form>', $article_acheté['nom'], ' (', number_format($article_acheté['prix'], 2, ',', ' '), ' €) ',
            '<input type="hidden" name="id_article" value="', $id_article , '" />
                          <br />Qté: <input type="text" name="qte_article" value="', $article_acheté['qte'] , '" />
                          <input type="submit" name="modifier" value="Nouvelle Qté" />
                          <input type="submit" name="supprimer" value="Supprimer" />
                        </form>
                        </li>';

            // Calcule le prix total du panier
            $total_panier += $article_acheté['prix'] * $article_acheté['qte'];
        }
    }
    echo '<hr><h3>Total: ', number_format($total_panier, 2, ',', ' '), ' €'; // Affiche le total du panier

    echo'          
    </div>
    </div> ';
    require("inc/bas.php");
}
else
{
    echo 'Votre panier est vide';

} // Message si le panier est vide
echo "</ul>";
?>