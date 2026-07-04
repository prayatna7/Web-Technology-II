<?php
$Err = [];
$name=$rank=$status="";
$success = false;
$ProductErr = [];
$category = $pname = $price = $desc = " ";
$ProductSuccess = false;
if(isset($_POST["submit"]))
{
    if(empty($_POST["name"]))
    {
        $Err['name'] = "Name is required";
    }
    else if(!preg_match("/^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*)*$/", $_POST["name"]))
    {
        $Err['name'] = "Only alphabets are allowed";
    }
    else
    {
        $name = $_POST["name"];
    }
    if(empty($_POST["rank"]))
    {
        $Err['rank'] = "Rank is required";
    }
    else if($_POST["rank"]<1)
    {
        $Err['rank'] = "Rank must start from 1st!";
    }
    else
    {
        $rank = $_POST["rank"];
    }
    if(empty($_POST["Status"]))
    {
        $Err['status'] = "Select Status";
    }
    else
    {
        $status = $_POST["Status"];
    }
    if(empty($Err))
    {
        $success = true;
    }

}

        


    
if(isset($_POST["Psubmit"]))
{
    if(empty($_POST["category"]))
    {
        $ProductErr['category'] = "Select Category";
    }
    else
    {
        $category = $_POST["category"];
    }

    if(empty($_POST["Pname"]))
    {
        $ProductErr['Pname'] = "Product name is required";
    }
    else if(!preg_match("/^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*)*$/", $_POST["Pname"]))
    {
        $ProductErr['Pname'] = "Invalid Product Name";
    }
    else
    {
        $pname = $_POST["Pname"];
    }

    if(empty($_POST["Price"]))
    {
        $ProductErr['Price'] = "Price is required";
    }
    else if($_POST["Price"] <= 0)
    {
        $ProductErr['Price'] = "Price must be greater than 0";
    }
    else
    {
        $price = $_POST["Price"];
    }

    if(empty($_POST["PStatus"]))
    {
        $ProductErr['PStatus'] = "Select Status";
    }
    else
    {
        $PStatus = $_POST["PStatus"];
    }

    if(empty($_POST["Description"]))
    {
        $ProductErr['description'] = "Description is required";
    }
    else
    {
        $desc = trim($_POST["Description"]);
    }

    if(empty($_FILES["image"]["name"]))
    {
        $ProductErr['image'] = "Please upload an image";
    }

    if(empty($ProductErr)){
    $ProductSuccess = true;
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="ecommerceFromPhp.CSS">
</head>

<body>
    <div class="wrapper">
        <aside>
            <h1>Create Category</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <br>
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $name;  ?>"><br>
                <span style="color:red;">
                    <?php echo $Err['name'] ?? ""; ?>
                </span><br>
                <label>Rank:</label>
                <input type="number" name="rank" value="<?php echo $rank;  ?>"><br>
                <span style="color:red;">
                    <?php echo $Err['rank'] ?? ""; ?>
                </span><br>
                <label>Status:</label><br>
                <input type="radio" name="Status" value="Publish">Publish<br><br>
                <input type="radio" name="Status" value="Unpublish">Unpublish<br>
                <span style="color:red;">
                    <?php echo $Err['status'] ?? ""; ?>
                </span><br>
                <div class="button-group">
                    <button name="submit" value="Register">Save</button>
                    <button type="reset">Clear</button>
                </div>
            </form>
            <?php
    if($success)
{
    echo "<h3>Category Details:</h3>";
    echo "Name -> ".$name."<br>";
    if($rank == 1) echo "Rank -> ".$rank."<sup>st</sup><br>";
    else if($rank == 2) echo "Rank -> ".$rank."<sup>nd</sup><br>";
    else if($rank == 3) echo "Rank -> ".$rank."<sup>rd</sup><br>";
    else echo "Rank -> ".$rank."<sup>th</sup><br>";
    }
?>
        </aside>
        <aside>
            <h1>Create Product</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <label>Category:</label>
                <select name="category" value="<?php echo $category??''; ?>">
                    <option value="">Select Category</option>
                    <option value="Tech">Tech</option>
                    <option value="Luxury">Luxury</option>
                    <option value="Affordable">Affordable</option>
                    <option value="Grocery">Grocery</option>
                    <option value="Beverages">Beverages</option>
                    <option value="Toys">Toys</option>
                </select><span style="color:red;">
                    <?php echo $ProductErr['category'] ?? ""; ?>
                </span><br>
                <br><label>Name:</label>
                <input type="text" name="Pname" value="<?php echo $pname??''; ?>">
                <span style="color:red;">
                    <?php echo $ProductErr['Pname'] ?? ""; ?>
                </span><br>
                <br><label>Price:</label>
                <input type="number" name="Price" value="<?php echo $price??''; ?>">
                <span style="color:red;">
                    <?php echo $ProductErr['Price'] ?? ""; ?>
                </span><br>
                <br><label>Status:</label><br>
                <input type="radio" name="PStatus" value="Publish">Publish<br><br>
                <input type="radio" name="PStatus" value="Unpublish">Unpublish
                <span style="color:red;">
                    <?php echo $ProductErr['PStatus'] ?? ""; ?>
                </span><br>
                <label>Description:</label>
                <textarea name="Description"><?php echo $desc??''; ?></textarea>
                <span style="color:red;">
                    <?php echo $ProductErr['description'] ?? ""; ?>
                </span><br>
                <br><label>Image:</label>
                <input type="file" name="image"><span style="color:red;">
                    <?php echo $ProductErr['image'] ?? ""; ?>
                </span><br>
                <br>
                <div class="button-group">
                    <button name="Psubmit" value="Register">Save</button>
                    <button type="reset">Clear</button>
                </div>
            </form>
            <?php
if($ProductSuccess)
{
    echo "<h3>Product Details:</h3>";
    echo "Category -> ".$category."<br>";
    echo "Name -> ".$pname."<br>";
    echo "Price -> Rs. ".$price."<br>";
    echo "Status -> ".$PStatus."<br>";
    echo "Description -> ".$desc."<br>";
    echo "Image -> ".$_FILES["image"]["name"]."<br>";
}
?>
        </aside>
    </div>
</body>

</html>