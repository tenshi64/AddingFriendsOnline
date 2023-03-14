<?php
    include("./functions/log-out-button.function.php");
    include("./functions/search.function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
</head>
<body>
    <div style="float: right;">
        <?php
            checkIfLogged();
        ?>
    </div><br><br>
    <div style="border-style: solid; border-width: 1px; width: 400px; float: left; margin-top: 18px; height: 400px; overflow-y: scroll;">
        <h1>Twoi znajomi:</h1><hr>
        <?php
            $list = new GetFriendsList();
            $mgr = $list->getList();
            if($mgr[0]->num_rows > 0 && count($mgr[1]) > 0)
            {
                $id = $mgr[1];
                $getList = $mgr[0];
                $i = 0;
                while($row = $mgr[0]->fetch_row())
                {
                    if($row[1] != $_SESSION['pseudonim'])
                    {
                        if(count($id) > 1 && $i < count($id))
                        {
                            echo $i+1 . ". ";
                            echo "<a style='text-decoration: none; color: black;' href='view-profile.php?id=$id[$i]'>";
                            echo $row[0] . ' "' . $row[1] . '" ' . $row[2];
                            echo "</a> ";
                        }
                        else if($i < count($id))
                        {
                            echo $i+1 . ". ";
                            echo "<a style='text-decoration: none; color: black;' href='view-profile.php?id=$id[0]'>";
                            echo $row[0] . ' "' . $row[1] . '" ' . $row[2];
                            echo "</a> ";
                        }
                        if(count($id) > 1 && $i < count($id))
                        {
                            echo "<a href='remove-friend.php?id=$id[$i]'>Usuń ze znajomych</a><br>";
                        }
                        else if($i < count($id))
                        {
                            echo "<a href='remove-friend.php?id=$id[0]'>Usuń ze znajomych</a><br>";
                        }
                        $i++;
                    }
                }
            }
            else
            {
                echo "Niestety jest tu na razie pusto!";
            }
        ?>
    </div>
    <div style="border-style: solid; border-width: 1px; width: 400px; float: right; margin-top: 18px; height: 400px; overflow-y: scroll;">
        <h1>Oczekujące zaproszenia:</h1><hr>
        <?php
            $list = new GetFriendsList();
            $mgr = $list->getWaitingList();
            if($mgr[0]->num_rows > 0 && count($mgr[1]) > 0)
            {
                $id = $mgr[1];
                $getList = $mgr[0];
                $i = 0;
                while($row = $mgr[0]->fetch_row())
                {
                    if($row[1] != $_SESSION['pseudonim'])
                    {
                        if(count($id) > 1 && $i < count($id))
                        {
                            echo $i+1 . ". ";
                            echo "<a style='text-decoration: none; color: black;' href='view-profile.php?id=$id[$i]'>";
                            echo $row[0] . ' "' . $row[1] . '" ' . $row[2];
                            echo "</a> ";
                        }
                        else if($i < count($id))
                        {
                            echo $i+1 . ". ";
                            echo "<a style='text-decoration: none; color: black;' href='view-profile.php?id=$id[0]'>";
                            echo $row[0] . ' "' . $row[1] . '" ' . $row[2];
                            echo "</a> ";
                        }
                        if(count($id) > 1 && $i < count($id))
                        {
                            echo "<a href='accept-invite.php?id=$id[$i]'>Przyjmij zaproszenie</a><br>";
                        }
                        else if($i < count($id))
                        {
                            echo "<a href='accept-invite.php?id=$id[0]'>Przyjmij zaproszenie</a><br>";
                        }
                        $i++;
                    }
                }
            }
            else
            {
                echo "Niestety jest tu na razie pusto!";
            }
        ?>
    </div>
    <div style="text-align: center;">
        <center>
            <br><div style="border-style: solid; border-width: 1px; width: 700px; height: 630px;">
                <h1>Wyszukaj osobę</h1>
                <form action="" method="POST">
                    <input type="text" placeholder="Wyszukaj osobę" style="height: 25px; width: 400px; font-size: 15px" name="search">
                    <input type="submit" value="Szukaj" style="height: 31px;">
                </form>
                <div class="search-result" style="overflow-y: scroll;">
                    <?php
                        searchPerson();
                    ?>
                </div>
            </div>
        </center>
    </div>
</body>
</html>