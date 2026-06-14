<?php $page='home'; include 'header.php'; require 'db.php';
$count = $pdo->query("SELECT COUNT(*) AS c FROM students")->fetch()['c'];
?>
<h2>Welcome</h2>
<p>This system manages student information for primary and secondary schools in Tanzania.
It allows authorised users to <b>register new students</b>, <b>display all student records</b>,
and <b>search for a specific student by registration number</b>.</p>

<p><b>Total students currently registered:</b> <?= (int)$count ?></p>

<h3>Main Features</h3>
<ul>
  <li>Register a new student with full bio-data and school details.</li>
  <li>View a complete list of all registered students.</li>
  <li>Quickly look up any student using their unique registration number (e.g. <i>S/2026/001</i>).</li>
</ul>

<a href="register.php" class="btn">Register a Student</a>
<a href="display.php"  class="btn" style="background:#1565c0;">View All Records</a>
<a href="search.php"   class="btn" style="background:#c98300;">Search Student</a>

<?php include 'footer.php'; ?>