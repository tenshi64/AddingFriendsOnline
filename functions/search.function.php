<?php
    function searchPerson()
    {
        include_once("./classes/search.class.php");
    
        if(!isset($_SESSION))
        {
            session_start();
        }
    
        if(isset($_POST['search']))
        {
            if(!empty($_POST['search']))
            {
                $search = new Search();
                $result = $search->searchUser($_POST['search'] . "%");
    
                if($result != null)
                {
                    echo "<h1>Wyniki wyszukiwania:</h1>";
    
                    $text = "";
                    switch($result->num_rows)
                    {
                        case 1:
                            $text = "";
                            break;
                        case 2:
                            $text = "y";
                            break;
                        case 3:
                            $text = "y";
                            break;
                        case 4:
                            $text = "y";
                            break;
                        default:
                            $text = "ów";
                            break;
                    }
                    echo "<br>Znaleziono " . $result->num_rows . " rekord" . $text . "<hr>";
    
                    $j=1;
                    while($row = $result->fetch_row())
                    {
                        echo "<span style='font-size: 18px'>" . $j . ".</span> ";
                        if($row[4] == $_SESSION['id'])
                        {
                            echo '<span style="font-size: 18px"><a href="view-profile.php?id=' . $row[4] . '" style="text-decoration: none; color: blue"><span style="color: green">(Twoje konto)</span> ' . $row[0] . ' "' . $row[1] . '" ' . $row[2] . ' (Data dołączenia: ' . $row[3] . ')</a></span><br>';
                        }
                        else if($row[4] != $_SESSION['id'])
                        {
                            echo '<span style="font-size: 18px"><a href="view-profile.php?id=' . $row[4] . '" style="text-decoration: none; color: blue">' . $row[0] . ' "' . $row[1] . '" ' . $row[2] . ' (Data dołączenia: ' . $row[3] . ')</a></span><br>';
                        }
                        $j++;
                    }
                }
                else
                {
                    echo "Nie znaleziono tej osoby!";
                }
            }
            else
            {
                echo "Wypełnij pole tekstowe by wyszukać osobę!";
            }
        }
    }
?>