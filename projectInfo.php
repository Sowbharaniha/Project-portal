<?php
    include 'connect.php';
    if(isset($_COOKIE['userName']))
    {
        $userRef = $_COOKIE['userName'];
        setcookie("userName","$userRef");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Project portal</title>
    <style>
      body
      {
        background-image: url('bgImg.jpeg'); 
        background-size: cover;
      }   
      .table
      {
        background-color: white;
      }
    </style>
</head>
<body>

    <div class="container">
        <button class="btn btn-primary my-5"><a href="team.php" class="text-light">Add team</a></button>

        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Team</th>
      <th scope="col">Project</th>
      <th scope="col">Incharge</th>
      <th scope="col">Mark</th>
      <th scope="col">Remark</th>  
      <th scope="col">Operations</th>  
    </tr>
  </thead>
  <tbody>

  <?php 
    $stmt = $conn->prepare("select * from team where UserRef = ?");
    $stmt->bind_param("s", $userRef);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if($stmt_result)
    {      
      while($row = mysqli_fetch_assoc($stmt_result))
      {
        $team = $row['Team'];
        $project = $row['Project'];
        $incharge = $row['Incharge'];
        $mark = $row['Mark'];
        $remark = $row['Remark'];
        echo '<tr>
        <th scope="row">'.$team.'</th>
        <td>'.$project.'</td>
        <td>'.$incharge.'</td>
        <td>'.$mark.'</td>
        <td>'.$remark.'</td>
        <td>
        <button class="btn btn-primary"><a href="update.php?team='.$team.'" class="text-light">Update</a></button>
        <button class="btn btn-danger"><a href="delete.php?team='.$team.'" class="text-light">Delete</a></button>
        </td>
        </tr>';
      }
    }

  ?>

    

  </tbody>
</table>

    </div>

    

</body>
</html>