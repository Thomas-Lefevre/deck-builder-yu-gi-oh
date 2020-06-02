var callBackGetNom = function (data) {
    console.log("donnees api", data);
    // var element = document.getElementById("zone_carte");
    // element.innerHTML = "description de la carte :" + data.data[0].desc;
    insertCard(data.data[0])
    // alert("description :" + data.desc)
}


function buttonClickGET() {
    var queryLoc = document.getElementById("queryLoc").value;
    var url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?name=" + queryLoc

    $.get(url, callBackGetNom).fail(function () {
        alert("error");
    })
}



var callBackGetEdition = function (data) {
    console.log("donnees api", data);
    var set = document.getElementById("zone_edition");
    set.innerHTML = "liste de carte :" + JSON.stringify(data.data);
    insertCardMultiple(data.data);
    
}
function buttonEditionGET() {
    var limiteSetName = document.getElementById("limiteSetName").value;
    var url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?set=" + limiteSetName + "&num=15&offset=25"
    $.get(url, callBackGetEdition).fail(function () {
        alert("error");
    })
    
}



var callBackGetRandom = function (data) {
    console.log("donnees api", data);
    var aleatoire = document.getElementById("zone_random");
    aleatoire.innerHTML = "Carte aléatoire:" + data.name;
    insertCard(data)
}
function buttonRandomGET() {
    var url = "https://db.ygoprodeck.com/api/v7/randomcard.php"
    $.get(url, callBackGetRandom).fail(function () {
        alert("error");
    })
}



var callBackGetLevel = function (data) {
    console.log("donnees api", data);
    var level = document.getElementById("zone_level");
    level.innerHTML = "Carte EAU de niveau 4 trier par attaque:" + JSON.stringify(data.data);
    insertCardMultiple(data.data);
}
function buttonLevelGET() {
    var url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?level=4&attribute=water&sort=atk&num=5&offset=0"
    $.get(url, callBackGetLevel).fail(function () {
        alert("error");
    })
}



var callBackGetBan = function (data) {
    console.log("donnees api", data);
    var Ban = document.getElementById("zone_ban");
    Ban.innerHTML = "Carte bannies de niveau 4:" + JSON.stringify(data.data);
}
function buttonBanGET() {
    var url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?banlist=tcg&level=4&sort=name&num=5&offset=0"
    $.get(url, callBackGetBan).fail(function () {
        alert("error");
    })
}



var callBackGetFormat = function (data) {
    console.log("donnees api", data);
    var Format = document.getElementById("zone_format");
    Format.innerHTML = "Format speed duel:" + JSON.stringify(data.data);
}
function buttonFormatGET() {
    var url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?format=Speed Duel&num=5&offset=0"
    $.get(url, callBackGetFormat).fail(function () {
        alert("error");
    })
}




var callBackGetFleche = function (data) {
    console.log("donnees api", data);
    var fleche = document.getElementById("zone_fleche");
    fleche.innerHTML = "Monstre lien EAU avec un flèche en haut et a droite:" + JSON.stringify(data.data);
}
function buttonFlecheGET() {
    var url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?attribute=water&type=Link%20Monster&linkmarker=top,bottom&num=5&offset=0"
    $.get(url, callBackGetFleche).fail(function () {
        alert("error");
    })
}




var callBackGetStaple = function (data) {
    console.log("donnees api", data);
    var staple = document.getElementById("zone_staple");
    staple.innerHTML = "Carte staples:" + JSON.stringify(data.data);
}
function buttonStapleGET() {
    var url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?staple=yes&num=5&offset=0"
    $.get(url, callBackGetStaple).fail(function () {
        alert("error");
    })
}



var callBackGetWizard = function (data) {
    console.log("donnees api", data);
    var wizard = document.getElementById("zone_wizard");
    wizard.innerHTML = "Carte avec \"wizard\" dans leurs nom, qui sont d'atribut lumière et qui sont magicien:" + JSON.stringify(data.data);
}
function buttonWizardGET() {
    var url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?fname=Wizard&attribute=light&race=spellcaster&num=5&offset=0"
    $.get(url, callBackGetWizard).fail(function () {
        alert("error");
    })
}



var callBackGetFiltre = function (data) {
    console.log("donnees api", data);
    var filtre = document.getElementById("zone_filtre");
    filtre.innerHTML = "Carte avec \"wizard\" dans leurs nom, qui sont d'atribut lumière et qui sont magicien:" + JSON.stringify(data.data);
}
function buttonFiltreGET() {
    var filtreLimit = document.getElementById("filtreLimit").value;
    var url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?fname=Wizard"+filtreLimit+"&race=spellcaster&num=5&offset=0"
    $.get(url, callBackGetFiltre).fail(function () {
        alert("error");
    })
}


//*************************************** AJAX **************************************************/

function insertCard(payload) {
    console.log(payload);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        crossOrigin: true,

        url: 'http://localhost/deckbuilder_yugioh/public/insertCard',
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json',

        },
        data: JSON.stringify(payload),
        success: function (data) {
            window.location = data.redirect;
        },
        error: function (data) {
            console.log('status', data);
        }
    });
}

function insertCardMultiple(payload) {
    console.log(payload);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        crossOrigin: true,

        url: 'http://localhost/deckbuilder_yugioh/public/insertCardMultiple',
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json',

        },
        data: JSON.stringify(payload),
        success: function (data) {
            console.log('success', data);
        },
        error: function (data) {
            console.log('status', data);
        }
    });
}