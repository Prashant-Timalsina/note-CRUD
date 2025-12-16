<?php

include 'db.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $action = $_POST['action'];
    switch($action){
        case 'create':
            $sql= "INSERT INTO noteapp (title,context) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss",$_POST['title'],$_POST['context']);

            $stmt-> execute();
            echo "<script>alert('Note added');</script>";
            echo "<script>window.location.href='index.php';</script>";

            break;
    
        case 'delete':
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $id= intval($_POST['id']);
                $sql = "DELETE FROM noteapp WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i",$id);
                $stmt->execute();

                if($stmt->affected_rows > 0){
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
                $title = htmlspecialchars($_POST['title']);
                $context = htmlspecialchars($_POST['context']);

                $sql = "UPDATE noteapp SET title=?, context=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi",$title,$context,$id);
                $stmt->execute();

                if($stmt->affected_rows > 0){
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

