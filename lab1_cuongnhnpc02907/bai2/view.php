<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>lab 1.2</title>
</head>
<body>
<?php
include 'data.php';
?>
    <!-- view -->
  <form action="">
  <select name="semester">
    <?php foreach($course as $key => $value): ?>
      <option value="<?= $key ?>"><?=$value?></option>
    <?php endforeach; ?>

  </select>
  <button type="submit">tìm khóa học</button>
  </form>

</body>
</html>