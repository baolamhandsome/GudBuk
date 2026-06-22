<?php
// Lấy dữ liệu danh sách khách hàng từ controller
// Dữ liệu có thể truyền qua: $data['customers'] hoặc $customers
// echo '<pre>';
// print_r($data);
// echo '</pre>';
$customers = $data[0] ?? [];
$curpage = $data[1] ?? 1;
$maxpage = $data[2] ?? 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GudBuk/public/css/admin.css">
    <link rel="stylesheet" href="/GudBuk/public/css/customerAdmin.css">
    <title>Danh sách khách hàng - GudBuk Admin</title>
</head>

<body>
    <div class="customer-container">

        <!-- Header -->
        <div class="customer-header">
            <div class="header-left">
                <h1>Danh sách khách hàng</h1>
                <p class="subtitle">Tổng cộng: <strong><?php echo count($customers); ?></strong> khách hàng</p>
            </div>
        </div>

        <!-- Customer list -->
        <div class="customer-grid">
            <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $customer): ?>
                    <div class="customer-card" data-customerid="<?php echo $customer['customerid']; ?>">
                        <!-- Card Header (Click to expand) -->
                        <div class=" card-header" onclick="toggleCardExpand(this)">
                            <div class="card-info">
                                <p class="customer-name"><?php echo htmlspecialchars($customer['name'] ?? 'N/A'); ?></p>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-delete" title="Xóa">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Card Content (Expanded) -->
                        <div class="card-content">
                            <div class="content-item">
                                <span class="label">Email: </span>
                                <span class="value"><?php echo htmlspecialchars($customer['email'] ?? 'N/A'); ?></span>
                            </div>
                            <div class="content-item">
                                <span class="label">Điện thoại:</span>
                                <span class="value"><?php echo htmlspecialchars($customer['phone'] ?? 'Chưa cập nhật'); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <h3>Chưa có khách hàng nào</h3>
                    <p>Danh sách khách hàng sẽ hiển thị ở đây</p>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Pagination -->
    <?php if ($maxpage > 1): ?>
        <div class="pagination-container">
            <?php if ($curpage > 1): ?>
                <a href="/gudbuk/admin-dashboard/customer?curpage=1" class="pagination-btn">« Đầu</a>
                <a href="/gudbuk/admin-dashboard/customer?curpage=<?php echo $curpage - 1; ?>" class="pagination-btn">‹ Trước</a>
            <?php endif; ?>

            <span class="pagination-info">
                Trang <?php echo $curpage; ?> / <?php echo $maxpage; ?>
            </span>

            <?php if ($curpage < $maxpage): ?>
                <a href="/gudbuk/admin-dashboard/customer?curpage=<?php echo $curpage + 1; ?>" class="pagination-btn">Sau ›</a>
                <a href="/gudbuk/admin-dashboard/customer?curpage=<?php echo $maxpage; ?>" class="pagination-btn">Cuối »</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <script src="/GudBuk/public/js/customerAdmin.js"></script>
</body>

</html>