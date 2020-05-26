var callBackGetSuccess = function(data){
    console.log("donnees api", data);
<<<<<<< HEAD
    // var element = document.getElementById("zone_meteo");
    // element.innerHTML = "info de la carte :"+data.atk
    console.log("attaque :" + JSON.stringify(data.data[0].atk) );
=======
    var element = document.getElementById("zone_carte");
    element.innerHTML = "description de la carte :"+data.data[0].desc;
    // alert("description :" + data.desc)
>>>>>>> 22767d18aaf0dc651c47019fca7023a7cc8701a1
}


function buttonClickGET(){
<<<<<<< HEAD
    var url="https://db.ygoprodeck.com/api/v7/cardinfo.php?name=Dark%20Magician"
=======
    var queryLoc = document.getElementById("queryLoc").value;
    var url="https://db.ygoprodeck.com/api/v7/cardinfo.php?name="+queryLoc
>>>>>>> 22767d18aaf0dc651c47019fca7023a7cc8701a1

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