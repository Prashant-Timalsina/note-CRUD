<?php

include 'db.php';

// $tbcreate="
//     CREATE noteapp IF NOT EXIST (
//         id INT PRIMARY KEY AUTO_INCREMENT,
//         title VARCHAR(20),
//         context VARCHAR(200)
//     );
// ";

// if($conn->query($tbcreate)){
//     echo "Table Created";
// } else {
//     echo "Error: ".$tbcreate."<br>". $conn->error;
// }


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $action = $_POST['action'];
    switch($action){
        case 'create':
            $sql= "INSERT INTO noteapp (title,context) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss",$_POST['title'],$_POST['context']);

            $stmt-> execute();
            echo "Note Added";

            // header ("Location: index.php");
            // exit();

            break;

        // case 'update':
            
    
        case 'delete':
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $id= intval($_POST['id']);
                $sql = "DELETE FROM noteapp WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i",$id);
                $stmt->execute();
                echo "Note Deleted";
            } else {
                echo "No id to delete";
            }          

            // header("Location: index.php");
            // exit();

            break;
        
        case 'update':
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $id= intval($_POST['id']);
                $title = htmlspecialchars($_POST['title']);
                $context = htmlspecialchars($_POST['context']);

                $sql = "UPDATE noteapp SET title=?, context=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi",$title,$context,$id);
                $stmt->execute();
                echo "Note Updated";
            } else {
                echo "No id to delete";
            }
            break;

        default:
        return;
    }
}

