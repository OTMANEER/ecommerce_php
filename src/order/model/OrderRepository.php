<?php

interface OrderRepository{
    public function getOrders($userId);
    public function getOrderInfo($orderId);
}