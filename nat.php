<?php
    $servername = "localhost";
    $username = "root";
    $password = "redaader@2000";
    $dbname = "playerdb";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET["deletenatid"])){

            $id=$_GET["deletenatid"];

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $query = "DELETE FROM nationality WHERE nationalityid = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->close();


    }

?>

<?php include 'navbares.php'; ?>

<div class="content">

        <div id="formaddnatclub">
            <button popovertarget="addNationalityForm" class="addnewnatclub" id="addntnnn">Add Nationality</button>

            <div id="addNationalityForm" popover>
                
                <?php 
                global $nat;
                global $flag;
                if(isset($_GET["editnatid"])){
                            $editid=$_GET["editnatid"];

                            $conn = new mysqli($servername, $username, $password, $dbname);
                    
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $query = "SELECT * FROM nationality WHERE nationalityid = $editid";
                            $result = $conn->query($query);
                            $row = $result->fetch_assoc() ;

                             $nat=$row['nationalityname'];
                             $flag=$row['flag'];

                            $conn->close(); }?>

                <form id="formContainer"  method="POST">
                    <label for="nationalityName">Nationality Name:</label>
                    <input type="text" id="nationalityName" name="nationalityName" value="<?= $nat? $nat:' ' ;?>" placeholder=" e.g., French">

                    <label for="flagUrl">Flag URL:</label>
                    <input type="text" id="flagUrl" name="flagUrl" value="<?= $flag? $flag:' ' ;?>" placeholder="e.g., https://example.com/flag.png">

               
<?php 
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if (isset($_POST["addnatclubbtn"]) ){

        $nationality = $_POST['nationalityName'];
        $flag = $_POST['flagUrl'];

        if($nat){
            echo "ana f edit";
           $playerQuery = "UPDATE nationality SET  nationalityname = ?, flag = ? WHERE nationalityid = ?";
           $stmt = $conn->prepare($playerQuery);
           $stmt->bind_param("sss",$nationality,$flag,$editid);
        }else{
            echo "ana f add";

           $playerQuery = "INSERT INTO nationality (nationalityname,flag) VALUES (?, ?)";
           $stmt = $conn->prepare($playerQuery);
           $stmt->bind_param("ss",$nationality,$flag);
        }
        

        $stmt->execute();

        $stmt->close();
        $conn->close();
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
        
?>
                    <button class="formsavebtn" name="addnatclubbtn" >Save</button>
                </form>
            </div>
        </div>

        <div id="players" >
            <h1>Players</h1>
        <?php

            $sql = "SELECT * FROM nationality";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Player ID</th>
                            <th>Nationality</th>
                            <th>Flag</th>
                            <th>edit</th>
                            <th>delet</th>

                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['nationalityid'] . "</td>
                            <td>" . $row['nationalityname'] . "</td>
                            <td><img src='" . $row['flag'] . "' width='50' height='50'></td>
                            <td><a class='editbtn' href='?editnatid=" . $row['nationalityid'] . "'>edit</a></td>
                            <td><a class='deletbtn' href='?deletenatid=" . $row['nationalityid'] . "'>delete</a></td>

                        </tr>";
                }

                echo "</table>";
            } else {
                echo "0 results";
            }

            $conn->close();
        ?>
            
        </div>
    </div>
    </div>

<script>
        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let editnatid = urlParams.get('editnatid');
    if(editnatid){
        document.getElementById("addntnnn").click();
    };

</script>
</body>

</html>