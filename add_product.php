<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/VS_Model.jpg" type="image/x-icon" />
    <title>Thêm sản phẩm mới - Admin</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" type="text/css">
    <link rel="stylesheet" href="css/add_product.css" type="text/css">
</head>
<body>
    <div class="container">
        <h2>Thêm sản phẩm mới</h2>
        <form action="add_product_script.php" method="POST" enctype="multipart/form-data">
            
            <div class="form_group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            
            <div class="form_group">
                <label for="price">Giá</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            
            <div class="form_group">
                <label for="image">Ảnh</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            
            <div class="form_group">
                <label for="category">Danh mục sản phẩm</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="" disabled selected>-- Hãy chọn danh mục --</option>
                    <option value="Jacket">Áo Khoác</option>
                    <option value="Pants">Quần Nam/Nữ</option>
                    <option value="T-Shirt">Áo Thun</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
        </form>
    </div>
</body>
</html>