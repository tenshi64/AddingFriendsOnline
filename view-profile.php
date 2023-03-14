<?php
    include("./classes/get-info.class.php");
    include("./functions/log-out-button.function.php");
    include_once("./classes/get-friends.class.php");
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
    <title>Profil</title>
</head>
<body>
    <?php
        checkIfLogged();
        $get = new GetInfo();
        $result = $get->getInfo($_GET['id']);
        $checkIfInvited = $get->checkIfInvited($_SESSION['id'], $_GET['id']);

        if($result != null)
        {
            while($row = $result->fetch_row())
            {
                echo "<span style='color: blue; font-size: 35px;'>". $row[1] . "</span><br>";
                echo "<span style='font-size: 22px;'>Imię: " . $row[0] . "</span><br>";
                echo "<span style='font-size: 22px;'>Nazwisko: " . $row[2] . "</span><br>";
                echo "<span style='font-size: 22px;'>Data dołączenia: " . $row[3] . "</span><br>";
            }
            $list = new GetFriendsList();
            $check = $list->getList();
            $getResult = true;
            for($i=0; $i<count($check[1]); $i++)
            {
                if($check[1][$i] == $_GET['id'])
                {
                    $getResult = false;
                }
            }
            if($getResult)
            {
                if($_GET['id'] != $_SESSION['id'])
                {
                    if($checkIfInvited)
                    {
                        echo "<a style='font-size: 30px; color: red; text-decoration: none;' href='cancel-invite.php?id=" . $_GET['id'] . "'>Anuluj zaproszenie do znajomych</a>";
                    }
                    else
                    {
                        echo "<a style='font-size: 30px; color: blue; text-decoration: none;' href='add-friend.php?id=" . $_GET['id'] . "'>Dodaj do znajomych</a>";
                    }
                }
                else
                {
                    echo "<span style='font-size: 25px; color: green; text-decoration: none;'>(Twoje konto)</span><hr>";
                    echo "<a href='edit-profile.php' style='text-decoration: none;'><span style='font-size: 25px; color: green; text-decoration: none;'>Edytuj konto</span></a>";
                }
                echo "<hr><a style='font-size: 20px; color: black; text-decoration: none;' href='index.php'>Powrót</a>";
            }
            else
            {
                echo "<span style='font-size: 25px; color: green; text-decoration: none;'>(Twój znajomy)</span>";
                echo "<br><br><a style='font-size: 25px; color: red; text-decoration: none;' href='remove-friend.php?id=" . $_GET['id'] . "'>Usuń ze znajomych</a></a>";
                echo "<hr><a style='font-size: 20px; color: black; text-decoration: none;' href='index.php'>Powrót</a>";
            }
        }
        else
        {
            echo "Nie udało się wyświetlić profilu tej osoby!<br>";
            echo "<hr><a href='index.php'>Powrót</a>";
        }
    ?>
</body>
</html>