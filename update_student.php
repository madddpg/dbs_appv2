<?php
    require_once('classes/database.php');
    $con = new database();
    $sweetAlertConfig = "";


   if(!isset($_POST['students_id']) || empty($_POST['students_id'])){
    header("Location: index.php");
    exit();
   }

   $students_id = $_POST['students_id'];

   $student_data = $con->getStudentByID($students_id);

   if(isset($_POST['save'])){
    $id = $_POST['students_id'];
    $fn = $_POST['first_name'];
    $ln = $_POST['last_name'];
    $email= $_POST['email'];

    $Upstudent = $con->updateStudents($id, $fn, $ln, $email);
    
    if ($Upstudent) {
        $sweetAlertConfig = "
        <script>
        Swal.fire({
          icon: 'success',
          title: 'Update Successful',
          text: 'You have successfully updated a Student.',
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
          title: 'Registration Failed',
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
        <label for="students_id" class="form-label">Student ID</label>
        <input type="text" name="students_id" id="students_id" value="<?php echo $student_data['student_id']?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $student_data['student_FN']?>" class="form-control" placeholder="Enter your new first name" required>
      </div>
      <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $student_data['student_LN']?>" class="form-control" placeholder="Enter your new last name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $student_data['student_email']?>" class="form-control" placeholder="Enter your new email" required>
      </div>
      <input type="hidden" name="students_id" value = "<?php echo $student_data['student_id']?>">
      
      <button type="submit" name="save" class="btn btn-primary w-100">Save</button>
 
  <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
  <script src="./package/dist/sweetalert2.js"></script>
  <?php echo $sweetAlertConfig; ?>
 
    </form>
  </div>
 
 
</body>
</html>