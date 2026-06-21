<?php
// views/profile.php
// $data['user']       = row từ bảng customer (customerID, name, email, phone, address, ...)
// $data['csrf_token'] = token chống CSRF
// $data['errors']     = mảng lỗi validate (nếu có), key theo tên field
// $data['flash']      = ['type'=>'success|error', 'message'=>'...']
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="/gudbuk/public/css/profile.css">
</head>
<body>

<header class="page-header">
    <h1>My Account</h1>
    <div class="breadcrumb">Home &nbsp;/&nbsp; <span>My Account</span></div>
</header>

<main class="account-wrapper">

    <nav class="sidebar" aria-label="Account navigation">
        <a href="/gudbuk/profile?userid=<?php echo (int)($data['user']['customerid'] ?? 0); ?>" class="active">Personal Information</a>
        <a href="/gudbuk/orderView">My orders</a>
        <a href="/gudbuk/logout">Logout</a>
    </nav>

    <section class="form-section">

        <div id="flash-message" style="display:none"></div>

        <form class="form-grid" action="/gudbuk/profile" method="POST">

            <input type="hidden" name="customerid" value="<?php echo (int)($data['user']['customerid'] ?? 0); ?>">

            <div class="field full">
                <label for="name">Name <span class="req">*</span></label>
                <input id="name" name="name" type="text"
                       value="<?php echo htmlspecialchars($data['user']['name'] ?? ''); ?>"
                       class="<?php echo isset($data['errors']['name']) ? 'invalid' : ''; ?>" required>
                <?php if (isset($data['errors']['name'])): ?>
                    <span class="error-msg"><?php echo htmlspecialchars($data['errors']['name']); ?></span>
                <?php endif; ?>
            </div>

            <div class="field full">
                <label for="email">Email <span class="req">*</span></label>
                <input id="email" name="email" type="email"
                       value="<?php echo htmlspecialchars($data['user']['email'] ?? ''); ?>"
                       class="<?php echo isset($data['errors']['email']) ? 'invalid' : ''; ?>" required>
                <?php if (isset($data['errors']['email'])): ?>
                    <span class="error-msg"><?php echo htmlspecialchars($data['errors']['email']); ?></span>
                <?php endif; ?>
            </div>

            <div class="field full">
                <label for="phone">Phone <span class="req">*</span></label>
                <input id="phone" name="phone" type="tel"
                       value="<?php echo htmlspecialchars($data['user']['phone'] ?? ''); ?>"
                       class="<?php echo isset($data['errors']['phone']) ? 'invalid' : ''; ?>" required>
                <?php if (isset($data['errors']['phone'])): ?>
                    <span class="error-msg"><?php echo htmlspecialchars($data['errors']['phone']); ?></span>
                <?php endif; ?>
            </div>

            <div class="full">
                <button class="update-btn" type="submit">Update Changes</button>
            </div>

        </form>

    </section>

</main>

    <script  src="/GudBuk/public/js/profile.js"></script>
</body>
</html>