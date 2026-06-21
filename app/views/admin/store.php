<?php
// Giải nén dữ liệu từ controller
$bestBook = $data[0] ?? [];
$curpage = $data[1] ?? 1;
$maxpage = $data[2] ?? 1;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GudBuk/public/css/admin.css">
    <link rel="stylesheet" href="/GudBuk/public/css/home.css">
</head>

<body>
    <!-- Books Grid -->
    <div class="store-grid">
        <?php if (!empty($bestBook)): ?>
            <?php foreach ($bestBook as $book): ?>
                <div class="book-card" data-bookid="<?php echo $book['bookid']; ?>">
                    <!-- Book Info -->
                    <div class="book-info">
                        <!-- Author -->
                        <p class="book-author">
                            <?php echo htmlspecialchars($book['author'] ?? 'Tác giả'); ?>
                        </p>

                        <!-- Title -->
                        <h3 class="book-title">
                            <?php echo htmlspecialchars($book['title'] ?? 'Tên sách'); ?>
                        </h3>

                        <!-- Price Section -->
                        <div class="book-price-section">
                            <div class="book-price-container">
                                <span class="book-price-current">
                                    <?php echo number_format($book['price'] ?? 0, 0, ',', '.'); ?>
                                </span>
                                <span class="book-price-currency">$</span>
                            </div>
                        </div>

                        <!-- Sold Info -->
                        <div class="book-sold-section">
                            <p class="book-sold-info">
                                Đã bán: <strong><?php echo htmlspecialchars($book['sold'] ?? 0); ?> cuốn</strong>
                            </p>
                        </div>
                    </div>
                    <div class="book-actions" style="display: flex; gap: 8px; margin-top: 12px;">
                        <button class="btn-edit">Sửa</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state" style="grid-column: 1 / -1;">
                <p>Không có sách nào để hiển thị</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($maxpage > 1): ?>
        <div class="pagination-container">
            <?php if ($curpage > 1): ?>
                <a href="/gudbuk/admin-dashboard/store?curpage=1" class="pagination-btn">« Đầu</a>
                <a href="/gudbuk/admin-dashboard/store?curpage=<?php echo $curpage - 1; ?>" class="pagination-btn">‹ Trước</a>
            <?php endif; ?>

            <span class="pagination-info">
                Trang <?php echo $curpage; ?> / <?php echo $maxpage; ?>
            </span>

            <?php if ($curpage < $maxpage): ?>
                <a href="/gudbuk/admin-dashboard/store?curpage=<?php echo $curpage + 1; ?>" class="pagination-btn">Sau ›</a>
                <a href="/gudbuk/admin-dashboard/store?curpage=<?php echo $maxpage; ?>" class="pagination-btn">Cuối »</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <script src="/GudBuk/public/js/store.js"></script>
</body>

</html>