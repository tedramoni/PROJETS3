<?php
require_once('AutoCompletionClient.class.php');

//Initialisation de la liste
$list = array();

//Connexion MySQL
try
{
    $db = new PDO('mysql:host=mysql.serversfree.com;dbname=u157965635_iut', 'u157965635_ted', 'ramoni');
}
catch (Exception $ex)
{
    echo $ex->getMessage();
}

//Construction de la requete
$strQuery = "SELECT client.code CodeClient, nom NomClient, adresse AdresseClient FROM client, adr_livraison WHERE ";
if (isset($_POST["codeClient"]))
{
    $strQuery .= "client.code LIKE :codeClient AND client.code = adr_livraison.code ";
}
$strQuery.= "ORDER BY  client.code ASC ";
//Limite
if (isset($_POST["maxRows"]))
{
    $strQuery .= "LIMIT 0, :maxRows";
}
$query = $db->prepare($strQuery);
if (isset($_POST["codeClient"]))
{
    $value = $_POST["codeClient"]."%";
    $query->bindParam(":codeClient", $value, PDO::PARAM_STR);
}

//Limite
if (isset($_POST["maxRows"]))
{
    $valueRows = intval($_POST["maxRows"]);
    $query->bindParam(":maxRows", $valueRows, PDO::PARAM_INT);
}

$query->execute();

$list = $query->fetchAll(PDO::FETCH_CLASS, "AutoCompletionClient");;

echo json_encode($list);
?>
