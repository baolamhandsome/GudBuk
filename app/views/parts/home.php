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
    <title>Trang Chủ - GudBuk</title>
    <link rel="stylesheet" href="/GudBuk/public/css/home.css">
</head>

<body>

    <h1 class="page-title"></h1>
    <div class="books-container">
        <!-- Books Grid -->
        <div class="books-grid">
            <?php if (!empty($bestBook)): ?>
                <?php foreach ($bestBook as $book): ?>
                    <div class="book-card" data-bookid="<?php echo $book['bookid']; ?>">
                        <!-- Book Image -->
                        <div class="book-image-container">
                            <img src="/GudBuk/asset/<?php echo $book['bookid']; ?>.jpg"
                                alt="<?php echo $book['title']; ?>"
                                onerror="this.src='/GudBuk/asset/placeholder.jpg'">
                        </div>

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
                    <a href="/gudbuk/home?curpage=1" class="pagination-btn">« Đầu</a>
                    <a href="/gudbuk/home?curpage=<?php echo $curpage - 1; ?>" class="pagination-btn">‹ Trước</a>
                <?php endif; ?>

                <span class="pagination-info">
                    Trang <?php echo $curpage; ?> / <?php echo $maxpage; ?>
                </span>

                <?php if ($curpage < $maxpage): ?>
                    <a href="/gudbuk/home?curpage=<?php echo $curpage + 1; ?>" class="pagination-btn">Sau ›</a>
                    <a href="/gudbuk/home?curpage=<?php echo $maxpage; ?>" class="pagination-btn">Cuối »</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Auth Links -->
    <div style="text-align: center; margin-top: 50px; padding-top: 30px; border-top: 2px solid rgba(0, 0, 0, 0.2);">
        <p style="color: #333; margin-bottom: 15px;">
            <a href="/gudbuk/logout" style="color: #333; text-decoration: underline;">Logout</a> |
            <a href="/gudbuk/login" style="color: #333; text-decoration: underline;">Login</a> |
            <a href="/gudbuk/register" style="color: #333; text-decoration: underline;">Signup</a>
        </p>
    </div>
    <script src="/GudBuk/public/js/home.js"></script>
</body>

</html>