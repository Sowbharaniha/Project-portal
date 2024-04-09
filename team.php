<?php
include 'connect.php';
if(isset($_POST['create']))
{
    if(isset($_COOKIE['userName']))
    {
        $userName = $_COOKIE['userName'];
        setcookie("userName","$userName");
    }

    $team = $_POST['team'];
    $project = $_POST['project'];
    $incharge = $_POST['incharge'];
    $mark = $_POST['mark'];
    $remark = $_POST['remark'];
    $userRef = $_COOKIE['userName'];

    $stmt = $conn->prepare("select * from team where Team = ? and UserRef =?");
    $stmt->bind_param("ss", $team , $userRef);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if($stmt_result->num_rows == 0)
    {
        $stmt->close();
        $stmt = $conn->prepare("insert into team(Team, Project, Incharge, Mark, Remark, UserRef) values(?,?,?,?,?,?)");
        $stmt->bind_param("sssdss", $team, $project, $incharge, $mark, $remark, $userRef);
        $stmt->execute();  
        $stmt->close(); 
        header("Location: projectInfo.php"); 
    }
    else
    {
        echo "Team name already exists!";
        $stmt->close(); 
    }
}
        
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bgImg.jpeg'); 
            background-size: cover; 
            background-position: center;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding-top: 25px;
        }
        .container1 {
            width: 90%;
            margin: 0 auto;
            padding-top: 50px;
            text-align: center;
        }
        h2 {
            font-size: 32px;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 13px;
            margin: 6px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4e5cb6;
            color: white;
            border: none;
            cursor: pointer;
        }
        label {
            padding-bottom: 10px;
            display: block;
        }

    </style>
</head>
<body>
    <div class="container1">
        <h2>Team details</h2>
    </div>
</body>
</head>
<body>
    <div class="container">
        <form method="post">
            <label for="team">Team Name:</label>
            <input type="text" id="Team_name" name="team" placeholder="Enter Team name" required>
            <label for="project">Project Name:</label>
            <input type="text" id="project_name" name="project" placeholder="Enter project name" required>
            <label for="incharge">Project Incharge:</label>
            <input type="text" id="project_incharge" name="incharge" placeholder="Enter Project incharge name" required>
            <label for="mark">Mark:</label>
            <input type="text" id="mark" name="mark" placeholder="Enter marks" >
            <label for="remark">Remarks:</label>
            <input type="text" id="remarks" name="remark" placeholder="Enter remarks" >
            <button type="submit" class="btn btn-primary my-3" class="text-light" name="create">Create</button>
            <button type="button" class="btn btn-danger my-3"><a href="projectInfo.php" class="text-light">Cancel</a></button>
        </form>
    </div>
    </div>
</body>
</html>