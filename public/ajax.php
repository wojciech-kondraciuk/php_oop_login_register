<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boilerplate";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $commentNewCount = $_POST['commentNewCount']??null;
    $stmt = $conn->prepare("SELECT * FROM links LIMIT $commentNewCount");
    $stmt->execute();
  
    $rows = $stmt->fetchAll();

    foreach ($rows as $row) {
        echo "
        <tr class='item'>
            <th>".$row['id']."</th>
            <td><a href='".$row['link']."' target='_blank'>".$row['link']."</a></td>
            <td>".$row['name']."</td>
            <td>".$row['tag']."</td>
        </tr>
        ";
    }

  } catch(PDOException $e) {
    return $e->getMessage();
  }

  $conn = null;


  ?>


