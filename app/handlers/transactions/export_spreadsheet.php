<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$dir_spreadsheet_path = "../public/exports/spreadsheet/";

if (isset($_POST['action']) || isset($_GET['action'])) {
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
                $filepath = $dir_spreadsheet_path . $filename;

                // save to disk
                $writer = new Xlsx($spreadsheet);
                $writer->save($filepath);

                $alert = ['success', ['Sukses, untuk mendownload ke lokal komputer, cek di bagian download history!']];
            }
        } else {
            $alert = ['danger', $errors];
        }
    } else if ($_GET['action'] === 'download') {
        $file = htmlspecialchars($_GET['file']);

        if (file_exists($dir_spreadsheet_path . $file)) {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $file . '"');

            readfile($dir_spreadsheet_path . $file);
        }
    } else if ($_GET['action'] === 'remove') {
        $file = htmlspecialchars($_GET['file']);

        if (file_exists($dir_spreadsheet_path . $file)) {
            unlink($dir_spreadsheet_path . $file);

            $alert = ['success', ['Export file deleted!']];
        }
    }
}

$listSpreadsheets = [];

if (is_dir($dir_spreadsheet_path)) {
    if ($dh = opendir($dir_spreadsheet_path)) {
        $exceptContent = ['.', '..', '.gitkeep'];
        while (($file = readdir($dh)) !== false) {
            if (in_array($file, $exceptContent)) {
                continue;
            }

            $arrFilename = explode("_", $file);

            $created_at = $arrFilename[0];
            $created_at = date_create_from_format("Ymdhis", $created_at)->format("Y-m-d h:i:s");

            $fileType = strtolower($arrFilename[1]);
            $fileOwner = strtolower(explode(".", $arrFilename[3])[0]);

            if ($where === $fileType && $user['username'] === $fileOwner) {
                array_push($listSpreadsheets, [
                    "filename" => $file,
                    "exported_at" => $created_at,
                ]);
            }
        }

        closedir($dh);
    }
}
