 <?php
 /**
 *
 * @author Lana (Svetlana Muraveckaja-Odincova)
 */
session_start();
if (!isset($_SESSION['admin'])) header("Location: login.php");
include('./includes/header.php');
include('../includes/connection.php');
$message = "";
//Add new category to database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $active = 1;
    $sql = $conn->prepare("INSERT INTO `productTypes` (`typeName`, `active`) VALUES (?, ?)");
    $sql->bind_param("si",
                     $category,
                     $active
                    );
    if($sql->execute()) {
        $message = "Product saved successfully";
    } else{
        $message = "Something went wrong. Please try again.";
    }
}
 ?>
 <section id="addCategoryForm">  
    <div class="container text-center">
        <?php
            if(!empty($message)){
                echo "<div class='alert alert-info' role='alert'>".$message."</div>";
            }
        ?>     
        <form method="post" enctype="multipart/form-data">
            <div class="row"> 
                <div class="col-mb-12 text-start">
                    <label for="category" class="form-label">Category Name</label>
                    <input type="text" class="form-control" name="category" id="category" aria-describedby="Category name">
                </div>
            </div> 
            <div class="row pt-3 pb-3">  
                <div class="col-md-5 text-start">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>  
        </form>
    </div>
</section>
