<?php
 /**
 *
 * @author Lana (Svetlana Muraveckaja-Odincova)
 */
session_start();
if (!isset($_SESSION['admin'])) header("Location: login.php");
include('../includes/connection.php');
include('./includes/header.php');
?>
<!-- Javascript code to ensure secure product deletion with confirmation message -->
<script>  
function deleteItem(id) {
  if (confirm("Are you sure you want to delete this product?")) {
    fetch('dashboard.php?', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'delete=1&productID=' + encodeURIComponent(id)
    })
    .then(response => response.text())
    .then(data => {
      console.log("Response:", data);
      if (data.includes("deleted")) {
        alert("Product deleted successfully.");
        location.reload();
      } else {
        alert("Delete failed");
      }
    })
    .catch(error => {
      console.error("Error deleting product:", error);
    });
  }
}
</script>  
<!-- Products list's header start -->  
<section id="tableHeader" class="pt-3 pb-3">
    <div class="container text-center">
        <div class="row">
            <div class="float-start col-md-2"></div>
            <div class="float-start col-md-2">Title</div>
            <div class="float-start col-md-2">Description</div>
            <div class="float-start col-md-2">Price</div>
            <div class="float-start col-md-2">Available Today</div>
            <div class="float-start col-md-1"></div>
            <div class="float-start col-md-1"></div>
        </div>
    </div>    
</section>
<!-- Products list's header end -->  

<!-- Delete product from database after confirmation-->
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"]) && isset($_POST["productID"])) {
      $id = intval($_POST["productID"]);
      //$conn->query("DELETE FROM `products` WHERE `productID` = $id");
      $sql = $conn->prepare("DELETE FROM `products` WHERE `productID` =  ?");
      $sql->bind_param("i", $id);
      $sql->execute();
      exit();
  }
  // Uptdate products table, set for selected product date to current date
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mark"])) {
      $today = date("Y-m-d");
      if(isset($_POST["available"]) && is_array($_POST["available"])) {
          $itemsID = $_POST["available"];
          foreach ($itemsID as $id){
              $id = intval($id);
              $sql = $conn->prepare("UPDATE `products` SET date = '$today' where `productID` = ?");
              $sql->bind_param("i", $id);
              $sql->execute();
          }
        
      }
}
?>
<!-- Products list starts -->
<section id="tableBody"> 
    <div class="container text-center">    
        <form method="POST" action="dashboard.php">   
        <?php
          // Get all products from database
          $sql = "SELECT * FROM `products`";
          $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                  $isAvailable = $row['date'] == date("Y-m-d") ? "checked" : "";
                echo "
                  <div class='row pt-3 pb-3 item-row'>
                      <div class='float-start col-md-2'><img src='../img/products/".$row['image']."' alt='item' width ='40px'></div>
                      <div class='float-start col-md-2'>".$row['productName']."</div>
                      <div class='float-start col-md-2'>".substr($row['productDescription'], 0, 50)."...</div>
                      <div class='float-start col-md-2 text-center'>£".$row['price']."</div>
                      <div class='float-start col-md-2 text-center'><input class='form-check-input' type='checkbox' name='available[]' value ='".$row['productID']."' ".$isAvailable."></div>
                      <div class='float-start col-md-1 text-center'><a href='editProduct.php?id=".$row['productID']."'><i class='fa-solid fa-pen-to-square'></i></a></div>
                      <div class='float-start col-md-1'><button class='form' type='button' onClick='deleteItem(".$row['productID'].")'><i class='fa-solid fa-trash-can'></i></button></div>
                  </div> ";  
              
              }
        ?>
        <div class="text-end pt-3 pb-3">
            <button type="submit" name="mark" class="btn btn-primary">Update Available Product Today</button>
</div>
    </form>
    </div>
</section>
<!-- Products list end -->

	
