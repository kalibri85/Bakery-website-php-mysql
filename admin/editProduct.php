<?php
 /**
 *
 * @author Lana (Svetlana Muraveckaja-Odincova)
 */
session_start();
if (!isset($_SESSION['admin'])) header("Location: login.php");
include('../includes/connection.php');
include('./includes/header.php');

$product = [];
//Get id from the link if it is exist
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get product information from database
function getProduct($conn, $id){
        $id = intval($id);
        $sql = $conn->prepare("SELECT * FROM `products` WHERE `productID` = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();

        return $result->fetch_assoc();
}
// Update product information
function setProduct($conn, $id) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $desc = htmlspecialchars($_POST['description']);
    $sugar = (isset($_POST['sugar'])) ? 1 : 0;
    $gluten = (isset($_POST['gluten'])) ? 1 : 0;
    $lacto = (isset($_POST['lacto'])) ? 1 : 0;
    $price = floatval($_POST['price']);
    $show = date('Y-m-d', strtotime($_POST['showDate']));
    $set = "`productTypeID` = '$category' , `productName` = '$title', `productDescription` = '$desc', 
            `sugar` = '$sugar', `gluten` = '$gluten', `lactose` = '$lacto', 
            `price` = '$price', `date` = '$show'";
    // Image uploading        
    if(isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
        $photoProd = htmlspecialchars( basename( $_FILES["img"]["name"]));
        if(!empty($photoProd)){
            //Allowed file types
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            // Get the type of uploaded file and convert it to lower case
            $fileType = strtolower(pathinfo($photoProd, PATHINFO_EXTENSION));
            // Check if file type exists into array
            if(in_array($fileType, $allowedTypes)){
                move_uploaded_file($_FILES['img']['tmp_name'], "../img/products/" . $photoProd);
                $set .= ", `image` = '$photoProd'";
            }else{
                $message = "Invalid file format. Only JPG, JPEG, PNG, WEBP or GIF files are allowed.";
            }
        }
    }
    // Update product information in database
    $sql = $conn->prepare("UPDATE `products` SET $set WHERE `productID` = ?");
    $sql->bind_param("i", $id);
    if($sql->execute()) {
        $message .= "Product updated successfully";
    } else{
        $message .= "Something went wrong. Please try again.";
    }
    return $message;
}
// Call the setProduct function if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = setProduct($conn, $id);
}
$product = getProduct($conn, $id);
//Values for the form retrieved from the database
$productName = $product['productName'] ?? '';
$type = $product['productTypeID'] ?? '';
$desc = $product['productDescription'] ?? '';
$sugarChecked = ($product['sugar'] ?? 0) == 1 ? "checked" : "";
$glutenChecked = ($product['gluten'] ?? 0) == 1 ? "checked" : "";
$lactoChecked = ($product['lactose'] ?? 0) == 1 ? "checked" : "";
$price = $product['price'] ?? '';
$photo = $product['image'] ?? '';
$showDate = $product['date'] ?? '';
    
 ?>
 <section id="addProductForm">
    <div class="container text-center">
        <?php 
            if(!empty($message)){
                echo "<div class='alert alert-info' role='alert'>".$message."</div>";
            }
        ?>
        <form method="post" enctype="multipart/form-data">
            <div class="row"> 
                <div class="col-mb-12 text-start">
                    <label for="title" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $productName; ?>" aria-describedby="Product name">
                </div>
            </div> 
            <div class="row">   
                <div class="col-mb-3 text-start">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" class="form-select">
                         <!-- Get categories-->
                        <?php
                        $sql = "SELECT * FROM `productTypes`";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $isCategory = $row['typeID'] == $type ? "selected" : "";
                            echo "<option value=".$row['typeID']." ".$isCategory.">".$row['typeName']."</option>";
                        }
                        ?>  
                    </select>
                </div>
            </div> 
            <div class="row"> 
                <div class="mb-3 text-start">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"><?php echo $desc;?></textarea>
                </div>
            </div>
            <div class="row">  
                <div class="col-mb-10 text-start">
                    <div class="form-check">
                        <input class="form-check-input" name="sugar" type="checkbox" value="1" id="sugar" <?php echo $sugarChecked;?>>
                        <label class="form-check-label" for="sugar">
                            Sugar Free
                        </label>
                    </div> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="gluten" value="1" id="gluten" <?php echo $glutenChecked;?>>
                        <label class="form-check-label" for="gluten">
                            Gluten Free
                        </label>
                    </div>   
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="lacto" value="1" id="lacto" <?php echo $lactoChecked;?>>
                        <label class="form-check-label" for="lacto">
                            Lactose Free
                        </label>
                    </div>   
                </div>
            </div>
            <div class="row">  
                <div class="col-md-2">
                    <img src='../img/products/<?php echo $photo;?>' alt='item' class="product-img">    
                </div>    
                <div class="input-group mb-10">
                    <input type="file" class="form-control" name="img" id="productImg">
                    <label class="input-group-text" for="productImg">Upload</label>
                </div>
            </div>
            <div class="row">  
                <div class="col-md-5 text-start">
                    <label class="form-label" for="price">
                        Price
                    </label>
                </div>
                <div class="input-group col-md-5 text-end">    
                    <div class="input-group-append">
                        <span class="input-group-text">£</span>
                    </div>
                    <input type="text" class="form-control" name="price" id="price" value="<?php echo $price;?>">
                    <div class="input-group-append">
                        <span class="input-group-text">0.00</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-mb-5 d-inline-block text-start">
                    <label class="form-label" for="datepicker">
                        Pick a day to show this product in the daily menu
                    </label>
                </div>
                <div class="col-mb-5 d-inline-block text-end"> 
                    <!-- Add calendar-->   
                    <input id="datepicker" name="showDate"  value="<?php echo $showDate;?>" width="276" />
                    <script>
                    $('#datepicker').datepicker({ 
                        uiLibrary: 'bootstrap5',
                        format: "yyyy-mm-dd"
                     });
                    </script>
                </div>
            </div>
        <button type="submit" class="btn btn-primary pb-3">Submit</button>
        </form>
    </div>
</section>
