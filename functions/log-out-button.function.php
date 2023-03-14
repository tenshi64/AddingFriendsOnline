<?php
    include("./classes/log-in.class.php");
    include("./classes/get-friends.class.php");

    if(!isset($_SESSION))
    {
        session_start();
    }

    function checkIfLogged()
    {
        if(!isset($_SESSION['imie'], $_SESSION['nazwisko'], $_SESSION['pseudonim'], $_SESSION['id'], $_SESSION['data_dolaczenia']))
        {
            if(isset($_POST['pseudonim'], $_POST['haslo']))
            {
                if(!empty($_POST['pseudonim']) && !empty($_POST['haslo']))
                {
                    $checkUser = new LogIn($_POST['pseudonim'], $_POST['haslo']);
                    if($checkUser->checkUser())
                    {
                        echo "<span style='float:right'>Zalogowano jako <a style='text-decoration: none; color: green;' href='view-profile.php?id=" . $_SESSION['id'] . "'>" . $_SESSION['pseudonim'] . "</a></span>";
                        echo "<br><a href='log-out.php' style='float:right'>Wyloguj się</a>";
                    }
                    else
                    {
                        $_SESSION['error'] = "Pseudonim lub login są niepoprawne!";
                        header("location: log-in.php");
                    }
                }
                else
                {
                    $_SESSION['error'] = "Żadne pole tekstowe nie może być puste!";
                    header("location: log-in.php");
                }
            }
            else
            {
                header("location: log-in.php");
            }
        }
        else
        {
            echo "<span style='float:right'>Zalogowano jako <a style='text-decoration: none; color: green;' href='view-profile.php?id=" . $_SESSION['id'] . "'>" . $_SESSION['pseudonim'] . "</a></span>";
            echo "<br><a href='log-out.php' style='float:right'>Wyloguj się</a>";
        }
    }
?>