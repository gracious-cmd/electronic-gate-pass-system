<?php require_once __DIR__.'/functions.php'; $pageTitle=$pageTitle ?? 'Gate Pass System'; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=e($pageTitle)?></title><link rel="stylesheet" href="/electronic-gate-pass/assets/css/style.css"></head><body>
<header class="topbar"><a class="brand" href="/electronic-gate-pass/">SECURE<span>GATE</span></a><nav>
<?php if (!empty($_SESSION['user'])): ?><span class="welcome"><?=e($_SESSION['user']['name'])?> · <?=e($_SESSION['user']['role'])?></span><a href="/electronic-gate-pass/logout.php">Logout</a><?php else: ?><a href="/electronic-gate-pass/login.php">Login</a><?php endif; ?>
</nav></header><main class="container"><?php show_flash(); ?>
