<?php

function error_message($attribute, $error = "required")
{
    switch ($error) {
        case "required":
            return "Mohon mengisi $attribute Anda.";
        case "valid":
            return "Mohon mengisi $attribute yang valid.";
        default:
            return ucfirst($attribute) . " tidak valid.";
    }
}
