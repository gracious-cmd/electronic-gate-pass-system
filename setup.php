<?php
require_once __DIR__.'/config/database.php';
require_once __DIR__.'/includes/functions.php';
$count=(int)$conn->query("SELECT COUNT(*) AS n FROM users")->fetch_assoc()['n'];
$message='';
if ($_SERVER['REQUEST_METHOD']==='POST' && $count===0) {
    verify_csrf();
    $name=trim($_POST['name']??''); $email=trim($_POST['email']??''); $password=$_POST['password']??'';
    if ($name && filter_var($email,FILTER_VALIDATE_EMAIL) && strlen($password)>=8) {
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $stmt=$conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,'admin')");
        $stmt->bind_param('sss',$name,$email,$hash); $stmt->execute();
        $message='Administrator created. Delete setup.php now, then log in.';
        $count=1;
    } else $message='Enter a name, valid email and password of at least 8 characters.';
}
$pageTitle='Initial Setup'; require 'includes/header.php';
?>
<div class="form-card narrow"><h1>Initial administrator setup</h1>
<?php if($count>0): ?><div class="alert success">An account already exists or setup is complete. Delete <b>setup.php</b> from your project folder.</div><?php else: ?>
<p>Create the first administrator account.</p><?php if($message): ?><div class="alert"><?=e($message)?></div><?php endif; ?>
<form method="post"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>"><label>Full name</label><input name="name" required><label>Email</label><input type="email" name="email" required><label>Password (minimum 8 characters)</label><input type="password" name="password" minlength="8" required><button class="btn full">Create administrator</button></form>
<?php endif; ?></div><?php require 'includes/footer.php'; ?>
