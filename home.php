
    <?php include 'navbares.php'; ?>

    <div class="content">
        <div id="home" class="section">
            <h1>Hello, Welcome to the Dashboard!</h1>

            <div class="dashboard-stats">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "redaader@2000";
                $dbname = "playerdb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM players;";
                $result = $conn->query($sql);

                echo '<div class="stat-card">';
                echo '<p>Total Players</p>';
                echo '<h2>' . $result->num_rows . '</h2>';
                echo '</div>';

                $sql = "SELECT COUNT(playername), teamname FROM players JOIN team ON players.teamid=team.teamid GROUP BY teamname;";
                $result = $conn->query($sql);

                echo '<div class="stat-card">';
                echo '<p>Total Teams</p>';
                echo '<h2>' . $result->num_rows . '</h2>';
                echo '</div>';

                $sql = "SELECT COUNT(playername), nationalityname FROM players JOIN nationality ON players.nationalityid=nationality.nationalityid GROUP BY nationalityname;";
                $result = $conn->query($sql);

                echo '<div class="stat-card">';
                echo '<p>Total Nationalities</p>';
                echo '<h2>' . $result->num_rows . '</h2>';
                echo '</div>';

                $sql = "SELECT playername, (pac + sho + def + pas + dri + phy) AS overall FROM players ORDER BY overall DESC LIMIT 5;";
                $result = $conn->query($sql);

                echo '<div class="stat-card">';
                echo '<h2>Top Players</h2>';
                echo '<ul>';
                while ($row = $result->fetch_assoc()) {
                    echo '<li>' . $row['playername'] . ': ' . $row['overall'] . '</li>';
                }
                echo '</ul>';
                echo '</div>';

                $sql = "SELECT teamname,teamlogo, AVG(pac + sho + def + pas + dri + phy) AS avg_performance FROM players JOIN team ON players.teamid=team.teamid GROUP BY teamname,teamlogo ORDER BY avg_performance DESC LIMIT 1;";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                echo '<div class="stat-card">';
                echo '<p>Best Team (Avg Stats: ' . round($row['avg_performance'], 2) . ')</p>';
                echo '<img src='. $row['teamlogo'] .' ></img>';
                echo '<h2>' . $row['teamname'] . '</h2>';
                echo '</div>';

                $sql = "SELECT nationalityname, COUNT(*) AS count FROM players JOIN nationality ON players.nationalityid=nationality.nationalityid GROUP BY nationalityname ORDER BY count DESC LIMIT 1;";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                echo '<div class="stat-card">';
                echo '<p>Most Represented Nationality (' . $row['count'] . ' Players)</p>';
                echo '<h2>' . $row['nationalityname'] . '</h2>';
                echo '</div>';

                $sql = "SELECT position, COUNT(*) AS count FROM players GROUP BY position;";
                $result = $conn->query($sql);

                echo '<div class="stat-card">';
                echo '<h2>Players by Position</h2>';
                echo '<ul>';
                while ($row = $result->fetch_assoc()) {
                    echo '<li>' . $row['position'] . ': ' . $row['count'] . '</li>';
                }
                echo '</ul>';
                echo '</div>';

                $sql = "SELECT leagname,leaglogo, COUNT(*) AS count FROM players JOIN league ON players.leagid=league.leagid GROUP BY leagname,leaglogo ORDER BY count DESC LIMIT 1;";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                echo '<div class="stat-card">';
                echo '<p>League with Most Players (' . $row['count'] . ' Players)</p>';
                echo '<img src='. $row['leaglogo'] .' ></img>';

                echo '<h2>' . $row['leagname'] . '</h2>';
                echo '</div>';
                ?>
            </div>
        </div>
    </div>
</body>

</html>
