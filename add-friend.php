<?php
    include("./classes/add-friend.class.php");
    include("./functions/log-out-button.function.php");
    if(!isset($_SESSION))
    {
        session_start();
    }

    if(isset($_SESSION['imie'], $_SESSION['nazwisko'], $_SESSION['pseudonim'], $_SESSION['id'], $_SESSION['data_dolaczenia']))
    {
        $add = new AddFriend();
        $result = $add->addFriend($_GET['id']);
    }
    else
    {
        header("location: log-in.php");
    }
?>