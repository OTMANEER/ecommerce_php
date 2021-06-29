

console.log("javascript working!");

$("#plus").click(function(){
    if ($("#plus").text() == "Plus de filtres"){
        $("#plus").text("Moins de filtres");
        $("#moreFilter").show();
        $("#plus").removeClass("btn btn-success").addClass("btn btn-danger");
    }else{
        $("#plus").text("Plus de filtres");
        $("#moreFilter").hide();
        $("#plus").removeClass("btn btn-danger").addClass("btn btn-success");
    }
});



function addCart(idArticle,titleArticle,priceArticle){
    $.post('.',{articleID:idArticle,articleTitle:titleArticle,articlePrice:priceArticle});
    let currentNum = parseInt($("#cartNum").text(),10);
    currentNum = currentNum+1;
    $("#cartNum").text(currentNum.toString());
};