<?php

    header("Content-Type:application/json");

    $method = $_SERVER['REQUEST_METHOD'];
    $result = array();

    if($method == 'DELETE'){

        parse_str(file_get_contents("php://input"), $_DELETE);

        //pengecekan parameter
        if(isset($_DELETE['id'])){

            //tangkap parameter
            $id = $_DELETE['id'];

            //jika metode sesuai
            $result['status'] = [
                "code" => 200,
                "description" => '1 Data Deleted'
            ];

            //koneksi database
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shodakom";
 
            $conn = new mysqli($host, $username, $password, $dbname);

            //buat querry
            $sql = "DELETE FROM diamond_order WHERE id = '$id'";

            //eksekusi querry
            $conn ->query($sql);
            //masukkan ke array result
            $result['results'] = [
                "id" => $id
            ];
        }else{
            $result['status'] = [
                "code" => 400,
                "description" => 'Parameter Invalid'
            ];
        }
    }else{
        $result['status'] = [
            "code" => 400,
            "description" => 'Method Not Valid'
        ];
    }

    //tampilkan dalam format json
    echo json_encode($result);
?>