var callBackGetSuccess = function(data){
    console.log("donnees api", data);
    var element = document.getElementById("zone_carte");
    element.innerHTML = "description de la carte :"+data.data[0].desc;
    // alert("description :" + data.desc)
}


function buttonClickGET(){
    var queryLoc = document.getElementById("queryLoc").value;
    var url="https://db.ygoprodeck.com/api/v7/cardinfo.php?name="+queryLoc

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