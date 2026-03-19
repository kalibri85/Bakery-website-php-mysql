<?php include('./includes/connection.php'); ?>
<?php include('includes/header.php'); ?>

<section id="menu">
  <h2 class="text-center">Daily Menu</h2>
  <!-- Display filter options-->
  <form method="GET" class="filter-form pt-5 pb-5">
    <div class="container"> 
      <div class="row justify-content-center g-3" id="filter">
        <div class="col-md-2">
          <input type="text" name="search" class="form-control form-control-lg" placeholder="Search item..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
        </div>
        <div class="col-md-2">
          <select name="category" class="form-select form-select-lg">
          <option value="">All Categories</option>
            <?php
              $sql = "SELECT * FROM `productTypes` WHERE active = 1 ORDER BY `typeName` ASC";
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {
                $selected = (isset($_GET['category']) && $_GET['category'] == $row['typeID']) ? 'selected' : '';
                echo '<option value="' . $row['typeID'] . '" ' . $selected . '>' . htmlspecialchars($row['typeName']) . '</option>';
              }
            ?>
          </select>
        </div>
        <div class="col-md-3 d-flex align-items-center">
          <div class="row g-2 align-items-center w-100">
            <div class="col-auto d-flex align-items-center">
                <label class="form-check-label fw-bold">Free from:</label>
            </div>
            <div class="col-auto d-flex align-items-center custom-checkbox">    
              <label class="form-check-label me-1" for="sugar">
                <i class="fa-solid fa-cubes-stacked" title="Sugar Free"></i>
              </label>
              <input type="checkbox" class="form-check-input form-control-md me-1" name="sugar" id="sugar" <?= isset($_GET['sugar']) ? 'checked' : '' ?>>
            </div>
            <div class="col-auto d-flex align-items-center custom-checkbox">    
              <label class="form-check-label me-1" for="gluten"><i class="fa-solid fa-wheat-awn" title="Gluten Free"></i></label>
              <input type="checkbox" class="form-check-input form-control-md me-1" name="gluten" id="gluten" <?= isset($_GET['gluten']) ? 'checked' : '' ?>>
            </div>     
            <div class="col-auto d-flex align-items-center custom-checkbox">  
              <label class="form-check-label me-1" for="lactose"><i class="fa-solid fa-cow" title="Lactose Free"></i></label>
              <input type="checkbox" class="form-check-input form-control-md me-1" name="lactose" id="lactose" <?= isset($_GET['lactose']) ? 'checked' : '' ?>>
            </div>
          </div>
        </div>  
        <div class="col-md-3">
          <div class="row d-flex g-2 align-items-center">
            <div class="col-auto d-flex">
              <label class="form-check-label me-2 fw-bold">Price:</label>
            </div>
            <div class="col-auto d-flex align-items-center">
              <input type="number" name="min_price" class="form-control form-control-sm form-control-lg w-auto me-1 min-max" placeholder="Min">
              <span class="mx-1">–</span>
            </div>
            <div class="col-auto d-flex">
              <input type="number" name="max_price" class="form-control form-control-sm form-control-lg w-auto min-max" placeholder="Max">
            </div>  
          </div>
        </div> 
        <div class="col-md-2 align-items-center ">
          <button type="submit" class="btn btn-pink-border">
            <i class="fa-solid fa-filter"></i> Filter</button>
        </div>
      </div>
    </div>
  </form>
  <!-- Products list -->
  <div class='container text-center'>
    <div class="items row">
      <?php
      // Get filter criterea
        $search = $_GET['search'] ?? '';
        $category = $_GET['category'] ?? '';
        $sugar = isset($_GET['sugar']) && $_GET['sugar'] !== '' ? 1 : '';
        $gluten = isset($_GET['gluten']) && $_GET['gluten'] !== '' ? 1 : '';
        $lactose = isset($_GET['lactose']) && $_GET['lactose'] !== '' ? 1 : '';
        $min = $_GET['min_price'] !== '' ? (float) $_GET['min_price'] : 0;
        $max = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? (float) $_GET['max_price'] : 10000;   

        $sql = "SELECT products.* FROM `products` JOIN `productTypes` ON products.productTypeID = productTypes.typeID WHERE productTypes.active = 1 AND products.date = CURDATE()";
        $sql .= $search ? " AND products.productName LIKE '%$search%'" : "";
        $sql .= $category ? " AND products.productTypeID = '$category'" : "";
        $sql .= $sugar ? " AND products.sugar = '$sugar'" : "";
        $sql .= $gluten ? " AND products.gluten = '$gluten'" : "";
        $sql .= $lactose ? " AND products.lactose = '$lactose'" : "";
        $sql .= " AND products.price BETWEEN $min AND $max";
        $result = $conn->query($sql);
        // Get products
        while ($row = $result->fetch_assoc()) {
          echo "<div class='item col-md-3 float-start position-relative m-2'>
                  <a href='product.php?id=".$row['productID']."'>
                    <img src='img/products/".$row['image']."' alt='item'>
                    <div class='item-title'>".$row['productName']."</div>
                  </a>
                </div>";
        }
        ?>
    </div>    
  </div>
</section>
<!-- Feedback section start-->
<section class="feedback" id="feedback">
  <h2 class="section-title pt-5">Feedbacks</h2>
   <div class='container text-center'>
    <div class="feedbacks row">
        <?php
          function rating($id, $conn) {
            $summ = 0;
            $counter = 0;
            $sql = $conn->prepare("SELECT * FROM `reviews` WHERE `productID`= ?");
                if(!$sql) die("Error prepare query".$conn->error);
                $sql->bind_param("i", $id);
                if(!$sql->execute()) die("Error rating".$sql->error);
                $stars = '';
                $starsBorder = '';
                $result = $sql->get_result();
                while ($row = $result->fetch_assoc()) {
                  $summ+=$row['stars'];
                  $counter++;
                }  
                $numberParts = explode('.', (string)$summ/$counter);
                $beforePoint = (int)$numberParts[0];

                for($i = 0; $i < $beforePoint; $i++) {
                  $stars .= '<i class="fa-solid fa-star pink"></i>';
                }
                if((int)$numberParts[1]) {
                  $stars .= '<i class="fa-solid fa-star-half-stroke"></i>';
                  $beforePoint ++;
                }
                if($beforePoint < 5){
                  for($i = 0; $i <5-$beforePoint; $i++) {
                    $stars .= '<i class="fa-regular fa-star"></i>';
                  }
                }
                return '<div class="col-md-6 float-end text-end align-text-bottom">'.$stars.'</div>';
          }
        
          $sql = "SELECT reviews.*,products.image FROM `reviews` JOIN `products` ON reviews.productID = products.productID ORDER BY reviews.reviewID DESC LIMIT 3";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
              echo "<div class='col-md-4 float-start mt-4 mb-5'><div class='col-md-6 float-start text-start text-center'><img src='./img/products/".$row['image']."' width='149px' class='rounded-circle'><br><b>".$row['name']."</b></div>";
              echo rating($row['productID'], $conn);    
              echo "<p>".$row['reviewDescrioption']."</p>";
              echo "</div>";
          }
        ?>
    </div>    
  </div>
</section>
<!-- Feedback section end-->
 <!-- About us section start-->
<section class="about pb-3" id="about">
  <h2 class="section-title">About Us</h2>
  <div class="container"> 
    <div class="row justify-content-center g-3">
      <div class="col-md-6 pe-3">
        <img src="./img/bakery.jpg" width="100%">
      </div>
      <div class="col-md-6 ps-3">
       Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
      <br>
      Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum".
      </div>   
    </div>
  </div>                  
</section> 
<!-- About us section end -->
<?php include('includes/footer.php'); ?>
