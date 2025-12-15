<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
</head>
<body>
    <?php include 'db.php'; ?>
    <h3>Note App</h3>
<div class="create">
    <form action="FormHandling.php" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Enter Title Here">
<br>
        <label for="context">Enter Contents</label>
        <textarea type="text" name="context" id="context" placeholder="Your notes context goes here..."></textarea><br>

        <button type="submit" name="action" value="create">Create</button>
        
    </form>
</div>

<?php
    $sql = "SELECT * FROM noteapp";
    $result = $conn->query($sql);

    if($result->num_rows==0){
        echo "No notes";
    }
    echo "Notes:";
    while($row = $result->fetch_assoc()){
        echo "<br>".htmlspecialchars($row['id'])."\t | \t"  . htmlspecialchars($row['title'])."\t | \t" . htmlspecialchars($row['context']);
    };

?>

<form action="FormHandling.php" method="POST">
    <label for="id">ID:</label>
    <input type="text" name="id"  id="id" placeholder="Enter id to delete note">
    <button type="submit" name="action" value="delete">Delete</button>
</form>

<form action="FormHandling.php" method="POST">
    <label for="id">ID:</label>
    <input type="text" name="id"  id="id" placeholder="Enter id to update note">
    <label for="title">Title:</label>
    <input type="text" name="title"  id="title" placeholder="Enter new title">
    <label for="context">Content:</label>
    <textarea name="context"  id="context" placeholder="Enter its content"></textarea>
    <button type="submit" name="action" value="update">Update</button>
</form>


    
</body>
</html>