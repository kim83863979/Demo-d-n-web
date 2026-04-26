<?php
require 'connection.php';
$id = $_GET['id']; 
$query = "SELECT * FROM items WHERE id = $id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" type="text/css">
</head>
<body>
    <div class="container">
    <h2>Cập nhật giá cho: <?php echo $row['name']; ?></h2>
    <form action="edit_price_script.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <div class="form-group">
            <label>Giá hiện tại (VNĐ):</label>
            <input type="number" name="new_price" class="form-control" 
                   value="<?php echo $row['price']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
</body>
</html>
