<?php
require_once "../library/dompdf/autoload.inc.php";

use Dompdf\Dompdf;
use Dompdf\Options;


$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);
$html = $data['content'];


$dompdf->loadHtml($html);


$dompdf->setPaper('A4', 'portrait');


$dompdf->render();


if (ob_get_length()) {
    ob_end_clean();
}


header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Nota de StepbroNotes :3"');


echo $dompdf->output();
exit;
