<?php

include 'db.php';

// Function to sanitize input
function datacheck($data) {
    $data = trim($data);              // Remove extra spaces at start/end
    $data = stripslashes($data);      // Remove backslashes
    $data = htmlspecialchars($data);  // Escape HTML characters
    return $data;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $action = $_POST['action'];
    switch($action){
        case 'create':
            $title = datacheck($_POST['title']);
            $context = datacheck($_POST['context']);

            $sql= "INSERT INTO noteapp (title,context) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            // $stmt->bindParam(1,$title,PDO::PARAM_STR);
            // $stmt->bindParam(2,$context,PDO::PARAM_STR);
            $stmt->execute([$title,$context]);

            echo "<script>alert('Note added');</script>";
            echo "<script>window.location.href='index.php';</script>";
            break;
    
        case 'delete':
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $id= intval($_POST['id']);
                $sql = "DELETE FROM noteapp WHERE id=?";
                $stmt = $conn->prepare($sql);
                // $stmt->bindParam(":id",$id,PDO::PARAM_INT);
                $stmt->execute([$id]);

                if($stmt->rowCount() > 0){
                    echo "<script>alert('Note Deleted');</script>";
                } else {
                    echo "<script>alert('Note Not Found');</script>";
                }
                echo "<script>window.location.href='index.php';</script>";

            } else {
                echo "<script>alert('No id to delete');</script>";
                echo "<script>window.location.href='index.php';</script>";
            }          
            break;
        
        case 'update':
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $id= intval($_POST['id']);
                $title = datacheck($_POST['title']);
                $context = datacheck($_POST['context']);

                $sql = "UPDATE noteapp SET title=?, context=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                // $stmt->bind_param("ssi",$title,$context,$id);
                // $stmt->bindParam(1,$title);
                // $stmt->bindParam(2,$context);
                // $stmt->bindParam(3,$id);
                $stmt->execute([$title,$context,$id]);
                // $stmt->execute();

                if($stmt->rowCount() > 0){
                    echo "<script>alert('Note Updated');</script>";
                } else {
                    echo "<script>alert('Note Not Found');</script>";
                }
                echo "<script> window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('No id to update');</script>";
                echo "<script>window.location.href='index.php';</script>";
            }
            break;

        default:
            return;
    }
}
