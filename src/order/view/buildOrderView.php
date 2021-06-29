<?php

function buildOrderView($orders){
    if (count($orders)> 0){
    $renduHtml = <<<HTML
        <div id="container">
            <table>
                <tr>
                    <td>Date</td>
                    <td>Total Payé </td>
                </tr>
    HTML;
    foreach($orders as $order){
        $date = $order->date;
        $total = $order->total;
        $id = $order->id;
        $renduHtml = $renduHtml. <<<HTML
            <tr>
                <td>$date</td>
                <td>$total <button class="btn btn-success mybtn" onclick="getInfo($id)">+</button></td>

            </tr>
        HTML;
    }
    $renduHtml = $renduHtml.<<<HTML
            </table>
        </div> <!-- On ferme le div container-->
        <div id="infos">
            <table id="infoTable">

            </table>
        </div>
    HTML;
    }else{
        $renduHtml = "<h3>Vous n'avez encore jamais commandé</h3>";
    }



    return $renduHtml;

}
