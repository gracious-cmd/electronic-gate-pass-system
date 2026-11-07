<?php
require_once __DIR__.'/../config/database.php'; require_once __DIR__.'/../includes/functions.php'; require_role(['admin']);
$stats=[]; foreach(['visitors'=>'All requests','pending'=>'Pending','approved'=>'Approved','inside'=>'Currently inside'] as $key=>$label){
 if($key==='visitors') $q=$conn->query("SELECT COUNT(*) n FROM visitors");
 else if($key==='inside') $q=$conn->query("SELECT COUNT(*) n FROM visitors WHERE entry_time IS NOT NULL AND exit_time IS NULL");
 else { $s=$conn->prepare("SELECT COUNT(*) n FROM visitors WHERE status=?"); $s->bind_param('s',$key); $s->execute(); $q=$s->get_result(); }
 $stats[$label]=(int)$q->fetch_assoc()['n'];
}
$pageTitle='Admin Dashboard'; require '../includes/header.php'; ?><div class="layout"><?php require '../includes/admin_nav.php'; ?><section class="content"><h1>Admin Dashboard</h1><p class="muted">Overview of visitor access activity.</p><div class="stats"><?php foreach($stats as $label=>$n): ?><div class="stat"><span><?=e($label)?></span><strong><?=$n?></strong></div><?php endforeach; ?></div><div class="panel"><h2>Quick actions</h2><div class="actions"><a class="btn" href="approvals.php">Review requests</a><a class="btn secondary" href="visitors.php">View visitors</a><a class="btn secondary" href="employees.php">Manage employees</a></div></div></section></div><?php require '../includes/footer.php'; ?>
