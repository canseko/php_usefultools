<?php
include 'includes/includes.php';

$filename = "csvs/acopiadores.csv";

if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        
        $obj = new dbForm('centros_acopio');
        $fields = $obj->postArray();
        $fields["estado"] = $data[0];
        $fields["municipio"] = $data[1];
        $fields["razon_social"] = $data[2];
        $fields["permiso"] = $data[3];
        $fields["observaciones"] = $data[4];
        $fields["encargado"] = $data[5];
        $fields["direccion"] = $data[6];
        $fields["codigo_postal"] = $data[7];
        $fields["referencias"] = $data[8];
        $fields["horario"] = $data[9];
        $fields["telefono"] = $data[10];
        $fields["web"] = $data[11];
        $fields["email"] = $data[12];
        $fields["mapa"] = $data[13];
        $fields["longitud"] = $data[14];
        $fields["latitud"] = $data[15];
        
        $obj->add($fields); 

        $id_centros_acopio = $obj->get_var("SELECT id FROM centros_acopio ORDER BY id DESC LIMIT 1");
        for($i = 16; $i <= 32; $i++){
            if($data[$i] != ""){
                //Se resta quince para obtener el valor del id_material
                $id_materiales = $i - 15;
                $query = "INSERT INTO centros_acopio_materiales (id_centros_acopio, id_materiales) VALUES ($id_centros_acopio, $id_materiales)";
                $obj->query($query);
                
            }
        }
    }
    echo "Done.";
}