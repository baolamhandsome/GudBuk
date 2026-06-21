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
            <button class="btn-add-book">Thêm sách</button>
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
                        <button class="btn-edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                        <button class="btn-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg></button>
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