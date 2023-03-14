<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(isset($_SESSION['imie'], $_SESSION['nazwisko'], $_SESSION['pseudonim'], $_SESSION['id'], $_SESSION['data_dolaczenia']))
    {
        unset($_SESSION['imie']);
        unset($_SESSION['nazwisko']);
        unset($_SESSION['data_dolaczenia']);
        unset($_SESSION['pseudonim']);
        unset($_SESSION['id']);
    
        header("location: log-in.php");
    }
    else
    {
        header("location: log-in.php");
    }

?>