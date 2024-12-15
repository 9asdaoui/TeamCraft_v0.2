<?php

            $servername = "localhost";
            $username = "root";
            $password = "redaader@2000";
            $dbname = "playerdb";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST["addbtn"]) ){

                $playerName = $_POST['playerName'];
                $playerPosition = $_POST['playerPosition'];
                $playerImage = $_POST['playerImage'];
                $playerPace = $_POST['playerPace'];
                $playerShooting = $_POST['playerShooting'];
                $playerDefending = $_POST['playerDefending'];
                $playerPassing = $_POST['playerPassing'];
                $playerDribbling = $_POST['playerDribbling'];
                $playerPhysical = $_POST['playerPhysical'];
                $teamName = $_POST["club"];
                $nationality = $_POST['nationality'];
                $leagueName = $_POST['league'];

                $playerQuery = "INSERT INTO players (playername, position, playerimage, pac, sho, def, pas, dri, phy,teamid,nationalityid,leagid)

                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($playerQuery);
                $stmt->bind_param(
                    "sssiiiiiiiii",
                    $playerName,
                    $playerPosition,
                    $playerImage,
                    $playerPace,
                    $playerShooting,
                    $playerDefending,
                    $playerPassing,
                    $playerDribbling,
                    $playerPhysical,
                    $teamName,
                    $nationality,
                    $leagueName
                );
                $stmt->execute();

                $stmt->close();
                $conn->close();
                header("Location: " . $_SERVER["PHP_SELF"]);
                exit();
                echo "Player added successfully!";
            }
?>
<?php

    if(isset($_GET["deleteid"])){

            $id=$_GET["deleteid"];

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $query = "DELETE FROM players WHERE playerid = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->close();
            $conn->close();


    }

?>

<?php include 'navbares.php'; ?>

    
<div class="content">
        <div id="players" >
            <h1>Players</h1>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "redaader@2000";
            $dbname = "playerdb";


            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT 
                        players.playerid,
                        players.playername,
                        players.position,
                        players.playerimage,
                        players.pac,
                        players.sho,
                        players.def,
                        players.pas,
                        players.dri,
                        players.phy,
                        team.teamname,
                        team.teamlogo,
                        nationality.nationalityname,
                        nationality.flag,
                        league.leagname,
                        league.leaglogo
                    FROM 
                        players
                    JOIN 
                        team ON players.teamid = team.teamid
                    JOIN 
                        nationality ON players.nationalityid = nationality.nationalityid
                    JOIN 
                        league ON players.leagid = league.leagid";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Player ID</th>
                            <th>Player Name</th>
                            <th>Position</th>
                            <th>Player Image</th>
                            <th>PAC</th>
                            <th>SHO</th>
                            <th>DEF</th>
                            <th>PAS</th>
                            <th>DRI</th>
                            <th>PHY</th>
                            <th>Team Name</th>
                            <th>Team Logo</th>
                            <th>Nationality</th>
                            <th>Flag</th>
                            <th>League Name</th>
                            <th>League Logo</th>
                            <th>edit</th>
                            <th>delet</th>

                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['playerid'] . "</td>
                            <td>" . $row['playername'] . "</td>
                            <td>" . $row['position'] . "</td>
                            <td><img src='" . $row['playerimage'] . "' alt='" . $row['playername'] . "' width='50' height='50'></td>
                            <td>" . $row['pac'] . "</td>
                            <td>" . $row['sho'] . "</td>
                            <td>" . $row['def'] . "</td>
                            <td>" . $row['pas'] . "</td>
                            <td>" . $row['dri'] . "</td>
                            <td>" . $row['phy'] . "</td>
                            <td>" . $row['teamname'] . "</td>
                            <td><img src='" . $row['teamlogo'] . "' alt='" . $row['teamname'] . "' width='50' height='50'></td>
                            <td>" . $row['nationalityname'] . "</td>
                            <td><img src='" . $row['flag'] . "' alt='" . $row['nationalityname'] . "' width='50' height='50'></td>
                            <td>" . $row['leagname'] . "</td>
                            <td><img src='" . $row['leaglogo'] . "' alt='" . $row['leagname'] . "' width='50' height='50'></td>
                            <td><a class='editbtn' href='edit.php?id=" . $row['playerid'] . "'>edit</a></td>
                            <td><a class='deletbtn' href='?deleteid=" . $row['playerid'] . "'>delete</a></td>

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
</body>

</html>