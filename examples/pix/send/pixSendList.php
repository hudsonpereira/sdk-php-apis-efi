<?php

/**
 * Detailed endpoint documentation
 * https://dev.efipay.com.br/docs/api-pix/gestao-de-pix#consultar-lista-de-pix-enviados
 */

$autoload = realpath(__DIR__ . "/../../../vendor/autoload.php");
if (!file_exists($autoload)) {
    die("Autoload file not found or on path <code>$autoload</code>.");
}
require_once $autoload;

use Efi\Exception\EfiException;
use Efi\EfiPay;

$options = __DIR__ . "/../../credentials/options.php";
if (!file_exists($options)) {
	die("Options file not found or on path <code>$options</code>.");
}
require $options;

$params = [
	"inicio" => "2023-01-22T00:00:00Z",
	"fim" => "2024-12-31T23:59:59Z",
	// "status" => "REALIZADO", // "EM_PROCESSAMENTO", "REALIZADO", "NAO_REALIZADO"
	// "devolucaoPresente" => true,
	// "paginacao.paginaAtual" => 1,
	// "paginacao.itensPorPagina" => 10
];

try {
	$api = new EfiPay($options);
	$response = $api->pixSendList($params);

	print_r("<pre>" . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</pre>");
} catch (EfiException $e) {
	print_r($e->code . "<br>");
	print_r($e->error . "<br>");
	print_r($e->errorDescription) . "<br>";
} catch (Exception $e) {
	print_r($e->getMessage());
}
