CREATE DATABASE playerdb;
USE playerdb;


CREATE TABLE team (
    teamid INT AUTO_INCREMENT PRIMARY KEY,
    teamname VARCHAR(255) NOT NULL,
    teamlogo VARCHAR(255) NOT NULL
);

CREATE TABLE nationality (
    nationalityid INT AUTO_INCREMENT PRIMARY KEY,
    nationalityname VARCHAR(255) NOT NULL,
    flag VARCHAR(255) NOT NULL
);

CREATE TABLE league (
    leagid INT AUTO_INCREMENT PRIMARY KEY,
    leagname VARCHAR(255) NOT NULL,
    leaglogo VARCHAR(255) NOT NULL
);
CREATE TABLE players (
    playerid INT AUTO_INCREMENT PRIMARY KEY,
    playername VARCHAR(255) NOT NULL,
    position VARCHAR(50) NOT NULL,
    playerimage VARCHAR(255) NOT NULL,
    pac INT NOT NULL,
    sho INT NOT NULL,
    def INT NOT NULL,
    pas INT NOT NULL,
    dri INT NOT NULL,
    phy INT NOT NULL,
    teamid INT,
    nationalityid INT,
    leagid INT,
    FOREIGN KEY (teamid) REFERENCES team(teamid),
    FOREIGN KEY (nationalityid) REFERENCES nationality(nationalityid),
    FOREIGN KEY (leagid) REFERENCES league(leagid)
);
-- =======================================================================
INSERT INTO team (teamname, teamlogo) VALUES
('FC Barcelona', 'https://cdn.sofifa.net/meta/team/241/120.png'),
('Real Madrid', 'https://cdn.sofifa.net/meta/team/3468/120.png'),
('Manchester United', 'https://cdn.sofifa.net/meta/team/14/120.png'),
('Bayern Munich', 'https://cdn.sofifa.net/meta/team/503/120.png'),
('Paris Saint-Germain', 'https://cdn.sofifa.net/meta/team/591/120.png'),
('Juventus', 'https://cdn.sofifa.net/meta/team/111/120.png'),
('Chelsea', 'https://cdn.sofifa.net/meta/team/48/120.png'),
('Liverpool', 'https://cdn.sofifa.net/meta/team/29/120.png'),
('AC Milan', 'https://cdn.sofifa.net/meta/team/21/120.png'),
('Inter Milan', 'https://cdn.sofifa.net/meta/team/103/120.png'),
('Arsenal', 'https://cdn.sofifa.net/meta/team/1/120.png'),
('Tottenham Hotspur', 'https://cdn.sofifa.net/meta/team/62/120.png');
INSERT INTO league (leagname, leaglogo) VALUES
('Major League Soccer', 'https://cdn.sofifa.net/meta/team/239235/120.png'),
('Saudi Pro League', 'https://cdn.sofifa.net/meta/team/2506/120.png'),
('Premier League', 'https://cdn.sofifa.net/meta/team/8/120.png'),
('La Liga', 'https://cdn.sofifa.net/meta/team/7980/120.png'),
('Bundesliga', 'https://cdn.sofifa.net/meta/team/503/120.png'),
('Ligue 1', 'https://cdn.sofifa.net/meta/team/7011/120.png'),
('Serie A', 'https://cdn.sofifa.net/meta/team/2364/120.png'),
('Eredivisie', 'https://cdn.sofifa.net/meta/team/721/120.png'),
('Primeira Liga', 'https://cdn.sofifa.net/meta/team/818/120.png'),
('J1 League', 'https://cdn.sofifa.net/meta/team/2310/120.png'),
('Super Lig', 'https://cdn.sofifa.net/meta/team/2230/120.png'),
('A-League', 'https://cdn.sofifa.net/meta/team/1633/120.png');
INSERT INTO nationality (nationalityname, flag) VALUES
('Argentina', 'https://cdn.sofifa.net/flags/ar.png'),
('Portugal', 'https://cdn.sofifa.net/flags/pt.png'),
('Belgium', 'https://cdn.sofifa.net/flags/be.png'),
('France', 'https://cdn.sofifa.net/flags/fr.png'),
('Netherlands', 'https://cdn.sofifa.net/flags/nl.png'),
('Germany', 'https://cdn.sofifa.net/flags/de.png'),
('Brazil', 'https://cdn.sofifa.net/flags/br.png'),
('Egypt', 'https://cdn.sofifa.net/flags/eg.png'),
('Slovenia', 'https://cdn.sofifa.net/flags/si.png'),
('Spain', 'https://cdn.sofifa.net/flags/es.png'),
('Italy', 'https://cdn.sofifa.net/flags/it.png'),
('England', 'https://cdn.sofifa.net/flags/gb.png'),
('Uruguay', 'https://cdn.sofifa.net/flags/uy.png'),
('Colombia', 'https://cdn.sofifa.net/flags/co.png'),
('Croatia', 'https://cdn.sofifa.net/flags/hr.png'),
('Mexico', 'https://cdn.sofifa.net/flags/mx.png'),
('Chile', 'https://cdn.sofifa.net/flags/cl.png'),
('Sweden', 'https://cdn.sofifa.net/flags/se.png'),
('Denmark', 'https://cdn.sofifa.net/flags/dk.png'),
('Poland', 'https://cdn.sofifa.net/flags/pl.png');

-- ========================================================================

SELECT 
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
    league ON players.leagid = league.leagid;

-- ========================================================================

select count(playername), nationalityname 
from players 
join  nationality on players.nationalityid=nationality.nationalityid 
group by nationalityname;