<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    include("./classes/sign-up.class.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
</head>
<body>
    <?php
        if(isset($_SESSION['imie'], $_SESSION['nazwisko'], $_SESSION['pseudonim'], $_SESSION['data_dolaczenia'], $_SESSION['id']))
        {
            header("location: index.php");
        }
    ?>
    <form action="" method="post">
        <h1>Rejestracja</h1>
        Imię: <input type='text' name='imie'><br>
        Nazwisko: <input type='text' name='nazwisko'><br>
        Psuedonim: <input type='text' name='pseudonim'><br>
        Hasło: <input type='password' name='haslo'><br>
        Powtórz hasło: <input type='password' name='powtorz_haslo'><br>
        <input type='submit' value='Zarejestruj się'>
        <br><br><a style="color: blue" href="log-in.php">Masz już konto? Zaloguj się!</a>
        <?php
           if(isset($_POST['imie'], $_POST['nazwisko'], $_POST['pseudonim'], $_POST['haslo'], $_POST['powtorz_haslo']))
            {
                if(!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['pseudonim']) && !empty($_POST['haslo']) && !empty($_POST['powtorz_haslo']))
                {
                    $signUp = new SignUp($_POST['imie'], $_POST['nazwisko'], $_POST['pseudonim'], $_POST['haslo'], $_POST['powtorz_haslo']);
                    $checkNickname = $signUp->checkNickname();
                    $checkPassword = $signUp->checkPassword();

                    if(!$checkNickname)
                    {
                        $_SESSION['error2'] = "Ten pseudonim jest już zajęty!";
                    }

                    if($checkNickname && $checkPassword)
                    {
                        $signUp->saveUser();
                        header("location: log-in.php");
                    }
                }
                else
                {
                    $_SESSION['error1'] = "Wypełnij wszystkie pola tekstowe!";
                }
            }


            if(isset($_SESSION['error']))
            {
                echo "<p style='color: red'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['error1']))
            {
                echo "<p style='color: red'>" . $_SESSION['error1'] . "</p>";
                unset($_SESSION['error1']);
            }
            if(isset($_SESSION['error2']))
            {
                echo "<p style='color: red'>" . $_SESSION['error2'] . "</p>";
                unset($_SESSION['error2']);
            }
            if(isset($_SESSION['error3']))
            {
                echo "<p style='color: red'>" . $_SESSION['error3'] . "</p>";
                unset($_SESSION['error3']);
            }
        ?>
    </form>
</body>
</html>