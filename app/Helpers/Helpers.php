<?php

function error_message($attribute, $error = "required")
{
    switch ($error) {
        case "required":
            $message = "Mohon mengisi $attribute Anda.";
            break;
        case "max":
            $message = ucfirst($attribute) . " yang diisi terlalu panjang.";
            break;
        case "integer":
            $message = ucfirst($attribute) . " harus angka bulat.";
            break;
        case "unique":
            $message = ucfirst($attribute) . " sudah terpakai.";
            break;
        case "lowercase":
            $message = ucfirst($attribute) . " tidak boleh ada huruf kapital.";
            break;
        case "same":
            $message = ucfirst($attribute) . " yang diisi belum sama.";
            break;
        default:
            $message = "Mohon mengisi $attribute yang valid.";
    }
    return trans($message);
}


function get_date($timestamp)
{
    return date('j F Y', strtotime($timestamp));
}

function format_price($price)
{
    $formatted_price = number_format($price, 2, ',', '.');

    return 'IDR ' . $formatted_price;
}
