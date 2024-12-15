<?php include 'navbares.php'; ?>


    <div class="content">
        <div id="add-player" class="section hidden">
            <h1>Edit Player</h1>
        <form id="playerForm" method="POST">
        <div class="continer">
<?php

    if (isset($_GET["id"])){
        $id = $_GET["id"];

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
                    league ON players.leagid = league.leagid
                WHERE playerid = $id ";

        $result = $conn->query($sql);


 

        $row = $result->fetch_assoc() ;

                 echo '   <label for="playerName">Player Name:</label>
                    <input type="text" id="playerName" name="playerName" placeholder="Player Name" required value="' . $row['playername'] . '">
                    <label for="playerPace">Pace:</label>
                    <input type="number" id="playerPace" name="playerPace" placeholder="Pace" required min="1" max="100" value="' . $row['pac'] .'">

                    <label for="playerShooting">Shooting:</label>
                    <input type="number" id="playerShooting" name="playerShooting" placeholder="Shooting" required min="1" max="100" value="'. $row['sho'] .'">
                    


                    <label for="nationality">Nationality:</label>
                    <select id="nationality" name="nationality" required value="' . $row['nationalityname'] . '">
                        <option disabled>Select Nationality</option>
                        <option value="5">🇦🇷 Argentina</option>
                        <option value="6">🇵🇹 Portugal</option>
                        <option value="7">🇧🇪 Belgium</option>
                        <option value="8">🇫🇷 France</option>
                        <option value="9">🇳🇱 Netherlands</option>
                        <option value="10">🇩🇪 Germany</option>
                        <option value="11">🇧🇷 Brazil</option>
                        <option value="12">🇪🇬 Egypt</option>
                        <option value="13">🇸🇮 Slovenia</option>
                        <option value="14">🇪🇸 Spain</option>
                        <option value="15">🇮🇹 Italy</option>
                        <option value="16">🇬🇧 England</option>
                        <option value="17">🇺🇾 Uruguay</option>
                        <option value="18">🇨🇴 Colombia</option>
                        <option value="19">🇭🇷 Croatia</option>
                        <option value="20">🇲🇽 Mexico</option>
                        <option value="21">🇨🇱 Chile</option>
                        <option value="22">🇸🇪 Sweden</option>
                        <option value="23">🇩🇰 Denmark</option>
                        <option value="24">🇵🇱 Poland</option>
                    </select>
        </div>
      
        <div class="continer">
            
        <label for="playerPosition">Player Position:</label>
                    <select id="playerPosition" name="playerPosition" required value="' . $row['position'] . '">
                        <option value="">Select Position</option>
                        <option value="CB">Center Back</option>
                        <option value="LB">Left Back</option>
                        <option value="RB">Right Back</option>
                        <option value="CM">Center Midfield</option>
                        <option value="LW">Left Wing</option>
                        <option value="RW">Right Wing</option>
                        <option value="ST">Striker</option>
                    </select>

                    <label for="playerDefending">Defending:</label>
                    <input type="number" id="playerDefending" name="playerDefending" placeholder="Defending" required min="1" max="100" value="' . $row['def'] . '">

                    <label for="playerPassing">Passing:</label>
                    <input type="number" id="playerPassing" name="playerPassing" placeholder="Passing" required min="1" max="100" value="' . $row['pas'] . '">
                    
                    <label for="club">Club:</label>
                    <select id="club" name="club" required value="' . $row['teamname'] . '">
                        <option disabled>Select Club</option>
                        <option value="4">FC Barcelona</option>
                        <option value="5">Real Madrid</option>
                        <option value="6">Manchester United</option>
                        <option value="7">Bayern Munich</option>
                        <option value="8">Paris Saint-Germain</option>
                        <option value="9">Juventus</option>
                        <option value="10">Chelsea</option>
                        <option value="11">Liverpool</option>
                        <option value="12">AC Milan</option>
                        <option value="13">Inter Milan</option>
                        <option value="14">Arsenal</option>
                        <option value="15">Tottenham Hotspur</option>
                    </select>
        </div>
        <div class="continer">
            
        <label for="playerImage">Player Image URL:</label>
                    <input type="url" id="playerImage" name="playerImage" placeholder="Player Image URL" required value="' . $row['playerimage'] . '">
                    
                    <label for="playerDribbling">Dribbling:</label>
                    <input type="number" id="playerDribbling" name="playerDribbling" placeholder="Dribbling" required min="1" max="100" value="' . $row['dri'] . '">

                    <label for="playerPhysical">Physical:</label>
                    <input type="number" id="playerPhysical" name="playerPhysical" placeholder="Physical" required min="1" max="100" value="' . $row['phy'] . '">
                    
                    <label for="league">League:</label>
                    <select id="league" name="league" required value="' . $row['leagname'] . '">
                        <option disabled>Select League</option>
                        <option value="5">Major League Soccer</option>
                        <option value="6">Saudi Pro League</option>
                        <option value="7">Premier League</option>
                        <option value="8">La Liga</option>
                        <option value="9">Bundesliga</option>
                        <option value="10">Ligue 1</option>
                        <option value="11">Serie A</option>
                        <option value="12">Eredivisie</option>
                        <option value="13">Primeira Liga</option>
                        <option value="14">J1 League</option>
                        <option value="15">Super Lig</option>
                        <option value="16">A-League</option>
                    </select>
        </div>';
    $conn->close();
}
?>
    <button type="submit" name="editbtn">edit player</button>
        </form>

        <?php
            if (isset($_POST["editbtn"])) {


                $servername = "localhost";
                $username = "root";
                $password = "redaader@2000";
                $dbname = "playerdb";
            
            
                $conn = new mysqli($servername, $username, $password, $dbname);
            
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

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
            
                $playerQuery = "UPDATE players 
                                SET 
                                    playername = ?, 
                                    position = ?, 
                                    playerimage = ?, 
                                    pac = ?, 
                                    sho = ?, 
                                    def = ?, 
                                    pas = ?, 
                                    dri = ?, 
                                    phy = ?, 
                                    teamid = ?, 
                                    nationalityid = ?, 
                                    leagid = ? 
                                WHERE 
                                    playerid = ?";
            
                $stmt = $conn->prepare($playerQuery);
                $stmt->bind_param(
                    "sssiiiiiiiiii", 
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
                    $leagueName, 
                    $id
                );
            
                $stmt->execute();
                $stmt->close();
                $conn->close();
                echo "<script type='text/javascript'>location.href = 'players.php';</script>";
            }
        ?>
</div>
</div>
</body>
</html>