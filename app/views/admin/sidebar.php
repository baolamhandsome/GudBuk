<!DOCTYPE html>
<html lang="en">
<?php
$ov = '';
$st = '';
$cus = '';
$fin = '';
switch ($view) {
    case 'overview':
        $ov = 'active';
        break;

    case 'store':
        $st = 'active';
        break;
    case 'customer':
        $cus = 'active';
        break;
    case 'fin':
        $fin = 'active';
        break;
    default:
        break;
}
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/GudBuk/public/css/admin.css">
    <title>gudbuk</title>
</head>

<span class="sidebar__section-label">Menu chính</span>

<!-- Overview -->
<a class="nav-item <?php echo $ov; ?>" href="/gudbuk/admin-dashboard">
    <span class="nav-item__icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7" />
            <rect x="14" y="3" width="7" height="7" />
            <rect x="14" y="14" width="7" height="7" />
            <rect x="3" y="14" width="7" height="7" />
        </svg>
    </span>
    Overview
</a>

<!-- Store -->
<a class="nav-item <?php echo $st; ?>" href="/gudbuk/admin-dashboard/store">
    <span class="nav-item__icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
            <line x1="3" y1="6" x2="21" y2="6" />
            <path d="M16 10a4 4 0 0 1-8 0" />
        </svg>
    </span>
    Store
</a>

<!-- Customer -->
<a class="nav-item <?php echo $cus; ?>" href="/gudbuk/admin-dashboard/customer">
    <span class="nav-item__icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
        </svg>
    </span>
    Customer
</a>

<!-- Financial -->
<a class="nav-item <?php echo $fin; ?>" href="/gudbuk/admin-dashboard/financial">
    <span class="nav-item__icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="1" x2="12" y2="23" />
            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
        </svg>
    </span>
    Financial
</a>

<!-- Bottom -->
<div class="sidebar__bottom">
    <a class="nav-item" href="/gudbuk/logout">
        <span class="nav-item__icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
        </span>
        Đăng xuất
    </a>
</div>

</html>