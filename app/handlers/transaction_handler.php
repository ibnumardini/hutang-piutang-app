<?php

$query = mysqli_query($con, "SELECT * FROM transactions");

$transactions = [];

while ($row = mysqli_fetch_assoc($query)) {
    array_push($transactions, $row);
}
