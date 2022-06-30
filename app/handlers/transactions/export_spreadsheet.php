<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['action'])) {
    if ($_POST['action'] === "export_spreadsheet") {
        $start_date = htmlspecialchars($_POST['start_date']);
        $end_date = htmlspecialchars($_POST['end_date']);

        $errors = [];

        if (empty($start_date)) {
            array_push($errors, "Start date kosong!");
        }

        if (empty($end_date)) {
            array_push($errors, "End date kosong!");
        }

        if (empty($errors)) {
            $start_date = fmt_to_timestamp($start_date) . ":00";
            $end_date = fmt_to_timestamp($end_date) . ":00";

            $query = "SELECT t.id, t.type, t.user_id, t.use_for, t.person_id, t.nominal, t.temp_nominal, t.status, t.transaction_at, t.due_date, t.created_at, t.updated_at, p.name FROM transactions as t LEFT JOIN persons as p ON t.person_id = p.id WHERE t.created_at BETWEEN '$start_date' AND '$end_date' AND t.type = '$where' AND t.user_id='$session_user_id'";

            $select = mysqli_query($con, $query);

            if (mysqli_num_rows($select) < 1) {
                $alert = ['warning', ['Export gagal, data tidak di temukan!']];
            } else {
                $bucket_trx = [];
                while ($row = mysqli_fetch_assoc($select)) {
                    array_push($bucket_trx, $row);
                }

                $alphabet = range('A', 'Z');

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                foreach ($bucket_trx as $key_trx => $val) {
                    $rowRange = [];
                    foreach ($alphabet as $char_key => $char) {
                        if ($char_key === count($val)) {
                            break;
                        }

                        array_push($rowRange, $char);
                    }

                    $newRowRange = [];
                    for ($i = 0; $i < count($val); $i++) {
                        $newRowRange[] = [
                            "char" => $rowRange[$i],
                            "charKey" => array_keys($val)[$i],
                            "charVal" => array_values($val)[$i],
                        ];
                    }

                    foreach ($newRowRange as $row) {
                        $colRange = $key_trx;

                        if ($colRange === 0) {
                            $sheet->setCellValue($row["char"] . 1, $row["charKey"]);
                        }

                        /**
                         * tambah lagi agar data pertama,
                         * tidak tertimpa oleh title.
                         */
                        $newColRange = ++$colRange;

                        $sheet->setCellValue($row["char"] . ++$newColRange, $row["charVal"]);
                    }
                }

                $filename = date('Ymdhis') . "_" . uniqid(strtoupper($where) . "_") . "_" . $user['username'] . ".xlsx";
                $filepath = '../public/exports/spreadsheet/' . $filename;

                // save to disk
                $writer = new Xlsx($spreadsheet);
                $writer->save($filepath);

                // set header for redirect
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="' . $filename . '"');

                // download
                $ioWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
                $ioWriter->save('php://output');
            }
        } else {
            $alert = ['danger', $errors];
        }
    }
}
