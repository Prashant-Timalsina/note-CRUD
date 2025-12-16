<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Notes App</title>
</head>
<body>

    <?php include 'db.php'; ?>
    <?php include 'FormHandling.php' ?>
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
    function e($data) {
        return htmlspecialchars(
            html_entity_decode($data, ENT_QUOTES, 'UTF-8'),
            ENT_QUOTES,
            'UTF-8'
        );
    }

$rows = [];
if (!isset($conn) || !$conn instanceof PDO) {
    echo "Database connection not available.";
} else {
    try {
        $sql = "SELECT * FROM noteapp ORDER BY id DESC LIMIT 5";
        $stmt = $conn->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "DB Error: " . htmlspecialchars($e->getMessage());
        $rows = [];
    }
}

if(empty($rows)){
    echo "No notes";
} else {
    foreach($rows as $row){
        echo "
        <div class='list'>
            <div class='idlist'>" . (int)$row['id'] . ")</div>
            <div class='content'>
                <div class='title'>" . e($row['title']) . "</div>
                <div class='context'>" . e($row['context']) . "</div>
            </div>
            <div class='action'>
                <form action='FormHandling.php' method='POST'>
                    <input type='hidden' name='id' value='" . (int)$row['id'] . "'>
                    <button type='submit' name='action' value='delete'>Delete</button>
                </form>
            </div>
        </div>
        <hr>";
    }
}
?>




    
</body>
</html>