<?php
$page='search';
require 'db.php';
$student = null;
$searched = false;
$reg = trim($_GET['reg_no'] ?? '');

if ($reg !== '') {
    $searched = true;
    $stmt = $pdo->prepare("SELECT * FROM students WHERE reg_no = :r");
    $stmt->execute([':r' => $reg]);
    $student = $stmt->fetch();
}
include 'header.php';
?>
<h2>Search Student by Registration Number</h2>

<form method="get">
  <label>Enter Registration Number</label>
  <input name="reg_no" placeholder="e.g. S/2026/001" value="<?= htmlspecialchars($reg) ?>" required>
  <button type="submit">Search</button>
</form>

<?php if ($searched): ?>
  <?php if ($student): ?>
    <div class="msg ok">Student found.</div>
    <table>
      <?php
      $labels = [
        'reg_no'=>'Registration Number','full_name'=>'Full Name','gender'=>'Gender',
        'date_of_birth'=>'Date of Birth','level'=>'Level','class_form'=>'Class / Form',
        'school_name'=>'School','region'=>'Region','district'=>'District',
        'parent_name'=>'Parent / Guardian','parent_phone'=>'Parent Phone',
        'created_at'=>'Registered On'
      ];
      foreach ($labels as $k=>$lab): ?>
        <tr><th style="width:35%"><?= $lab ?></th>
            <td><?= htmlspecialchars($student[$k]) ?></td></tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <div class="msg err">No student found with registration number
      "<b><?= htmlspecialchars($reg) ?></b>".</div>
  <?php endif; ?>
<?php endif; ?>

<?php include 'footer.php'; ?>
