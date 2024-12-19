let localPlayers = JSON.parse(localStorage.getItem("players"));
let players = localPlayers ||  [];

affichage();
searchfunction()

function deletePlayer(index) {
    players.splice(index, 1);
    localStorage.setItem("players", JSON.stringify(players));
    affichage();
}
//========this the function responsabel off displaying the players array and create new cards===================================================
function affichage() {

    let rowForwards = document.getElementById("rowForwards");
    let rowMidfielders = document.getElementById("rowMidfielders");
    let rowDefenders = document.getElementById("rowDefenders");
    let repDiv = document.getElementById("repContent");


    repDiv.innerHTML=""
    rowForwards.innerHTML = "";
    rowMidfielders.innerHTML = "";
    rowDefenders.innerHTML = "";

    let defendersCount = 0;
    let midfieldersCount = 0;
    let forwardsCount = 0;



    players.forEach((player, index) => {
        let divCard = document.createElement("div");
        divCard.classList.add("card");
        divCard.setAttribute("id", `card${player.id}`);


        let deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.classList.add('action-btn');
        deleteBtn.id = 'deletbtn';
        deleteBtn.textContent = 'X';
        deleteBtn.onclick = () => deletePlayer(index);

        let editBtn = document.createElement('button');
        editBtn.type = 'button';
        editBtn.classList.add('action-btn');
        editBtn.id = 'editbtn';
        editBtn.textContent = '✎';
        editBtn.onclick = () => edit_Add(index);

        let playerName = document.createElement('h3');
        playerName.classList.add('player-name');
        playerName.textContent = player.name;

        let playerPhoto = document.createElement('img');
        playerPhoto.classList.add('player-photo');
        playerPhoto.src = player.image;
        playerPhoto.alt = player.name;

        let clubLogo = document.createElement('img');
        clubLogo.classList.add('club-logo');
        clubLogo.src = player.club;
        clubLogo.alt = 'Club';

        let flagImg = document.createElement('img');
        flagImg.classList.add('flag');
        flagImg.src = player.flag;
        flagImg.alt = 'Flag';

        let positionP = document.createElement('p');
        positionP.classList.add('position');
        positionP.textContent = player.position;

        let ratingH5 = document.createElement('h5');
        ratingH5.classList.add('rating');
        ratingH5.textContent = `Rating: ${player.rating}`;

        let statsUl = document.createElement('ul');
        statsUl.classList.add('stats');

        let stats = [
            { label: 'Pace', value: player.pace },
            { label: 'Shooting', value: player.shooting },
            { label: 'Passing', value: player.passing },
            { label: 'Dribbling', value: player.dribbling },
            { label: 'Defending', value: player.defending },
            { label: 'Physical', value: player.physical }
        ];

        stats.forEach(stat => {
            let li = document.createElement('li');
            li.textContent = `${stat.label}: ${stat.value}`;
            statsUl.appendChild(li);
        });

        divCard.appendChild(deleteBtn);
        divCard.appendChild(editBtn);
        divCard.appendChild(playerName);
        divCard.appendChild(playerPhoto);
        divCard.appendChild(clubLogo);
        divCard.appendChild(flagImg);
        divCard.appendChild(positionP);
        divCard.appendChild(ratingH5);
        divCard.appendChild(statsUl);

        let array = JSON.parse(localStorage.getItem("formationArray"));
       
        switch (player.position) {
            case "CB":
            case "LB":
            case "RB":
                if (defendersCount < array[0]) {
                    rowDefenders.appendChild(divCard);
                    defendersCount++;
                }else{repDiv.appendChild(divCard)}
                break;

            case "CM":
            case "LW":
            case "RW":
                if (midfieldersCount < array[1]) {
                    rowMidfielders.appendChild(divCard);
                    midfieldersCount++;
                }else{repDiv.appendChild(divCard)}
                break;

            case "ST":
                if (forwardsCount < array[2]) {
                    rowForwards.appendChild(divCard);
                    forwardsCount++;
                }else{repDiv.appendChild(divCard)}
                break;
        }
    });

} 
function deleteGK(index){
    players.splice(index, 1);
    localStorage.setItem("players", JSON.stringify(players));
    affichage();
    let rowGoalkeeper = document.getElementById("rowGoalkeeper");
    rowGoalkeeper.innerHTML = '<div onclick="displaysgk()" class="card" id="cardgb"> </div>';
}
//==============================================================================================================================================
function displayPlayers(playersData) {
    const contentDiv = document.getElementById('content');

    playersData.forEach((player, i) => {
        const divCard = document.createElement("div");
        divCard.classList.add("card");
        divCard.setAttribute("id", `card-${i}`);
        divCard.setAttribute("onclick", `addEXCart(${i})`);

        const playerName = document.createElement('h3');
        playerName.classList.add('player-name');
        playerName.setAttribute('id', `player-name-${i}`); 
        playerName.textContent = player.playername;
        
        const playerPhotoImg = document.createElement('img');
        playerPhotoImg.classList.add('player-photo');
        playerPhotoImg.setAttribute('id', `player-photo-${i}`);
        playerPhotoImg.src = player.playerimage;
        
        const flagImg = document.createElement('img');
        flagImg.classList.add('flag');
        flagImg.setAttribute('id', `flag-${i}`); 
        flagImg.src = player.flag;
        
        const clubLogoImg = document.createElement('img');
        clubLogoImg.classList.add('club-logo');
        clubLogoImg.setAttribute('id', `club-logo-${i}`); 
        clubLogoImg.src = player.teamlogo;
        
        const positionP = document.createElement('p');
        positionP.classList.add('position');
        positionP.setAttribute('id', `position-${i}`); 
        positionP.textContent = `Position: ${player.position}`;
        
        const statsUl = document.createElement('ul');
        statsUl.classList.add('stats');
        statsUl.setAttribute('id', `stats-${i}`); 
        
        const statsList = [
            { label: 'PAC', value: player.pac },
            { label: 'SHO', value: player.sho },
            { label: 'DEF', value: player.def },
            { label: 'PAS', value: player.pas },
            { label: 'DRI', value: player.dri },
            { label: 'PHY', value: player.phy },
        ];
        
        statsList.forEach(stat => {
            const li = document.createElement('li');
            li.setAttribute('id', `stat-${i}-${stat.label.toLowerCase()}`); 
            li.textContent = `${stat.label}: ${stat.value}`;
            statsUl.appendChild(li);
        });
        

        divCard.appendChild(playerName);
        divCard.appendChild(playerPhotoImg);
        divCard.appendChild(flagImg);
        divCard.appendChild(clubLogoImg);
        divCard.appendChild(positionP);
        divCard.appendChild(statsUl);

        contentDiv.appendChild(divCard);
    });
}

// =============================================================================================================================================

function addEXCart(i) {
    const player = {
        id: players.length,
        image: document.getElementById(`player-photo-${i}`).src,
        name: document.getElementById(`player-name-${i}`).textContent,
        club: document.getElementById(`club-logo-${i}`).src, 
        position: document.getElementById(`position-${i}`).textContent, 
        flag: document.getElementById(`flag-${i}`).src,
        pac: document.getElementById(`stat-${i}-pac`).textContent, 
        sho: document.getElementById(`stat-${i}-sho`).textContent, 
        pas: document.getElementById(`stat-${i}-pas`).textContent, 
        dri: document.getElementById(`stat-${i}-dri`).textContent, 
        def: document.getElementById(`stat-${i}-def`).textContent, 
        phy: document.getElementById(`stat-${i}-phy`).textContent, 
    };

    players.push(player);    
    localStorage.setItem("players", JSON.stringify(players));

    affichage();
}
// ==========search functionn===================================================================================================================
function searchfunction() {
    const apiUrl = 'http://localhost/dash_board_Admin/api.php';
    const searchInput = document.getElementById("searchInput").value.trim().toLowerCase();
    const content = document.getElementById("content");
    content.innerHTML = "";

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            let filteredPlayers;
            if (searchInput === "") {
                filteredPlayers = data;
            } else {
                filteredPlayers = data.filter(player =>
                    player.playername.toLowerCase().includes(searchInput)
                );
            }

            if (filteredPlayers.length === 0) {
                content.innerHTML = "<p>No players found</p>";
            } else {
                displayPlayers(filteredPlayers);
            }
        })
        .catch(error => {
            console.error("Error fetching players:", error);
        });

}
// =============================================================================================================================================
function formation() {


    let formation = document.getElementById("formationSelect").value;

    let formationArray = formation.split("-").map(Number);
   
    localStorage.setItem("formationArray", JSON.stringify(formationArray));

    let array = JSON.parse(localStorage.getItem("formationArray"));

    affichage()
    
}

// ================================================================================================================================================================================================