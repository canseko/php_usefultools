<?php
include 'includes/includes.php';

$filename = "csvs/oaxaca_2022-02-17.csv";

if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        
        $obj = new dbForm('oaxaca');
        $fields = $obj->postArray();
        $fields["np"]               = $data[0];
        $fields["program"]          = $data[1];
        $fields["name"]             = $data[2];
        $fields["state"]            = $data[3];
        $fields["municipality"]     = $data[4];
        $fields["neighborhood"]     = $data[5];
        $fields["address"]          = $data[6];
        $fields["latitude"]         = $data[7];
        $fields["longitude"]        = $data[8];
        
        $obj->add($fields); 
    }
    echo "Done.";
}   