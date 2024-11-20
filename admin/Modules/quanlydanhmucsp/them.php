<style>
     .form-container {
            width: 400px;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 50px auto;
            
        }
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            color: #555;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], 
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus {
            border-color: #0c5454;
            outline: none;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #0c5454;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }
        .submit-btn:hover {
            background-color: #084848;
        }
</style>

<div class="form-container">
        <h2>Thêm Danh Mục Sản Phẩm</h2>
        <form action="Modules/quanlydanhmucsp/xuly.php" method="post">
            <div class="form-group">
                <label for="categoryName">Tên Danh Mục</label>
                <input type="text" id="categoryName" name="tendanhmuc" required placeholder="Nhập tên danh mục">
            </div>
            <div class="form-group">
                <label for="categoryOrder">Thứ tự</label>
                <input type="number" id="categoryOrder" name="thutu" min="1" required placeholder="Nhập thứ tự">
            </div>
            <button type="submit" name="themdanhmuc" class="submit-btn">Thêm Danh Mục Sản Phẩm</button>
        </form>
    </div>