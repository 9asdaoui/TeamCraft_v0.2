<?php
//Method one
header("Access-Control-Allow-Origin: * ");

    $servername = "localhost";
    $username = "root";
    $password = "redaader@2000";
    $dbname = "playerdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    if(isset($_GET["playerid"])){

        $id=$_GET["playerid"];
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
                    WHERE playerid=$id ";
    }else{
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
                        league ON players.leagid = league.leagid";}

            $result = $conn->query($sql);

                        
                if ($result->num_rows > 0) {
                    $data = [];
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }

                    header('Content-Type: application/json');
                    echo json_encode($data);
                }
?>
