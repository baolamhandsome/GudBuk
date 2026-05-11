<?php
// utilities function replace for the .js part
function isGet()
{
    return ($_SERVER['REQUEST_METHOD'] == 'GET');
}
function isPost()
{
    return ($_SERVER['REQUEST_METHOD'] == 'POST');
}

function redirect($path)
{
    header("Location: $path");
}

function request($success, $message)
{
    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);
}
