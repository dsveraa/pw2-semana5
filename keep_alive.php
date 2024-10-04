<?php
session_start();
session_regenerate_id(true);
echo json_encode(["status" => "success"]);
?>
