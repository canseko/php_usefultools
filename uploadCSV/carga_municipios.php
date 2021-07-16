<?php
include 'includes/includes.php';

$filename = "csvs/municipios/32_zacatecas.csv";
$i = 0;
if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if($i > 0){
            $obj = new dbForm('municipalities');
            $fields = $obj->postArray();
            $fields["state_id"] = $data[0];
            $fields["municipality_key"] =  str_pad($data[1], 3, '0', STR_PAD_LEFT);
            $fields["name"] = $data[2];
            
            $obj->add($fields); 

            
        }
        $i++;
    }
    echo "Done.";
}