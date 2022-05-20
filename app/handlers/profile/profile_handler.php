<?php

$page = "Profile";

$query = mysqli_query($con, "SELECT * FROM users WHERE id = '$session_user_id'");
$user = mysqli_fetch_assoc($query);
