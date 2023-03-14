<?php
    include_once("db.class.php");

    if(!isset($_SESSION))
    {
        session_start();
    }

    class GetFriendsList extends Database
    {
        function getList()
        {
            parent::__construct();
           
            $stmt = $this->database->prepare("SELECT user_id FROM your_friends WHERE friend_id = ? AND status = 'Accepted'");
            $stmt->bind_param('i', $_SESSION['id']);
            $stmt->execute();

            $result = $stmt->get_result();
            if($result)
            {
                if($result->num_rows == 1)
                {
                    $id = [];
                    while($row = $result->fetch_row())
                    {
                        array_push($id, $row[0]);
                    }
                    $query = "SELECT imie, pseudonim, nazwisko, id FROM users WHERE id = $id[0]";
                    $stmt = $this->database->prepare($query);
                    $stmt->execute();
        
                    $result = $stmt->get_result();
                    if($result)
                    {
                        if($result->num_rows > 0)
                        {
                            $res = [$result, $id];
                            return $res;
                            unset($stmt);
                        }
                        else
                        {
                            return null;
                            unset($stmt);
                        }
                    }
                }
                else
                {
                    $query = "SELECT imie, pseudonim, nazwisko, id FROM users";
                    $stmt = $this->database->prepare($query);
                    $i=0;
                    $id = [];
                    while($row = $result->fetch_row())
                    {
                        if($i==0)
                        {
                            $query .= " WHERE id = $row[0]";
                        }
                        else
                        {
                            $query .= " OR id = $row[0]";
                        }
                        array_push($id, $row[0]);
                        $i++;
                    }
                    $stmt->execute();
        
                    $result = $stmt->get_result();
                    if($result)
                    {
                        if($result->num_rows > 0)
                        {
                            $res = [$result, $id];
                            return $res;
                            unset($stmt);
                        }
                        else
                        {
                            return null;
                            unset($stmt);
                        }
                    }
                }
            }
            else
            {
                return null;
                unset($stmt);
            }
        }


        function getWaitingList()
        {
            parent::__construct();
           
            $stmt = $this->database->prepare("SELECT user_id FROM your_friends WHERE friend_id = ? AND status = 'Waiting'");
            $stmt->bind_param('i', $_SESSION['id']);
            $stmt->execute();

            $result = $stmt->get_result();
            if($result)
            {
                if($result->num_rows == 1)
                {
                    $id = [];
                    while($row = $result->fetch_row())
                    {
                        array_push($id, $row[0]);
                    }
                    $query = "SELECT imie, pseudonim, nazwisko, id FROM users WHERE id = $id[0]";
                    $stmt = $this->database->prepare($query);
                    $stmt->execute();
        
                    $result = $stmt->get_result();
                    if($result)
                    {
                        if($result->num_rows > 0)
                        {
                            $res = [$result, $id];
                            return $res;
                            unset($stmt);
                        }
                        else
                        {
                            return null;
                            unset($stmt);
                        }
                    }
                }
                else
                {
                    $query = "SELECT imie, pseudonim, nazwisko, id FROM users";
                    $stmt = $this->database->prepare($query);
                    $i=0;
                    $id = [];
                    while($row = $result->fetch_row())
                    {
                        if($i==0)
                        {
                            $query .= " WHERE id = $row[0]";
                        }
                        else
                        {
                            $query .= " OR id = $row[0]";
                        }
                        array_push($id, $row[0]);
                        $i++;
                    }
                    $stmt->execute();
        
                    $result = $stmt->get_result();
                    if($result)
                    {
                        if($result->num_rows > 0)
                        {
                            $res = [$result, $id];
                            return $res;
                            unset($stmt);
                        }
                        else
                        {
                            return null;
                            unset($stmt);
                        }
                    }
                }
            }
            else
            {
                return null;
                unset($stmt);
            }
        }
    }
?>