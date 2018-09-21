<?php

    $API_KEY        = "";

    $SPREADSHEET_ID = "11BCnspCt2Mut3nhc4WMY6CYTd0zF9C3eCzsk1AEpKLM";
    $SHEET_ID       = "sales";
    $START_CELL     = "A1";
    $END_CELL       = "E6";

    $URL = "https://sheets.googleapis.com/v4/spreadsheets/";
    $URL .= $SPREADSHEET_ID . "/values/" . $SHEET_ID . "!" . $START_CELL . ":" . $END_CELL;
    $URL .= "?key=" . $API_KEY;

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $URL);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $result = json_decode($response, true);

    if (isset($result["values"])) {
        foreach ($result["values"] as $row) {
            foreach ($row as $val) {
                echo "'" . $val . "',";
            }
            echo "\n";
        }
    }

    curl_close($curl);
