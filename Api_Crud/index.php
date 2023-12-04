<?php
// Este programa é para execução do Api_Consultas

include 'LembretesService.php';
include "LoginService.php";
require_once "LembretesService.php";
require_once "LoginServece.php";



//Colocando o cabecalho para retornar os dados em formado json na saida

header("Content-Type: application/json; charset=UTF-8;");
header("Access-Control-Allow-Origin: *");  // Necessário para a mesma máquina (localhost)  

header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control: no-cache, no-store, must-revalidate");
//header("Access-Control-Allow-Headers: *");
// header("Access-Control-Max-Age: 86400");




if ($_GET['url']) {


    $url = explode('/', $_GET['url']);



    if ($url[0] === 'api') {
        // Removendo a primeira posição do registro e retorna o resto (neste caso api)          
        array_shift($url);


        $service = ucfirst($url[0]) . 'Service';


        array_shift($url); //neste caso $url ficar como um vetor vazio



        $method = strtolower($_SERVER['REQUEST_METHOD']); // metodo get ou post (minusculo)  


        //Trazer os dados do BD
        try {
            // chamando o metodo call_user_func_array(..) para buscar os dados
            $response =  call_user_func_array(array(new  $service, $method), $url);

            http_response_code(200); // ok
            //convertendo o resultado em json e mostrando os dados;
            echo json_encode(array('status' => 'sucess', 'data' => $response));
        } catch (Exception $e) {
            http_response_code(404); // erro
            //mostrando a mensagem de erro (não encontrado);
            echo json_encode(array('status' => 'error', 'data' => $e->getMessage()));
        }
    }
}
