var callBackGetNom = function(data){
    console.log("donnees api", data);
    var element = document.getElementById("zone_carte");
    element.innerHTML = "description de la carte :"+data.data[0].desc;
    // alert("description :" + data.desc)
}


function buttonClickGET(){
    var queryLoc = document.getElementById("queryLoc").value;
    var url="https://db.ygoprodeck.com/api/v7/cardinfo.php?name="+queryLoc

    $.get(url, callBackGetNom).done(function(){
        //alert("second success");
    })
    .fail(function(){
        alert("error");
    })
    .always(function(){
        //alert("finished");
    });
}



var callBackGetEdition = function(data){
    console.log("donnees api", data);
    var set = document.getElementById("zone_edition");
    set.innerHTML = "liste de carte :"+JSON.stringify(data.data);
}
function buttonEditionGET(){
    var limiteSetName = document.getElementById("limiteSetName").value;
    var url="https://db.ygoprodeck.com/api/v7/cardinfo.php?set="+limiteSetName+"&num=5&offset=0"
    $.get(url, callBackGetEdition).done(function(){
        //alert("second success");
    })
    .fail(function(){
        alert("error");
    })
    .always(function(){
        //alert("finished");
    });
}



var callBackGetRandom = function(data){
    console.log("donnees api", data);
    var aleatoire = document.getElementById("zone_random");
    aleatoire.innerHTML = "Carte aléatoire:"+data.name;
}
function buttonRandomGET(){
    var url="https://db.ygoprodeck.com/api/v7/randomcard.php"
    $.get(url, callBackGetRandom).done(function(){
        //alert("second success");
    })
    .fail(function(){
        alert("error");
    })
    .always(function(){
        //alert("finished");
    });
}
