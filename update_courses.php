<?php
    require_once('classes/database.php');
    $con = new database();
    $sweetAlertConfig = "";


   if(!isset($_POST['course_id']) || empty($_POST['course_id'])){
    header("Location: index.php");
    exit();
   }

   $course_id = $_POST['course_id'];
   $course_data = $con->getCourseByID($course_id);

   if(isset($_POST['save'])){
    $course_id = $_POST['course_id'];
    $course_name= $_POST['course_name'];
    

    $UpCourse = $con->updateCourses($course_id, $course_name);
    
    if ($UpCourse) {
        $sweetAlertConfig = "
        <script>
        Swal.fire({
          icon: 'success',
          title: 'Added a Student',
          text: 'You have successfully added a Student.',
          confirmButtonText: 'OK'
        }).then(() => {
          window.location.href = 'index.php';
        });
        </script>
        ";
      } else {
        $sweetAlertConfig = "
         <script>
        Swal.fire({
          icon: 'error',
          title: 'CHECK MO CODE MO',
          text: 'An error occurred during registration. Please try again.',
          confirmButtonText: 'OK'
        });
        </script>"
       
        ;
      }

   }



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="./package/dist/sweetalert2.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="mb-4 text-center">Edit User</h2>
 
    <form method="POST" action="" class="bg-white p-4 rounded shadow-sm">

    <div class="mb-3">
        <label for="course_id" class="form-label">Course ID</label>
        <input type="text" name="c_id" id="course_id" value="<?php echo $course_data['course_id']?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="course_name" class="form-label">Course Name</label>
        <input type="text" name="course_name" id="course_name" value="<?php echo $course_data['course_name']?>" class="form-control" placeholder="Enter your new first name" required>
      </div>
      
      <input type="hidden" name="course_id" value = "<?php echo $course_data['course_id']?>">
      
      <button type="submit" name="save" class="btn btn-primary w-100">Save</button>
 
  <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
  <script src="./package/dist/sweetalert2.js"></script>
  <?php echo $sweetAlertConfig; ?>
 
    </form>
  </div>
 
 
</body>
</html>