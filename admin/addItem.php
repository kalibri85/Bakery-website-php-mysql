 <?php
 /**
 *
 * @author Lana (Svetlana Muraveckaja-Odincova)
 */
session_start();
if (!isset($_SESSION['admin'])) header("Location: login.php");
include('./includes/header.php');
include('../includes/connection.php');
// Save new product information to database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $desc = htmlspecialchars($_POST['description']);
    $sugar = (isset($_POST['sugar'])) ? 1 : 0;
    $gluten = (isset($_POST['gluten'])) ? 1 : 0;
    $lacto = (isset($_POST['lacto'])) ? 1 : 0;
    $price = floatval($_POST['price']);
    $show = date('Y-m-d', strtotime($_POST['showDate']));
    $photo = '';
    $message = '';
      // Image uploading   
    if(isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
        // Get the file name with a path. Converts the string to HTML entities
        $tempPhoto = htmlspecialchars( basename( $_FILES["img"]["name"]));
        if(!empty($tempPhoto)){
            //Allowed file types
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            //Get the type of uploaded file and convert it to lower case
            $fileType = strtolower(pathinfo($tempPhoto, PATHINFO_EXTENSION));
            // Check if file type exists into array
            if(in_array($fileType, $allowedTypes)){
                move_uploaded_file($_FILES['img']['tmp_name'], "../img/products/" . $tempPhoto);
                $photo = $tempPhoto;
            }else{
                $message = "Invalid file format. Only JPG, JPEG, PNG, WEBP or GIF files are allowed.";
            }
        }
    }
    // Save product into database
    $sql = $conn->prepare("INSERT INTO `products` (`productTypeID` , `productName`, `productDescription`, `sugar`, `gluten`, `lactose`, `image`, `price`, `date`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("issiiisds",
                     $category,
                     $title,
                     $desc,
                     $sugar,
                     $gluten,
                     $lacto,
                     $photo,
                     $price,
                     $show
                    );
    if($sql->execute()) {
        $message .= "Product saved successfully";
    } else{
        $message .= "Something went wrong. Please try again.";
    }
}
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
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="Product name">
                </div>
            </div> 
            <div class="row">   
                <div class="col-mb-3 text-start">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" class="form-select">
                        <?php
                            $sql = "SELECT * FROM `productTypes`";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value=".$row['typeID'].">".$row['typeName']."</option>";
                            }
                        ?>  
                    </select>
                </div>
            </div> 
            <div class="row"> 
                <div class="mb-3 text-start">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
            </div>
            <div class="row">  
                <div class="col-mb-10 text-start">
                    <div class="form-check">
                        <input class="form-check-input" name="sugar" type="checkbox" value="1" id="sugar">
                        <label class="form-check-label" for="sugar">
                            Sugar Free
                        </label>
                    </div> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="gluten" value="1" id="gluten">
                        <label class="form-check-label" for="gluten">
                            Gluten Free
                        </label>
                    </div>   
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="lacto" value="1" id="lacto">
                        <label class="form-check-label" for="lacto">
                            Lactose Free
                        </label>
                    </div>   
                </div>
            </div>
            <div class="row">      
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
                    <input type="text" class="form-control" name="price" id="price">
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
                    <input id="datepicker" name="showDate" width="276" />
                    <script>
                        $('#datepicker').datepicker({ uiLibrary: 'bootstrap5' });
                    </script>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>
