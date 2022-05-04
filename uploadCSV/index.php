<?php
include 'includes/includes.php';

$filename = "csvs/2021-12-07_directorio_nacional.csv";

if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        
        $obj = new dbForm('centros_acopio');
        $fields = $obj->postArray();
        $fields["estado"] = $data[0];
        $fields["municipio"] = $data[1];
        $fields["razon_social"] = $data[2];
        $fields["nota"] = $data[3];
        $fields["direccion"] = $data[4];
        $fields["referencia"] = $data[5];
        $fields["latitud"] = $data[6];
        $fields["longitud"] = $data[7];
        $fields["horario"] = $data[8];
        $fields["telefono"] = str_replace("\n","<br>",$data[9]);
        $fields["web"] = $data[10];
        $fields["redes_sociales"] = $data[11];
        $fields["email"] = str_replace("\n","<br>",$data[12]);
        
        
        
        $obj->add($fields); 

        $id_centros_acopio = $obj->get_var("SELECT id FROM centros_acopio ORDER BY id DESC LIMIT 1");
        for($i = 13; $i <= 36; $i++){
            if($data[$i] != ""){
                //Se resta quince para obtener el valor del id_material
                $id_materiales = $i - 12;
                $info = $data[$i];
                $query = "INSERT INTO centros_acopio_materiales (id_centros_acopio, id_materiales) VALUES ($id_centros_acopio, $id_materiales)";
                $obj->query($query);
                
            }
        }
    }
    echo "Done.";
}