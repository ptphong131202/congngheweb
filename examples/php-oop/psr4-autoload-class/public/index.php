<?php

require_once "../bootstrap.php";

$point54 = new \App\CT275\Labs\Point2D(5, 4);
echo "<h1>Point: x=5, y=4</h1>";
echo "<h2>Info: " . $point54 . "</h2>";
echo "<h2>Distance from origin: " . $point54->distance() . "</h2>";
