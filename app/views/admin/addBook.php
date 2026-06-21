<?php

// echo '<pre>';
// print_r($data);
// echo '</pre>';
$allCategory = $data[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GudBuk/public/css/admin.css">
    <link rel="stylesheet" href="/GudBuk/public/css/editBook.css">
    <link rel="stylesheet" href="/GudBuk/public/css/addBook.css">
    <title>Chỉnh sửa sách - GudBuk Admin</title>
</head>

<body>
    <div class="edit-book-container">
        <!-- Back button -->
        <a href="../store" class="back-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12" />
                <polyline points="12 19 5 12 12 5" />
            </svg>
            Quay lại
        </a>

        <div class="edit-book-header">
            <div class="header-left">
                <h1>Thêm sách mới</h1>
                <p class="subtitle">Nhập thông tin chi tiết cho cuốn sách mới</p>
            </div>
        </div>

        <!-- Form -->
        <form class="add-book-form" method="POST" enctype="multipart/form-data">
            <div class="form-content">
                <!-- Left column - Text fields -->
                <div class="form-left">

                    <!-- Tên sách -->
                    <div class="form-group">
                        <label for="bookTitle">Tên sách <span class="required">*</span></label>
                        <input type="text" id="bookTitle" name="title" value="" placeholder="Nhập tên sách" required />
                    </div>

                    <!-- Tác giả -->
                    <div class="form-group">
                        <label for="bookAuthor">Tác giả <span class="required">*</span></label>
                        <input type="text" id="bookAuthor" name="author" value="" placeholder="Nhập tên tác giả" required />
                    </div>

                    <!-- ISBN (Nếu bạn muốn admin tự nhập) -->
                    <div class="form-group">
                        <label for="bookIsbn">ISBN</label>
                        <input type="text" id="bookIsbn" name="isbn" value="" placeholder="Nhập mã ISBN" />
                    </div>

                    <div class="form-row">
                        <!-- Số lượng -->
                        <div class="form-group">
                            <label for="bookQuantity">Số lượng <span class="required">*</span></label>
                            <input type="number" id="bookQuantity" name="stock_quantity" value="" placeholder="0" min="0" required />
                        </div>

                        <!-- Giá -->
                        <div class="form-group">
                            <label for="bookPrice">Giá <span class="required">*</span></label>
                            <input type="number" id="bookPrice" name="price" value="" placeholder="0" min="0" required />
                        </div>
                    </div>

                    <!-- Mô tả -->
                    <div class="form-group">
                        <label for="bookDescription">Mô tả</label>
                        <textarea id="bookDescription" name="description" placeholder="Nhập mô tả về cuốn sách..." rows="6"></textarea>
                    </div>

                    <!-- Thể loại -->
                    <div class="form-group category-group">
                        <label>Thể loại</label>
                        <div class="category-list">
                            <?php foreach ($allCategory as $cat): ?>
                                <button type="button"
                                    id='<?php echo $cat['categoryid']; ?>'
                                    class="category-btn">
                                    <?php echo $cat['categoryname']; ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <!-- Input ẩn để lưu các categoryid được chọn khi submit form -->
                        <input type="hidden" name="selected_categories" id="selectedCategories">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Thêm sách</button>
                <a href="../store" class="btn btn-cancel">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                    Hủy
                </a>
            </div>
        </form>
    </div>
    <script src="/GudBuk/public/js/addBook.js"></script>
</body>

</html>