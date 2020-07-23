<?php

    include "../classes/db.php";

    if(isset($_POST['groupid']))
    {
        $memberIds = Array();
        $groupId = $_POST['groupid'];
        $db = new DB();
        $query0 = $db->runQuery("SELECT user_id FROM user_group_bridge WHERE group_id = '$groupId'");
        
        while($rows = $query0->fetch(PDO::FETCH_ASSOC))
        {
            $memberIds[] = $rows['user_id'];
        }
        
        $areMembers = "";
        
        for($i = 0; $i < sizeof($memberIds) - 1; $i++)
        {
            $id = $memberIds[$i];
            $areMembers .= "id = '$id' or ";
        }
        $id = $memberIds[sizeof($memberIds) - 1];
        $areMembers .= "id = '$id'";
        
        $groupMembers = Array();
        
        $query0 = $db->runQuery("SELECT * FROM users WHERE " . $areMembers);
        
        while($rows = $query0->fetch(PDO::FETCH_ASSOC))
        {
            $groupMembers[] = $rows;
        }
        
        echo json_encode($groupMembers);
    }