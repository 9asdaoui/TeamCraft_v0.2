<?php include 'navbares.php'; ?>
<?php

        if (isset($_GET["editplayerid"])){
            $editplayerid = $_GET["editplayerid"];
        
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
                    LEFT JOIN 
                        team ON players.teamid = team.teamid
                    LEFT JOIN 
                        nationality ON players.nationalityid = nationality.nationalityid
                    LEFT JOIN 
                        league ON players.leagid = league.leagid
                    WHERE playerid = $editplayerid ";

            $result = $conn->query($sql);
            $row = $result->fetch_assoc() ;

                    $playername=$row['playername'];
                    $pac=$row['pac'];
                    $sho=$row['sho'];
                    $nationalityname=$row['nationalityname'];
                    $position=$row['position'];
                    $def=$row['def'];
                    $pas=$row['pas'];
                    $teamname=$row['teamname'];
                    $playerimage=$row['playerimage'];
                    $dri=$row['dri'];
                    $phy=$row['phy'];
                    $leagname=$row['leagname'];
            
        $conn->close();
    }else{
        $playername="";
        $pac="";
        $sho="";
        $nationalityname="";
        $position="";
        $def="";
        $pas="";
        $teamname="";
        $playerimage="";
        $dri="";
        $phy="";
        $leagname="";   
    }
?>
<div class="content">

        <div id="add-player" class="section hidden">
            <h1>Add Player</h1>

     <form id="playerForm" action="players.php?<?php if(isset($_GET["editplayerid"])) {echo 'editplayerid='.$_GET['editplayerid'];};?>" method="POST">


        <div class="continer">

        

                    <label for="playerName">Player Name:</label>
                    <input type="text" id="playerName" name="playerName" placeholder="Player Name" value="<?= $playername? $playername:' ' ;?>" required>
                    <label for="playerPace">Pace:</label>
                    <input type="number" id="playerPace" name="playerPace" placeholder="Pace" required min="1" max="100" value="<?= $pac? $pac:' ' ;?>">

                    <label for="playerShooting">Shooting:</label>
                    <input type="number" id="playerShooting" name="playerShooting" placeholder="Shooting" required min="1" max="100" value="<?= $sho? $sho:' ' ;?>">
                    


                    <label for="nationality">Nationality:</label>
                    <select id="nationality" name="nationality" required>
                    <option><?= $nationalityname ? $nationalityname :'Select Nationality' ;?></option>
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "redaader@2000";
                        $dbname = "playerdb";
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT * FROM nationality";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['nationalityid'].'">'.$row['nationalityname'].'</option>';
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    ?>
                    </select>
        </div>
      
        <div class="continer">
            
        <label for="playerPosition">Player Position:</label>
                    <select id="playerPosition" name="playerPosition" required value="">
                        <option value=""><?= $position? $position:'Select Position' ;?></option>
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
                    <input type="number" id="playerDefending" name="playerDefending" placeholder="Defending" required min="1" max="100" value="<?= $def? $def:' ' ;?>" >

                    <label for="playerPassing">Passing:</label>
                    <input type="number" id="playerPassing" name="playerPassing" placeholder="Passing" required min="1" max="100" value="<?= $pas? $pas:' ' ;?>">
                    
                    <label for="club">Club:</label>
                    <select id="club" name="club" required value="">
                        <option><?= $teamname? $teamname:'Select Club' ;?></option>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "redaader@2000";
                        $dbname = "playerdb";
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT * FROM team";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['teamid'].'">'.$row['teamname'].'</option>';
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    ?>
                    </select>
        </div>
        <div class="continer">
            
        <label for="playerImage">Player Image URL:</label>
                    <input type="url" id="playerImage" name="playerImage" placeholder="Player Image URL" required value="<?= $playerimage? $playerimage:' ' ;?>">
                    
                    <label for="playerDribbling">Dribbling:</label>
                    <input type="number" id="playerDribbling" name="playerDribbling" placeholder="Dribbling" required min="1" max="100" value="<?= $dri? $dri:' ' ;?>">

                    <label for="playerPhysical">Physical:</label>
                    <input type="number" id="playerPhysical" name="playerPhysical" placeholder="Physical" required min="1" max="100" value="<?= $phy? $phy:' ' ;?>">
                    
                    <label for="league">League:</label>
                    <select id="league" name="league" required value="">
                        <option><?= $leagname? $leagname:' Select League' ;?></option>
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
        </div>

                <button type="submit" name="addbtn">Submit</button>
    </form>
     </div>
     </div>
</body>

</html>