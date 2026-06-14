<?php
$page = $page ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Information Management System - Tanzania</title>
<style>
  * { box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; }
  body { margin:0; background:#f4f6f9; color:#222; }
  header { background:#0a6e3a; color:#fff; padding:18px 30px; }
  header h1 { margin:0; font-size:20px; }
  header p { margin:4px 0 0; font-size:13px; opacity:.85; }
  nav { background:#084d29; padding:10px 30px; }
  nav a { color:#fff; text-decoration:none; margin-right:20px; font-weight:bold; font-size:14px; }
  nav a.active, nav a:hover { color:#ffd84d; }
  main { max-width:960px; margin:25px auto; background:#fff; padding:25px 30px;
         border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,.08); }
  h2 { color:#0a6e3a; margin-top:0; }
  label { display:block; margin-top:12px; font-weight:bold; font-size:14px; }
  input, select { width:100%; padding:9px; border:1px solid #ccc; border-radius:4px;
                  margin-top:4px; font-size:14px; }
  button, .btn { background:#0a6e3a; color:#fff; border:0; padding:10px 18px;
                 border-radius:4px; cursor:pointer; font-size:14px; margin-top:18px;
                 text-decoration:none; display:inline-block; }
  button:hover, .btn:hover { background:#0d8a48; }
  table { width:100%; border-collapse:collapse; margin-top:15px; font-size:14px; }
  th, td { border:1px solid #ddd; padding:8px 10px; text-align:left; }
  th { background:#0a6e3a; color:#fff; }
  tr:nth-child(even) { background:#f9f9f9; }
  .msg { padding:10px 14px; border-radius:4px; margin-bottom:15px; font-size:14px; }
  .ok  { background:#e3f7e7; color:#0a6e3a; border:1px solid #b9e8c4; }
  .err { background:#fdecec; color:#a33; border:1px solid #f5c2c2; }
  .row { display:flex; gap:15px; }
  .row > div { flex:1; }
  footer { text-align:center; padding:18px; color:#666; font-size:12px; }
</style>
</head>
<body>
<header>
  <h1>Student Information Management System</h1>
  <p>Primary &amp; Secondary Schools — United Republic of Tanzania</p>
</header>
<nav>
  <a href="index.php"    class="<?= $page==='home'?'active':'' ?>">Home</a>
  <a href="register.php" class="<?= $page==='register'?'active':'' ?>">Register Student</a>
  <a href="display.php"  class="<?= $page==='display'?'active':'' ?>">Display Records</a>
  <a href="search.php"   class="<?= $page==='search'?'active':'' ?>">Search by Reg. No.</a>
</nav>
<main>
