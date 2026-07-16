<?php
//database creation
error_reporting(E_ERROR);
// try {
//     $connection = new mysqli('localhost','root','');
//     if ($connection->connect_errno != 0) {
//         throw new Exception('Database connection error');
//     }
//     $sql = "create database College";
//     if ($connection->query($sql)) {
//         echo 'Database created successfully';
//     } else { 
//         throw new Exception('Database connection error');
//     }
// } catch (Exception $ex) {
//     die($ex->getMessage()); 
// }
try {
    $connection = new mysqli('localhost','root','');
    if ($connection->connect_errno != 0) {
        throw new Exception('Database connection error');
    }
    // echo "Connection success";
} catch (Exception $ex) {
    die($ex->getMessage()); 
}
try {
    $connection = new mysqli('localhost','root','','College');
    if ($connection->connect_errno != 0) {
        throw new Exception('Database connection error');
    }
    $sql = "create table if not exists students(
        ID int primary key,
        Name varchar(50) not null,
        Email varchar(50) not null,
        Phone varchar(10) not null,
        Course varchar(50) not null,
        Semester int not null,
        DOB varchar(12) not null,
        Username varchar(20) not null,
        Password varchar(16) not null
    )";
    if ($connection->query($sql)) {
        echo "";
        // echo 'Table created successfully';
    } else { 
        throw new Exception('Table connection error');
    }
} catch (Exception $ex) {
    die($ex->getMessage()); 
}

$Err = [];
$id = $name = $email = $phone = $course = $semester = $dob = $username = $password = "";
$success = false;

if (isset($_POST["submit"])) {

    // Student ID
    if (empty($_POST["id"])) {
        $Err['id'] = "Student ID is required";
    } elseif (!preg_match("/^[0-9]+$/", $_POST["id"])) {
        $Err['id'] = "Contain only numbers";
    } else {
        $id = trim($_POST["id"]);
    }

    // Student Name
    if (empty($_POST["name"])) {
        $Err['name'] = "Student Name is required";
    } elseif (!preg_match("/^[A-Za-z ]{2,}$/", $_POST["name"])) {
        $Err['name'] = "Only alphabets and spaces are allowed";
    } else {
        $name = trim($_POST["name"]);
    }

    // Email
    if (empty($_POST["email"])) {
        $Err['email'] = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $Err['email'] = "Invalid Email Address";
    } else {
        $email = trim($_POST["email"]);
    }

    // Phone Number
    if (empty($_POST["phone"])) {
        $Err['phone'] = "Phone Number is required";
    } elseif (!preg_match("/^[0-9]{10}$/", $_POST["phone"])) {
        $Err['phone'] = "Phone Number must contain exactly 10 digits";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Course
    if (empty($_POST["course"])) {
        $Err['course'] = "Course is required";
    } elseif (!preg_match("/^[A-Za-z ]{2,}$/", $_POST["course"])) {
        $Err['course'] = "Only alphabets and spaces are allowed";
    } else {
        $course = trim($_POST["course"]);
    }

    // Semester
    if (empty($_POST["semester"])) {
        $Err['semester'] = "Semester is required";
    } elseif (!preg_match("/^[1-8]$/", $_POST["semester"])) {
        $Err['semester'] = "Semester must be between 1 and 8";
    } else {
        $semester = trim($_POST["semester"]);
    }

    // Date of Birth
    if (empty($_POST["dob"])) {
        $Err['dob'] = "Date of Birth is required";
    } else {
        $dob = $_POST["dob"];
    }

    // Username
    if (empty($_POST["username"])) {
        $Err['username'] = "Username is required";
    } elseif (!preg_match("/^[A-Za-z0-9_]{5,20}$/", $_POST["username"])) {
        $Err['username'] = "Invalid Username";
    } else {
        $username = trim($_POST["username"]);
    }

    // Password
    if (empty($_POST["password"])) {
        $Err['password'] = "Password is required";
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*[0-9]).{8,16}$/", $_POST["password"])) {
        $Err['password'] = "Invalid Password Format";
    } else {
        $password = $_POST["password"];
    }

    // Success
    if (empty($Err)) {
        $success = true;
        try {
            $connection = new mysqli('localhost','root','','College');
            if ($connection->connect_errno != 0) {
                throw new Exception('Database connection error');
            }
            $sql = "insert into students values ($id,'$name','$email','$phone','$course',$semester,'$dob','$username','$password')";
            //query to insert data
            $connection->query($sql);
            //insert confirmation
            if ($connection->affected_rows == 1) {
                $success =  'Record created successfully';
            } else { 
                throw new Exception('Record Creation Error');
            }
        } catch (Exception $ex) {
            die($ex->getMessage()); 
        }
    }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Form</title>
<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial, sans-serif;
}

body{
background:#f2f2f2;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.container{
width:350px;
background:#fff;
padding:25px;
border-radius:8px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

h2{
text-align:center;
margin-bottom:20px;
}

label{
display:block;
margin-top:12px;
margin-bottom:5px;
font-weight:bold;
}

input{
width:100%;
padding:10px;
border:1px solid #ccc;
border-radius:5px;
}

span{
    color: red;
}

input[type="submit"]{
background:#007BFF;
color:white;
border:none;
margin-top:20px;
cursor:pointer;
font-size:16px;
}

input[type="submit"]:hover{
background:#0056b3;
}
</style>
</head>
<body>

<div class="container">
<h2>Product Form</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<label for="id">Student ID</label>
<input type="text" id="id" name="id" placeholder="Enter Student ID" value="<?php echo $id??'' ?>">
<span><?php echo $Err['id']?? "" ?></span>

<label for="name">Student Name</label>
<input type="text" id="name" name="name" placeholder="Enter Student Name" value="<?php echo $name??'' ?>">
<span><?php echo $Err['name']?? "" ?></span>

<label for="email">Email</label>
<input type="email" id="email" name="email" placeholder="Enter Student Email" value="<?php echo $email??'' ?>">
<span><?php echo $Err['email']?? "" ?></span>

<label for="phone">Phone Number</label>
<input type="text" id="phone" name="phone" placeholder="Enter Phone" value="<?php echo $phone??'' ?>">
<span><?php echo $Err['phone']?? "" ?></span>

<label for="course">Course</label>
<input type="text" id="course" name="course" placeholder="Enter Course" value="<?php echo $course??'' ?>">
<span><?php echo $Err['course']?? "" ?></span>

<label for="sem">Semester</label>
<input type="text" id="sem" name="semester" placeholder="Enter Semester" value="<?php echo $semester??'' ?>">
<span><?php echo $Err['semester']?? "" ?></span>

<label for="dob">Date Of Birth</label>
<input type="date" id="dob" name="dob" placeholder="Enter Date of Birth" value="<?php echo $dob??'' ?>">
<span><?php echo $Err['dob']?? "" ?></span>

<label for="usn">Username</label>
<input type="text" id="usn" name="username" placeholder="Enter Username" value="<?php echo $username??'' ?>">
<span><?php echo $Err['username']?? "" ?></span>

<label for="psdw">Password</label>
<input type="password" id="psdw" name="password" placeholder="Enter Password" value="<?php echo $password??'' ?>">
<span><?php echo $Err['password']?? "" ?></span>

<input type="submit" value="Save" name="submit">
</form>
</div>

</body>
</html>