<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function e($str)
{
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

function format_date_id($date)
{
    if (!$date) return '-';
    return date('d M Y', strtotime($date));
}

function format_datetime_id($date)
{
    if (!$date) return '-';
    return date('d M Y H:i', strtotime($date));
}

function format_money($amount, $decimals = 2)
{
    return number_format((float)$amount, $decimals, '.', ',');
}

function movement_type_label($type)
{
    $map = [
        'OPENING' => 'Opening',
        'IN' => 'Stock In',
        'OUT' => 'Stock Out',
        'SHIP' => 'Shipment',
        'ADJUSTMENT' => 'Adjustment',
    ];
    return isset($map[$type]) ? $map[$type] : $type;
}
