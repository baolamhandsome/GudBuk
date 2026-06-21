<?php
// Lấy dữ liệu cuốn sách từ controller
// Dữ liệu có thể truyền qua: $data['book'] hoặc $book
// echo '<pre>';
// print_r($data);
// echo '</pre>';

// Xử lý fallback nếu không có data
$bookid = $data[0]['bookid'] ?? '';
$title = $data[0]['title'] ?? '';
$author = $data[0]['author'] ?? '';
$price = $data[0]['price'] ?? '';
$quantity = $data[0]['stock_quantity'] ?? '';
$description = $data[0]['description'] ?? '';
$isbn = $data[0]['isbn'] ?? '';
$image = $data[0]['image'] ?? '';
$allCategory = $data[1];
$bookCategories = $data[2];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GudBuk/public/css/admin.css">
    <link rel="stylesheet" href="/GudBuk/public/css/editBook.css">
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
        <?php if (!$data[0]): ?>

            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#e74c3c" stroke-width="1.5" style="margin-bottom: 15px;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <h2>Không tìm thấy thông tin sách!</h2>
                <p>Cuốn sách bạn đang tìm kiếm không tồn tại, sai ID hoặc đã bị xóa khỏi hệ thống.</p>
                <a href="../store" class="btn-return">Quay lại Cửa hàng</a>
            </div>

        <?php else: ?>
            <div class="edit-book-header">
                <div class="header-left">
                    <h1>Chỉnh sửa thông tin sách</h1>
                    <p class="subtitle">ID sách: <strong><?php echo htmlspecialchars($bookid); ?></strong></p>
                </div>
            </div>

            <!-- Form -->
            <form class="edit-form" method="POST" enctype="multipart/form-data">

                <div class="form-content">

                    <!-- Left column - Text fields -->
                    <div class="form-left">

                        <!-- ID (read-only) -->
                        <div class="form-group">
                            <label for="bookId">ID Sách</label>
                            <input type="text" id="bookId" name="bookid" value="<?php echo htmlspecialchars($bookid); ?>" readonly />
                        </div>

                        <!-- Tên sách -->
                        <div class="form-group">
                            <label for="bookTitle">Tên sách <span class="required">*</span></label>
                            <input type="text" id="bookTitle" name="title" value="<?php echo htmlspecialchars($title); ?>" placeholder="Nhập tên sách" />
                        </div>

                        <!-- Tác giả -->
                        <div class="form-group">
                            <label for="bookAuthor">Tác giả <span class="required">*</span></label>
                            <input type="text" id="bookAuthor" name="author" value="<?php echo htmlspecialchars($author); ?>" placeholder="Nhập tên tác giả" />
                        </div>


                        <!-- ISBN -->
                        <div class="form-group">
                            <label for="bookIsbn">ISBN</label>
                            <input type="text" id="bookIsbn" name="isbn" value="<?php echo htmlspecialchars($isbn); ?>" readonly />
                        </div>

                        <div class="form-row">
                            <!-- Số lượng -->
                            <div class="form-group">
                                <label for="bookQuantity">Số lượng <span class="required">*</span></label>
                                <input type="number" id="bookQuantity" name="stock_quantity" value="<?php echo htmlspecialchars($quantity); ?>" placeholder="0" min="0" />
                            </div>

                            <!-- Giá -->
                            <div class="form-group">
                                <label for="bookPrice">Giá <span class="required">*</span></label>
                                <input type="number" id="bookPrice" name="price" value="<?php echo htmlspecialchars($price); ?>" placeholder="0" min="0" />
                            </div>
                        </div>

                        <!-- Mô tả -->
                        <div class="form-group">
                            <label for="bookDescription">Mô tả</label>
                            <textarea id="bookDescription" name="description" placeholder="Nhập mô tả về cuốn sách..." rows="6"><?php echo htmlspecialchars($description); ?></textarea>
                        </div>
                        <div class="form-group category-group"><label>Thể loại</label>
                            <div class="category-list">
                                <?php foreach ($allCategory as $cat): ?>
                                    <button type="button" id='<?php echo $cat['categoryid']; ?>'
                                        class="category-btn 
                                        <?php foreach ($bookCategories as $bookCategory):
                                            if ($bookCategory['categoryid'] == $cat['categoryid']) {
                                                echo ' category-selected';
                                                break;
                                            }
                                        endforeach; ?>">
                                        <?php echo $cat['categoryname']; ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Right column - Image preview -->
                    <div class="form-right">
                        <div class="image-section">
                            <label>Hình ảnh bìa</label>
                            <div class="image-preview">
                                <img src="/GudBuk/asset/<?php echo $bookid; ?>.jpg"
                                    alt="<?php echo $title; ?>"
                                    onerror="this.src='/GudBuk/asset/placeholder.jpg'">
                            </div>
                        </div>

                        <!-- Info summary -->
                        <div class="info-summary">
                            <h3>Thông tin sách</h3>
                            <div class="summary-item">
                                <span class="label">Tên:</span>
                                <span class="value"><?php echo htmlspecialchars($title) ?: 'Chưa nhập'; ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Tác giả:</span>
                                <span class="value"><?php echo htmlspecialchars($author) ?: 'Chưa nhập'; ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Giá:</span>
                                <span class="value"><?php echo $price ? number_format($price, 0, ',', '.') . ' $' : '0 $'; ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Số lượng:</span>
                                <span class="value"><?php echo htmlspecialchars($quantity) ?: '0'; ?></span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Form actions -->
                <div class="form-actions">
                    <a href="../store" class="btn btn-cancel">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                        Hủy
                    </a>
                    <button type="submit" class="btn btn-save">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
    <script src="/GudBuk/public/js/editBook.js"></script>
</body>

</html>