<?php
//chess.cyrilclemenceau.fr/index.php?adversaire=fanny29&limit=1800&increment=30&color=white
include_once('config.php');

session_start();
$_SESSION['adversaire'] = $_GET['adversaire'];
$_SESSION['limit'] = $_GET['limit'];
$_SESSION['increment'] = $_GET['increment'];
$_SESSION['color'] = $_GET['color'];

$state = uniqid();
$_SESSION['state'] = $state;

$authurl = "https://oauth.lichess.org/oauth/authorize?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&scope=challenge:write&state=$state";

header('Location: '.$authurl);
	exit;
