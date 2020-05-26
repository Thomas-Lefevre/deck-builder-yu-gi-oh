var callBackGetSuccess = function(data){
    console.log("donnees api", data);
    // var element = document.getElementById("zone_meteo");
    // element.innerHTML = "info de la carte :"+data.atk
    console.log("attaque :" + JSON.stringify(data.data[0].atk) );
}


function buttonClickGET(){
    var url="https://db.ygoprodeck.com/api/v7/cardinfo.php?name=Dark%20Magician"

    $.get(url, callBackGetSuccess).done(function(){
        //alert("second success");
    })
    .fail(function(){
        alert("error");
    })
    .always(function(){
        //alert("finished");
    });
}