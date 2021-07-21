<?php
    require('../functions.php');


    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["create"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
 
    // Check file size
    if ($_FILES["image"]["size"] > 250000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }

    if (isset ($_POST['create'])) {
        $image = $_FILES['image']['name'];
        $productname = $_POST['productname'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $queryCreate = "INSERT INTO products VALUES (null, '$image','$productname', '$size', '$price', '$description')";
        $sqlCreate = mysqli_query($db, $queryCreate);

        echo '<script>alert("Successfully created!")</script>';
        echo '<script>window.location.href = "/final/admin/products.php"</script>';
    }else{
        echo '<script>window.location.href = "/final/admin/products.php"</script>';
    }

?>