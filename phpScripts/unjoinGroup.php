<?php
include "../classes/db.php";
include "../classes/user.php";

session_start();

$user = $_SESSION['user'];

if(isset($_POST['groupid']))
{
    $groupId = $_POST['groupid'];
    $user->unjoin($groupId);
    echo "Successfully unjoined group " . $groupId;
}
else
{
    echo "Something went wrong";
}