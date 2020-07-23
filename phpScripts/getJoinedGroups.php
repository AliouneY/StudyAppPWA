<?php

    include "../classes/db.php";
    include "../classes/user.php";
    
    session_start();
    
    $user = $_SESSION['user'];
    
    $joinedIds = json_decode($user->getGroupsJoined());
    $groupsJoined = "";
    $db = new DB(); 
    for($i = 0; $i < count($joinedIds) - 1; $i++)
    {
        $joinedId = $joinedIds[$i]->group_id;
        $groupsJoined .= "id = '$joinedId' or ";
    }
    $joinedId = $joinedIds[count($joinedIds) - 1]->group_id;
    $groupsJoined .= "id = '$joinedId'";
    
    $query0 = $db->runQuery("SELECT * FROM groups WHERE " . $groupsJoined);
    
    while($rows = $query0->fetch(PDO::FETCH_ASSOC))
    {
        $joinedGroups[] = $rows;
    }
    if(isset($joinedGroups))
    {
        echo json_encode($joinedGroups);
    }
    else
    {
        echo "You Haven't Joined Any Groups Yet";
    }
    