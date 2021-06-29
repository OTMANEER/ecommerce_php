function getInfo(orderID){
    $.get('info.php?orderId='+orderID,{orderId : orderID},function(data){
        dataJson = JSON.parse(data);
        let table = $("#infoTable");
        table.empty();
        table.append("<tr><td>Article</td><td>Prix</td><td>Quantité</td></tr>")
        for (let i = 0; i< dataJson.length;i++){
            table.append("<tr><td>"+dataJson[i].title+"</td><td>"+dataJson[i].price+"</td><td>"+dataJson[i].quantity+"</td></tr>");
        }
    })
}