<?php
include 'includes/includes.php';

$filename = "csvs/2021-07-13_directorio_nacional.csv";

if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        
        $obj = new dbForm('centros_acopio');
        $fields = $obj->postArray();
        $fields["estado"] = $data[0];
        $fields["municipio"] = $data[1];
        $fields["razon_social"] = $data[2];
        $fields["direccion"] = $data[3];
        // $fields["mapa"] = $data[4];
        $fields["latitud"] = $data[4];
        $fields["longitud"] = $data[5];
        $fields["horario"] = $data[6];
        $fields["telefono"] = str_replace("\n","<br>",$data[7]);
        $fields["web"] = $data[8];
        $fields["redes_sociales"] = $data[9];
        $fields["email"] = str_replace("\n","<br>",$data[10]);
        
        
        
        $obj->add($fields); 

        $id_centros_acopio = $obj->get_var("SELECT id FROM centros_acopio ORDER BY id DESC LIMIT 1");
        for($i = 11; $i <= 20; $i++){
            if($data[$i] != ""){
                //Se resta quince para obtener el valor del id_material
                $id_materiales = $i - 10;
                $info = $data[$i];
                $query = "INSERT INTO centros_acopio_materiales (id_centros_acopio, id_materiales) VALUES ($id_centros_acopio, $id_materiales)";
                $obj->query($query);
                
            }
        }
    }
    echo "Done.";
}