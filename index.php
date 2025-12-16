<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Notes App</title>
</head>
<body>

    <?php include 'db.php'; ?>
    <h2 style="text-align:center; text-decoration:underline">Note App</h2>


<div class="container">
    <div class="create card">
        <h3>Create a new Note</h3>
        <form action="FormHandling.php" method="POST">

            <input type="text" name="title" id="title" placeholder="Enter Title Here">
    <br>

            <textarea type="text" name="context" id="context" placeholder="Your notes context goes here..."></textarea><br>

            <button type="submit" name="action" value="create">Create</button>
            
        </form>
    </div>
    <br>

    <div class="update card" >
            <h3>Update Notes</h3>
            <form action="FormHandling.php" method="POST">
                <div class="identify">
                    <label for="update_id">ID:</label>
                    <input type="text"  name="id"  id="update_id" ><br>
                    <small>Enter id to update note</small>
                </div>

                <input type="text" name="title"  id="title" placeholder="Enter new title">

                <textarea name="context"  id="context" placeholder="Enter its content"></textarea>
                <button type="submit" name="action" value="update">Update</button>
            </form>
    </div>
</div>

<br>

<!------- View or delete notes ------------>
<div class="view">    
<?php
    $sql = "SELECT * FROM noteapp ORDER BY id DESC LIMIT 5 ";
    $result = $conn->query($sql);

    if($result->num_rows==0){
        echo "No notes";
    }
    ?>
<h3>Notes:</h3>

<?php 
while ($row = $result->fetch_assoc()) {
    echo "
    <div class='list'>
        <div class='idlist'>" . htmlspecialchars($row['id']) . ")</div>

        <div class='content'>
            <div class='title'>" . htmlspecialchars($row['title']) . "</div>
            <div class='context'>" . htmlspecialchars($row['context']) . "</div>
        </div>

        <div class='action'>
            <form action='FormHandling.php' method='POST'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <button type='submit' name='action' value='delete'>Delete</button>
            </form>
        </div>
    </div><hr>";
}
?>



    
</body>
</html>