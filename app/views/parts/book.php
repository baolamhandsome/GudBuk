<?php
// Giải nén dữ liệu từ controller
$book = $data[0] ?? [];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - GudBuk</title>
    <link rel="stylesheet" href="/GudBuk/public/css/book.css">
</head>

<body>
    <div class="book-detail-container">
        <!-- KHỐI BÊN TRÁI: Hình ảnh và Nút tương tác -->
        <div class="book-detail-left">
            <div class="book-image-container">
                <img src="/GudBuk/asset/<?php echo $book['bookid']; ?>.jpg"
                    alt="<?php echo $book['title']; ?>"
                    onerror="this.src='/GudBuk/asset/placeholder.jpg'">
            </div>
            <div class="book-actions">
                <button class="add-cart-btn" data-bookid=<?= $book['bookid'] ?>>Add to Cart</button>
            </div>
        </div>

        <!-- KHỐI BÊN PHẢI: Thông tin chi tiết -->
        <div class="book-info">
            <h1 class="book-title"><?php echo $book['title']; ?></h1>

            <div class="book-price-container">
                <span class="book-price-current"><?php echo number_format($book['price'], 0, ',', '.'); ?>$</span>
            </div>

            <p class="book-author">Tác giả: <?php echo $book['author']; ?></p>

            <div class="book-meta">
                <p><strong>Preiew: </strong> <?php echo $book['description'] ?></p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/GudBuk/public/js/book.js"></script>
</body>

</html>