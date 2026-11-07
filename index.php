<?php
require_once __DIR__.'/config/database.php'; require_once __DIR__.'/includes/functions.php';
if (!empty($_SESSION['user'])) {
    redirect($_SESSION['user']['role']==='security' ? 'security/dashboard.php' : 'admin/dashboard.php');
}
$pageTitle='Electronic Security Gate Pass'; require 'includes/header.php';
?>
<section class="hero"><div><p class="eyebrow">VISITOR & ACCESS MANAGEMENT</p><h1>Electronic Security<br><span>Gate Pass System</span></h1><p>Register visitors, approve visits and record secure entry and exit activities from one simple platform.</p><div class="actions"><a class="btn" href="visitor/register.php">Request a Gate Pass</a><a class="btn secondary" href="login.php">Staff Login</a></div></div><div class="hero-card"><div class="shield">✓</div><h3>Controlled Access</h3><p>Every visit has a unique pass reference and a recorded gate activity.</p></div></section>
<?php require 'includes/footer.php'; ?>
