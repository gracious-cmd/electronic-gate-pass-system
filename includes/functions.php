<?php
require_once __DIR__ . '/csrf.php';
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function redirect(string $path): never { header("Location: $path"); exit; }
function flash(string $message, string $type='success'): void { $_SESSION['flash']=['message'=>$message,'type'=>$type]; }
function show_flash(): void {
    if (!empty($_SESSION['flash'])) {
        $f=$_SESSION['flash']; unset($_SESSION['flash']);
        echo '<div class="alert '.e($f['type']).'">'.e($f['message']).'</div>';
    }
}
function require_role(array $roles): void {
    if (empty($_SESSION['user'])) redirect('/electronic-gate-pass/login.php');
    if (!in_array($_SESSION['user']['role'], $roles, true)) { http_response_code(403); exit('Access denied.'); }
}
function current_user(): array { return $_SESSION['user'] ?? []; }
function make_pass_no(): string { return 'GP-'.date('Ymd').'-'.strtoupper(bin2hex(random_bytes(3))); }
