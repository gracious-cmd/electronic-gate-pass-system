<?php
require_once __DIR__.'/../config/database.php'; require_once __DIR__.'/../includes/functions.php';
$pass=$_SESSION['new_pass']??($_GET['pass']??''); unset($_SESSION['new_pass']);
$stmt=$conn->prepare("SELECT * FROM visitors WHERE pass_no=?"); $stmt->bind_param('s',$pass); $stmt->execute(); $v=$stmt->get_result()->fetch_assoc();
$pageTitle='Gate Pass Status'; require '../includes/header.php';
?>
<div class="form-card narrow"><?php if(!$v): ?><h1>Pass not found</h1><p>Submit a new request or check the pass reference.</p><?php else: ?><h1>Gate Pass Request</h1><div class="pass-number"><?=e($v['pass_no'])?></div><span class="status <?=e($v['status'])?>"><?=e(strtoupper($v['status']))?></span><p><b>Visitor:</b> <?=e($v['name'])?></p><p><b>Host:</b> <?=e($v['host_name'])?></p><p><b>Visit:</b> <?=e($v['visit_date'])?> at <?=e($v['visit_time'])?></p><p><b>Purpose:</b> <?=e($v['purpose'])?></p><p class="muted">Keep your pass reference. It becomes valid only when approved by the organisation.</p><button class="btn secondary" onclick="window.print()">Print status</button><?php endif; ?></div>
<?php require '../includes/footer.php'; ?>
