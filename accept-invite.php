<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    if(!isset($_SESSION['imie'], $_SESSION['nazwisko'], $_SESSION['pseudonim'], $_SESSION['data_dolaczenia'], $_SESSION['id']))
    {
        header("location: log-in.php");
    }

    include("./classes/accept-invite.class.php");

    $accept = new AcceptInvite();
    $result = $accept->accept($_GET['id'], $_SESSION['id']);
    if($result)
    {
        header("location: index.php");
    }
?>