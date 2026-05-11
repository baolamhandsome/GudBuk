<?php

function setSession($key, $token)
{
    if (!empty(session_id())) {
        $_SESSION[$key] = $token;
        return true;
    }
    return false;
}
function getSession($key)
{
    if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }
    return false;
}
function removeSession($key)
{
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
        return true;
    }
    return false;
}
