<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
    <?php
        if(isset($_SESSION['imie'], $_SESSION['nazwisko'], $_SESSION['pseudonim'], $_SESSION['data_dolaczenia'], $_SESSION['id']))
        {
            header("location: index.php");
        }
    ?>
    <form action="index.php" method="post">
        <h1>Logowanie</h1>
        Psuedonim: <input type="text" name="pseudonim"><br>
        Hasło: <input type="password" name="haslo"><br>
        <input type="submit" value="Zaloguj się">
        <br><br><a style="color: blue" href="sign-up.php">Nie masz konta? Zarejestruj się!</a>
        <?php
            if(isset($_SESSION['error']))
            {
                echo "<p style='color: red'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
        ?>
    </form>
</body>
</html>