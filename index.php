<?php

/*
 * Description: Dynamic TeamSpeak 3 server Banner Image
 * displaying the current client count and server time.
 * Author: Your Gihan Harindra
 * GitHub Link: https://github.com/GihanIT
 * License: MIT License
 */

 /*
 * MIT License
 * Copyright (c) 2025 Gihan Harindra
 * See LICENSE file for full license text.
 */

// 1. Include the TeamSpeak 3 PHP Framework
require_once("vendor/planetteamspeak/ts3-php-framework/libraries/TeamSpeak3/TeamSpeak3.php"); // Adjust the path if necessary

// 2. Configuration
$ts3_server_address   = "your_teamspeak_server_address"; // e.g., "ts3.yourdomain.com"
$ts3_server_port      = 9987;                         // Default TeamSpeak port
$ts3_query_username   = "serveradmin";             // Your server query username
$ts3_query_password   = "your_server_query_password"; // Your server query password
$ts3_server_port_query = 10011;                       //added query port
$ts3_bots = 0; //number of bots default is 0

// 3. Banner Image and Text Settings
header("Content-type: image/png");
$banner = imagecreatefrompng("assets/images/Banner.png"); // Background image
$color  = imagecolorallocate($banner, 255, 255, 255);    // Color of the text (white)
$font   = 'assets/font/sourcesans.ttf';                   // Font

try {
    // 4. Connect to the TeamSpeak 3 Server and Get Client Count
    TeamSpeak3::init();
    $ts3 = TeamSpeak3::factory("serverquery://{$ts3_query_username}:{$ts3_query_password}@{$ts3_server_address}:{$ts3_server_port_query}/?server_port={$ts3_server_port}");

    $total_clients = $ts3->virtualserver_clientsonline - $ts3->virtualserver_queryclientsonline - $ts3_bots;
    $ts3clients = "" . $total_clients;

    // 5. Display Real-Time Clock
    date_default_timezone_set('Asia/Colombo');
    $realtime = date('H:i');

    $text_box = imagettfbbox(32, 0, $font, $realtime);
    $text_width = $text_box[2] - $text_box[0];
    $image_width = imagesx($banner);
    $x_position = ($image_width - $text_width) / 2;
    $y_position = 234;

    imagettftext($banner, 32, 0, 744, 234, $color, $font, $realtime);

    // 6. Display Client Count
    imagettftext($banner, 32, 0, 465, 234, $color, $font, $ts3clients .' / 200 '); //replace 200 with your actual slots

    // 7. Output the image
    imagepng($banner);

} catch (TeamSpeak3_Exception $e) {
    // 8. Handle Errors
    error_log("TeamSpeak3 Error: " . $e->getMessage());
    $error_message = "TS3 Error: " . $e->getMessage();
    imagettftext($banner, 20, 0, 465, 234, $color, $font, $error_message);
    imagepng($banner);
} finally {
    // 9. Clean up
    if (isset($banner)) {
        imagedestroy($banner);
    }
}
?>
