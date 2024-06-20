<?php
@include 'koneksi.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'Please fill out all fields!';    
   }else{

      $update_data = "UPDATE products SET name='$product_name', price='$product_price', image='$product_image' WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:index.php'); // Redirect to index.php after update
         exit(); // Make sure no further output is sent
      }else{
         $message[] = 'Failed to update product!'; 
      }

   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $msg){
         echo '<span class="message">'.$msg.'</span>';
      }
   }
?>

<div class="container">

   <div class="admin-product-form-container centered">

      <?php
         $select = mysqli_query($koneksi, "SELECT * FROM products WHERE id = '$id'");
         while($row = mysqli_fetch_assoc($select)){
      ?>

      <form action="" method="post" enctype="multipart/form-data">
         <h3 class="title">Update the product</h3>
         <input type="text" class="box" name="product_name" value="<?php echo $row['name']; ?>" placeholder="Enter the product name">
         <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="Enter the product price">
         <input type="file" class="box" name="product_image"  accept="image/png, image/jpeg, image/jpg">
         <input type="submit" value="update product" name="index.php" class="btn">
         <a href="index.php" class="btn">Go back!</a>
      </form>

      <?php }; ?>

   </div>

</div>

</body>
</html>
