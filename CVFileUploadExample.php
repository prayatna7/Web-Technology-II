<?php
$error = "";

if(isset($_POST["submit"]))
{
    if($_FILES["profile"]["error"] == 0)
    {
        if($_FILES["profile"]["size"] < 500000)
        {
            $types = ["application/pdf","application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document"];

            if(in_array($_FILES["profile"]["type"], $types))
            {
                $file = time()."_".$_FILES["profile"]["name"];

                if(move_uploaded_file($_FILES["profile"]["tmp_name"], "uploads/".$file))
                {
                    $error = "CV uploaded successfully.";
                }
                else
                {
                    $error = "File upload failed.";
                }
            }
            else
            {
                $error = "Only PDF, DOC and DOCX files are allowed.";
            }
        }
        else
        {
            $error = "File size must be less than 500 KB.";
        }
    }
    else
    {
        $error = "Please choose a CV file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CV Upload Form</title>
</head>
<body>

<h2>CV Upload Form</h2>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="profile">
    <br><br>
    <button type="submit" name="submit">Upload</button>
</form>

<div><?php echo $error; ?></div>

</body>
</html>
