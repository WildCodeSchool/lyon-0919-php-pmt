<?php

namespace App\Service;

use Spipu\Html2Pdf\Html2Pdf;

class PDF
{
    private $pdf;

    public function create()
    {
        $this->pdf = new PDF();
    }

    public function generatePdf($template)
    {
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($template);
        $html2pdf->output();
    }
}
