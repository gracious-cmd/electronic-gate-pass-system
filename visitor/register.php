<?php
require_once __DIR__.'/../config/database.php'; require_once __DIR__.'/../includes/functions.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    verify_csrf();
    $name=trim($_POST['name']??''); $phone=trim($_POST['phone']??''); $email=trim($_POST['email']??'');
    $host=trim($_POST['host_name']??''); $purpose=trim($_POST['purpose']??'');
    $visit_date=$_POST['visit_date']??''; $visit_time=$_POST['visit_time']??'';
    if(!$name||!$phone||!$host||!$purpose||!$visit_date||!$visit_time) $error='Please complete all required fields.';
    elseif($visit_date<date('Y-m-d')) $error='Visit date cannot be in the past.';
    else {
        $pass=make_pass_no();
        $stmt=$conn->prepare("INSERT INTO visitors(pass_no,name,phone,email,host_name,purpose,visit_date,visit_time,status) VALUES(?,?,?,?,?,?,?,?, 'pending')");
        $stmt->bind_param('ssssssss',$pass,$name,$phone,$email,$host,$purpose,$visit_date,$visit_time); $stmt->execute();
        $_SESSION['new_pass']=$pass; redirect('pass.php');
    }
}
$pageTitle='Visitor Pass Request'; require '../includes/header.php';
?>
<div class="form-card"><h1>Visitor Gate Pass Request</h1><p>Submit your details. Your pass will be available after approval.</p><?php if($error): ?><div class="alert danger"><?=e($error)?></div><?php endif; ?>
<form method="post" class="form-grid"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>">
<div><label>Visitor full name *</label><input name="name" required></div><div><label>Phone number *</label><input name="phone" required></div><div><label>Email (optional)</label><input type="email" name="email"></div><div><label>Person to visit / Host *</label><input name="host_name" required></div><div class="span2"><label>Purpose of visit *</label><textarea name="purpose" required></textarea></div><div><label>Visit date *</label><input type="date" name="visit_date" min="<?=date('Y-m-d')?>" required></div><div><label>Expected time *</label><input type="time" name="visit_time" required></div><div class="span2"><button class="btn">Submit request</button></div></form></div>
<?php require '../includes/footer.php'; ?>
