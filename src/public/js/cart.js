$("#payBtn").click(function(){
    if ($("#payDiv").hasClass('d-none')){
        $("#payDiv").removeClass("d-none");
    }else{
        $("#payDiv").addClass("d-none");
    }
    
});
$("#btnPay").click(function(){
    $.get('pay.php');
    $("#paySuccess").removeClass("d-none");
    $("#globalContainer").addClass("d-none");

});