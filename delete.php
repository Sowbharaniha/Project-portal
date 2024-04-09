<?php
include 'connect.php';

if(isset($_COOKIE['userName']))
    {
        $userRef = $_COOKIE['userName'];
        setcookie("userName","$userRef");
    }

if(isset($_GET['team']))
{
    $team = $_GET['team'];

    $stmt = $conn->prepare("delete from team where Team = ? and UserRef = ?");
    $stmt->bind_param("ss", $team, $userRef);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    setcookie("userName","$userRef");
    header("Location: projectInfo.php");
}

?>