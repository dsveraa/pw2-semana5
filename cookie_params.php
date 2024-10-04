<?php

session_set_cookie_params([
    'lifetime' => 3600, 
    'secure' => true, 
    'httponly' => true, 
    'samesite' => 'Strict' 
]);
