<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    include("./classes/remove-friend.class.php");

    if(isset($_SESSION['imie'], $_SESSION['nazwisko'], $_SESSION['pseudonim'], $_SESSION['id'], $_SESSION['data_dolaczenia']))
    {
        $mgr = new RemoveFriend();
        $mgr->remove($_GET['id'], $_SESSION['id']);

        if($mgr)
        {
            header("location: index.php");
        }
        else
        {
            echo "Ups, coś poszło nie tak!";
            echo "<hr><a href='index.php'>Powrót</a>";
        }
    }
    else
    {
        header("location: log-in.php");
    }
?>