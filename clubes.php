<?php
    $servername = "localhost";
    $username = "root";
    $password = "redaader@2000";
    $dbname = "playerdb";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET["deleteclubid"])){

            $id=$_GET["deleteclubid"];

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $query = "DELETE FROM team WHERE teamid = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->close();


    }

?>

<?php include 'navbares.php'; ?>

<div class="content">

        <div id="formaddnatclub">
            <button popovertarget="addNationalityForm" class="addnewnatclub" id="addclubbtn">Add team</button>

            <div id="addNationalityForm" popover>
                
                <?php 
                global $team;
                global $teamlogo;
                if(isset($_GET["editclubeid"])){
                            $editid=$_GET["editclubeid"];

                            $conn = new mysqli($servername, $username, $password, $dbname);
                    
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $query = "SELECT * FROM team WHERE teamid = $editid";
                            $result = $conn->query($query);
                            $row = $result->fetch_assoc() ;

                             $team=$row['teamname'];
                             $teamlogo=$row['teamlogo'];

                            $conn->close(); }?>

                <form id="formContainer"  method="POST">
                    <label for="nationalityName">team Name:</label>
                    <input type="text" id="nationalityName" name="teamName" value="<?= $team? $team:' ' ;?>" placeholder=" e.g., French">

                    <label for="flagUrl">teamlogo URL:</label>
                    <input type="text" id="flagUrl" name="teamlogoUrl" value="<?= $teamlogo? $teamlogo:' ' ;?>" placeholder="e.g., https://example.com/teamlogo.png">

               
<?php 
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if (isset($_POST["addnatclubbtn"]) ){

        $team = $_POST['teamName'];
        $teamlogo = $_POST['teamlogoUrl'];

        if($team){
           $playerQuery = "UPDATE team SET  teamname = ?, teamlogo = ? WHERE teamid = ?";
           $stmt = $conn->prepare($playerQuery);
           $stmt->bind_param("sss",$team,$teamlogo,$editid);
        }else{

           $playerQuery = "INSERT INTO team (teamname,teamlogo) VALUES (?, ?)";
           $stmt = $conn->prepare($playerQuery);
           $stmt->bind_param("ss",$team,$teamlogo);
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

            $sql = "SELECT * FROM team";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Player ID</th>
                            <th>team</th>
                            <th>teamlogo</th>
                            <th>edit</th>
                            <th>delet</th>

                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['teamid'] . "</td>
                            <td>" . $row['teamname'] . "</td>
                            <td><img src='" . $row['teamlogo'] . "' width='50' height='50'></td>
                            <td><a class='editbtn' href='?editclubeid=" . $row['teamid'] . "'>edit</a></td>
                            <td><a class='deletbtn' href='?deleteclubid=" . $row['teamid'] . "'>delete</a></td>

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
        let editclubeid = urlParams.get('editclubeid');
    if(editclubeid){
        document.getElementById("addclubbtn").click();
    };

</script>
</body>

</html>