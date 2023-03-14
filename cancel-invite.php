<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    include_once("./classes/cancel-invite.class.php");

    $cancel = new CancelInvite();
    $cancel->cancel($_SESSION['id'], $_GET['id']);
    header("location: view-profile.php?id=" . $_GET['id']);
?>