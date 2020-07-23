<?php

    include "../classes/db.php";
    include "../classes/user.php";
    
    session_start();
    
    $user = $_SESSION['user'];
    $uid = $user->getId();
    
    $joinedIds = json_decode($user->getGroupsJoined());
    
    if (is_array($joinedIds) || is_object($joinedIds))
    {
        foreach($joinedIds as $yArray)
        {
           $joinedGroupId = $yArray->group_id;
           $user->unjoin($joinedGroupId);
        }
    }
    
    //now that I think about it, this part would have gone better as a function in the User class...I shall update
    
    $db = new DB();
    $db->runQuery("DELETE FROM users WHERE id = '$uid'");
    $user_name = $_SESSION['user']->getName();
    $query0 = $db->runQuery("INSERT INTO logouts (user_id, user_name) VALUES ('$uid', '$user_name')");
            
    session_unset();
    session_destroy();
    echo "Success";