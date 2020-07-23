<?php
    include "../classes/db.php";
    include "../classes/user.php";
    
    session_start();
    
    $user = $_SESSION['user'];
    
    if(isset($_POST['search']))
    {
        $class = $_POST['search'];
        $class = str_replace(" ", "", $class);
        $class = strtoupper($class);
        $db = new DB();
        $joinedIds = json_decode($user->getGroupsJoined());
        $groupNotJoined = "";
        
        if (is_array($joinedIds) || is_object($joinedIds))
        {
            foreach($joinedIds as $yArray)
            {
                $joinedId = $yArray->group_id;
                $groupNotJoined .= "id <> '$joinedId' AND ";
            }
        }
        $query0 = $db->runQuery("SELECT * FROM groups WHERE class = '$class' AND " . $groupNotJoined . "max_capacity <> num_members");
        
        while($rows = $query0->fetch(PDO::FETCH_ASSOC))
        {
            $groupsToJoin[] = $rows;
        }
        if(isset($groupsToJoin))
        {
            echo json_encode($groupsToJoin);
        }
        else
        {
            echo "No Groups Of That Class";
        }
    }
    else
    {
       echo "False";
    }