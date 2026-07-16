<?php
error_reporting(E_ERROR);
try {
    $connection = new mysqli('localhost','root','','college');
    if ($connection->connect_errno != 0) {
        throw new Exception('Database connection error');
    }
    $sql = "select * from students order by id";
    //execute sql and get result object
    $result = $connection->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           array_push($data,$row);
        } 
    }
} catch (Exception $ex) {
    die($ex->getMessage()); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Table</title>

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial, sans-serif;
}

body{
background:#f4f4f4;
padding:40px;
}

h2{
text-align:center;
margin-bottom:20px;
}

table{
width:70%;
margin:auto;
border-collapse:collapse;
background:white;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

th, td{
border:1px solid #ccc;
padding:12px;
text-align:center;
}

th{
background:#007BFF;
color:white;
}

tr:nth-child(even){
background:#f2f2f2;
}

tr:hover{
background:#ddd;
}
</style>
</head>
<body>

<h2>Product Information</h2>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Course</th>
<th>Semester</th>
<th>Date Of Birth</th>
<th>Username</th>
<th>Password</th>
</tr>
<?php foreach($data as $product){ ?>
<tr>
<td><?php echo $product['id'] ?></td>
<td><?php echo $product['name'] ?></td>
<td><?php echo $product['price'] ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>