<?php

$trxType = ['debt', 'receivable'];

foreach ($trxType as $type) {
    $amout = 'amout' . ucwords($type);
    // $$ namanya reference variable, yaitu jadiin value untuk sebuah variable!
    $$amout = mysqli_query($con, "SELECT SUM(nominal) - SUM(temp_nominal) as nominal FROM `transactions` WHERE type = '$type' AND user_id='$session_user_id';");

    $result = 'result' . ucwords($type);
    $$result = mysqli_fetch_assoc($$amout);
}
