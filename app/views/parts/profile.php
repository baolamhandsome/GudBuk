<?php
// views/profile.php

// Rút gọn mảng data để code phía dưới sạch sẽ (Clean Code) hơn
$user = $data['user'] ?? null;
$errors = $data['errors'] ?? [];
$flash = $data['flash'] ?? null;
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - GudBuk</title>
    <link rel="stylesheet" href="/gudbuk/public/css/profile.css">
</head>

<body>

    <header class="page-header">
        <h1>My Account</h1>
    </header>

    <main class="account-wrapper">

        <?php if (!$user): ?>

            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#e74c3c" stroke-width="1.5" style="margin-bottom: 15px;">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                    <line x1="3" y1="3" x2="21" y2="21"></line>
                </svg>
                <h2>Không tìm thấy thông tin tài khoản!</h2>
                <p>Tài khoản này không tồn tại, bạn chưa đăng nhập, hoặc phiên làm việc của bạn đã hết hạn. Vui lòng đăng nhập lại để tiếp tục.</p>
                <a href="/gudbuk/login" class="btn-return">Đăng nhập ngay</a>
            </div>

        <?php else: ?>

            <nav class="sidebar" aria-label="Account navigation">
                <a href="/gudbuk/profile?userid=<?php echo (int)$user['customerid']; ?>" class="active">Personal Information</a>
                <a href="/gudbuk/orderView">My orders</a>
                <a href="/gudbuk/logout">Logout</a>
            </nav>

            <section class="form-section">

                <?php if ($flash): ?>
                    <div id="flash-message" class="flash-<?php echo $flash['type']; ?>">
                        <?php echo htmlspecialchars($flash['message']); ?>
                    </div>
                <?php else: ?>
                    <div id="flash-message" style="display:none"></div>
                <?php endif; ?>

                <form class="form-grid" action="/gudbuk/profile" method="POST">

                    <input type="hidden" name="customerid" value="<?php echo (int)$user['customerid']; ?>">

                    <div class="field full">
                        <label for="name">Name <span class="req">*</span></label>
                        <input id="name" name="name" type="text"
                            value="<?php echo htmlspecialchars($user['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            class="<?php echo isset($errors['name']) ? 'invalid' : ''; ?>" required>
                        <span id="name-error" class="error-msg"><?php echo $errors['name'] ?? ''; ?></span>
                    </div>

                    <div class="field full">
                        <label for="email">Email <span class="req">*</span></label>
                        <input id="email" name="email" type="email"
                            value="<?php echo htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            class="<?php echo isset($errors['email']) ? 'invalid' : ''; ?>" required>
                        <span id="email-error" class="error-msg"><?php echo $errors['email'] ?? ''; ?></span>
                    </div>

                    <div class="field full">
                        <label for="phone">Phone <span class="req">*</span></label>
                        <input id="phone" name="phone" type="tel"
                            value="<?php echo htmlspecialchars($user['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            class="<?php echo isset($errors['phone']) ? 'invalid' : ''; ?>" required>
                        <span id="phone-error" class="error-msg"><?php echo $errors['phone'] ?? ''; ?></span>
                    </div>

                    <div class="full">
                        <button class="update-btn" type="submit">Update Changes</button>
                    </div>

                </form>

            </section>

        <?php endif; ?>
    </main>

    <?php if ($user): ?>
        <script src="/GudBuk/public/js/profile.js"></script>
    <?php endif; ?>

</body>

</html>