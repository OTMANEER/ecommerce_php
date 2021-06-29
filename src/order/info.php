<?php

  require_once './model/DatabaseOrderRepository.php';
  $orderRepository = new DatabaseOrderRepository();

  if (isset($_GET['orderId'])){
      $info =  $orderRepository->getOrderInfo($_GET['orderId']);
      $jsonInfo = json_encode($info);
      echo $jsonInfo; 
  }