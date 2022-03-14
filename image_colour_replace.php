<?php

function imageColourReplace($filename, $imageColour = "indigo", $borderColour = "black")
{
    $imageBlob = file_get_contents($filename);

    // Create a new imagick object
    $imagick = new Imagick();
    $imagick->readimageblob($imageBlob);

    // Set background color
    // $imagick->setImageBackgroundColor('yellow');

    // Colorize the image
    $imagick->colorizeImage($imageColour, 1, true);

    // Set the border in the given image
    $imagick->borderImage($borderColour, 100, 100);

    //Resize image
    // $imagick->adaptiveResizeImage($width, $height);

    // Set the ImageAlphaChannel to 9 which corresponds
    // to imagick::ALPHACHANNEL_TRANSPARENT
    $imagick->setImageAlphaChannel(9);

    // Display the image
    header("Content-Type: image/png");
    echo $imagick->getImageBlob();
}

imageColourReplace('a.jpg');