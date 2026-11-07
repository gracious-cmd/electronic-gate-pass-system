<?php
require_once __DIR__.'/config/database.php'; require_once __DIR__.'/includes/functions.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    verify_csrf(); $email=trim($_POST['email']??''); $password=$_POST['password']??'';
    $stmt=$conn->prepare("SELECT id,name,email,password,role FROM users WHERE email=? AND status='active' LIMIT 1");
    $stmt->bind_param('s',$email); $stmt->execute(); $u=$stmt->get_result()->fetch_assoc();
    if($u && password_verify($password,$u['password'])){
        session_regenerate_id(true); unset($u['password']); $_SESSION['user']=$u;
        redirect($u['role']==='security'?'security/dashboard.php':'admin/dashboard.php');
    } else $error='Invalid email or password.';
}
$pageTitle='Staff Login'; require 'includes/header.php';
?>
<div class="form-card narrow"><h1>Staff Login</h1><p>Sign in to manage gate access.</p><?php if($error): ?><div class="alert danger"><?=e($error)?></div><?php endif; ?>
<form method="post"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>"><label>Email address</label><input type="email" name="email" required><label>Password</label><input type="password" name="password" required><button class="btn full">Sign in</button></form><p class="muted">First time? Open <a href="setup.php">initial setup</a> to create the administrator.</p></div>
<?php require 'includes/footer.php'; ?>
