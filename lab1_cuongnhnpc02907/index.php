<?php
echo "PC02907 - Lab 1.1 <br><br><hr>";

// $array = [
//     "PHP2",
//     "Javascript nâng cao",
//     "PHP cơ bản",
//   ];
// echo $array[0] ."<br>";

$course = [
    'block 1' => 'PHP2',
    'block 2' => 'Javascript nâng cao',
    'block 3' => 'PHP cơ bản'
  ];
  // echo $course['s1'] ."<br>"; 

/**
 * hàm này dùng để lấy ra mảng tuần tự của khóa học
 * @return array
 */

  //   model
  // Định nghĩa hàm get_courses
  function get_courses() {
    // global lấy biến ở bên ngoài vào trong
    global $course;

    return array_values($course);
  }

  get_courses();
  
  // Định nghĩa hàm find_by_semester
  function find_by_semester($semester) {
    global $course;
    return (array_key_exists($semester, $course) ? $course[$semester] : 'Invalid course');
  }
  // echo find_by_semester("s2") ."<Br>";

  // Lấy danh sách các khóa học
  //   controller
  $list_of_courses = get_courses();
  
  // Lấy mã học kỳ từ URL
  $semester = (!empty($_GET['semester']) ? $_GET['semester'] : '');
  // Tìm kiếm khóa học theo mã học kỳ
  $course_name = find_by_semester($semester);
  
  ?>
  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>lab 1.1</title>
</head>
<body>
    <!-- view -->
    <h2>Khóa học <?=$course_name?></h2>
    <h3><?=$semester?></h3>
  
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