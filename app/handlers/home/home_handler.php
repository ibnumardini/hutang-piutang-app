<?php

$trxType = ['debt', 'receivable'];

foreach ($trxType as $type) {
    $amout = 'amout' . ucwords($type);
    // $$ namanya reference variable, yaitu jadiin value untuk sebuah variable!
    $$amout = mysqli_query($con, "SELECT SUM(nominal) - SUM(temp_nominal) as nominal FROM `transactions` WHERE type = '$type' AND user_id='$session_user_id';");

    $result = 'result' . ucwords($type);
    $$result = mysqli_fetch_assoc($$amout);
}

foreach ($trxType as $type) {
    $count = 'count' . ucwords($type);
    $$count = mysqli_query($con, "SELECT * FROM `transactions` WHERE type = '$type' AND user_id='$session_user_id';");

    $resultCount = 'resultCount' . ucwords($type);
    $$resultCount = mysqli_num_rows($$count);
}

foreach ($trxType as $type) {
    $mostFreq = 'mostFreq' . ucwords($type);
    $$mostFreq = mysqli_query($con, "SELECT t.person_id, p.name FROM `transactions` as t LEFT JOIN persons as p ON t.person_id = p.id WHERE t.type = '$type' AND t.user_id = '$session_user_id';");

    $resultMostFreq = 'resultMostFreq' . ucwords($type);
    $$resultMostFreq = [];

    while ($row = mysqli_fetch_assoc($$mostFreq)) {
        array_push($$resultMostFreq, $row);
    }

    $names = 'names' . ucwords($type);
    $$names = [];

    foreach ($$resultMostFreq as $val) {
        array_push($$names, $val['name']);
    }

    $namesCount = 'namesCount' . ucwords($type);
    $$namesCount = array_flip(array_count_values($$names));
    arsort($$namesCount);

    $namesValue = 'namesValue' . ucwords($type);
    $$namesValue = array_values($$namesCount);
}
