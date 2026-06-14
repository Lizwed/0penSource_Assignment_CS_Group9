<?php
$page='register';
require 'db.php';
$msg = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['reg_no','full_name','gender','date_of_birth','level','class_form',
               'school_name','region','district','parent_name','parent_phone'];
    $data = [];
    foreach ($fields as $f) $data[$f] = trim($_POST[$f] ?? '');

    // Simple validation
    foreach ($data as $k => $v) {
        if ($v === '') { $err = "Please fill in all fields (missing: $k)."; break; }
    }
    if (!$err && !preg_match('/^[0-9+\s\-]{7,15}$/', $data['parent_phone'])) {
        $err = "Invalid parent phone number.";
    }

    if (!$err) {
        try {
            $sql = "INSERT INTO students
                    (reg_no, full_name, gender, date_of_birth, level, class_form,
                     school_name, region, district, parent_name, parent_phone)
                    VALUES (:reg_no,:full_name,:gender,:date_of_birth,:level,:class_form,
                            :school_name,:region,:district,:parent_name,:parent_phone)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
            $msg = "Student <b>" . htmlspecialchars($data['full_name']) .
                   "</b> registered successfully with Reg. No. <b>" .
                   htmlspecialchars($data['reg_no']) . "</b>.";
            $_POST = []; // clear form
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'UNIQUE')) {
                $err = "Registration number already exists. Please use a unique one.";
            } else {
                $err = "Database error: " . htmlspecialchars($e->getMessage());
            }
        }
    }
}

include 'header.php';
?>
<h2>Register New Student</h2>

<?php if ($msg): ?><div class="msg ok"><?= $msg ?></div><?php endif; ?>
<?php if ($err): ?><div class="msg err"><?= $err ?></div><?php endif; ?>

<form method="post" autocomplete="off">
  <div class="row">
    <div>
      <label>Registration Number *</label>
      <input name="reg_no" placeholder="e.g. S/2026/001" value="<?= htmlspecialchars($_POST['reg_no'] ?? '') ?>" required>
    </div>
    <div>
      <label>Full Name *</label>
      <input name="full_name" placeholder="e.g. Asha John Mwakyusa" value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>" required>
    </div>
  </div>

  <div class="row">
    <div>
      <label>Gender *</label>
      <select name="gender" required>
        <option value="">-- Select --</option>
        <?php foreach (['Male','Female'] as $g): ?>
          <option <?= (($_POST['gender']??'')===$g)?'selected':'' ?>><?= $g ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Date of Birth *</label>
      <input type="date" name="date_of_birth" value="<?= htmlspecialchars($_POST['date_of_birth'] ?? '') ?>" required>
    </div>
  </div>

  <div class="row">
    <div>
      <label>Level *</label>
      <select name="level" required>
        <option value="">-- Select --</option>
        <?php foreach (['Primary','Secondary'] as $l): ?>
          <option <?= (($_POST['level']??'')===$l)?'selected':'' ?>><?= $l ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Class / Form *</label>
      <input name="class_form" placeholder="e.g. Std V or Form 2" value="<?= htmlspecialchars($_POST['class_form'] ?? '') ?>" required>
    </div>
  </div>

  <label>School Name *</label>
  <input name="school_name" placeholder="e.g. Azania Secondary School" value="<?= htmlspecialchars($_POST['school_name'] ?? '') ?>" required>

  <div class="row">
    <div>
      <label>Region *</label>
      <select name="region" required>
        <option value="">-- Select Tanzanian Region --</option>
        <?php
        $regions = ['Arusha','Dar es Salaam','Dodoma','Geita','Iringa','Kagera','Katavi',
                    'Kigoma','Kilimanjaro','Lindi','Manyara','Mara','Mbeya','Morogoro',
                    'Mtwara','Mwanza','Njombe','Pwani','Rukwa','Ruvuma','Shinyanga',
                    'Simiyu','Singida','Songwe','Tabora','Tanga','Kaskazini Pemba',
                    'Kaskazini Unguja','Kusini Pemba','Kusini Unguja','Mjini Magharibi'];
        foreach ($regions as $r):
          $sel = (($_POST['region']??'')===$r)?'selected':''; ?>
          <option <?= $sel ?>><?= $r ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>District *</label>
      <input name="district" placeholder="e.g. Kinondoni" value="<?= htmlspecialchars($_POST['district'] ?? '') ?>" required>
    </div>
  </div>

  <div class="row">
    <div>
      <label>Parent / Guardian Name *</label>
      <input name="parent_name" value="<?= htmlspecialchars($_POST['parent_name'] ?? '') ?>" required>
    </div>
    <div>
      <label>Parent Phone *</label>
      <input name="parent_phone" placeholder="e.g. +255 712 345 678" value="<?= htmlspecialchars($_POST['parent_phone'] ?? '') ?>" required>
    </div>
  </div>

  <button type="submit">Register Student</button>
</form>

<?php include 'footer.php'; ?>
