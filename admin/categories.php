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
  
<section id="tableHeader" class="pt-3 pb-3">
    <div class="container text-center">
        <div class="row">
            <div class="float-start col-md-2"></div>
            <div class="float-start col-md-2">Category Name</div>
            <div class="float-start col-md-2">Active</div>
            <div class="float-start col-md-1"></div>
            <div class="float-start col-md-1"></div>
        </div>
    </div>    
</section>
<?php
//Save selected categories as active
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mark"])) {
    if(isset($_POST["active"]) && is_array($_POST["active"])) {
        $categoryID = $_POST["active"];
        
        $sql = "SELECT * FROM `productTypes`";
        $result = $conn->query($sql);
        $allID = [];
        //Get all categories IDs
        while ($row = $result->fetch_assoc()) {
            $allID[] = $row["typeID"];
        }    
        // Set state active for selected categories
        foreach ($allID as $id){
            $isAct = in_array($id, $categoryID) ? 1 : 0;
            $sql = $conn->prepare("UPDATE `productTypes` SET active = ? WHERE `typeID` = ?");
            $sql->bind_param("ii", $isAct, $id);
            $sql->execute();
        }
    }
}
?>
<section id="tableBody"> 
    <div class="container text-center">    
        <form method="POST" action="">   
        <?php
            $sql = "SELECT * FROM `productTypes`";
            $result = $conn->query($sql);
        
            while ($row = $result->fetch_assoc()) {
                $isActive = $row['active'] == 1 ? "checked" : "";
                echo "<div class='row pt-3 pb-3 item-row'>
                        <div class='float-start col-md-2'>".$row['typeID']."</div>
                        <div class='float-start col-md-2'>".$row['typeName']."</div>
                        <div class='float-start col-md-2 text-center'><input class='form-check-input' type='checkbox' name='active[]' value ='".$row['typeID']."' ".$isActive."></div>
                    </div> ";  
            }
?>
        <div class="text-end pt-3 pb-3">
            <button type="submit" name="mark" class="btn btn-primary">Set As Active</button>
</div>
    </form>
    </div>
</section>