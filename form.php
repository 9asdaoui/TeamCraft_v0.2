<?php include 'navbares.php'; ?>

<div class="content">

        <div id="add-player" class="section hidden">
            <h1>Add Player</h1>

     <form id="playerForm" action="players.php" method="POST">


        <div class="continer">

                    <label for="playerName">Player Name:</label>
                    <input type="text" id="playerName" name="playerName" placeholder="Player Name" required>
                    <label for="playerPace">Pace:</label>
                    <input type="number" id="playerPace" name="playerPace" placeholder="Pace" required min="1" max="100">

                    <label for="playerShooting">Shooting:</label>
                    <input type="number" id="playerShooting" name="playerShooting" placeholder="Shooting" required min="1" max="100">
                    


                    <label for="nationality">Nationality:</label>
                    <select id="nationality" name="nationality" required>
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
                    <select id="playerPosition" name="playerPosition" required>
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
                    <input type="number" id="playerDefending" name="playerDefending" placeholder="Defending" required min="1" max="100">

                    <label for="playerPassing">Passing:</label>
                    <input type="number" id="playerPassing" name="playerPassing" placeholder="Passing" required min="1" max="100">
                    
                    <label for="club">Club:</label>
                    <select id="club" name="club" required>
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
                    <input type="url" id="playerImage" name="playerImage" placeholder="Player Image URL" required>
                    
                    <label for="playerDribbling">Dribbling:</label>
                    <input type="number" id="playerDribbling" name="playerDribbling" placeholder="Dribbling" required min="1" max="100">

                    <label for="playerPhysical">Physical:</label>
                    <input type="number" id="playerPhysical" name="playerPhysical" placeholder="Physical" required min="1" max="100">
                    
                    <label for="league">League:</label>
                    <select id="league" name="league" required>
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
        </div>

                <button type="submit" name="addbtn">Submit</button>
    </form>
     </div>
     </div>
</body>

</html>