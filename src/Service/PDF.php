<?php

namespace App\Service;

use Spipu\Html2Pdf\Html2Pdf;

class PDF
{
    private $pdf;


    public function create()
    {
//        $orientation = null,
//        $format = null,
//        $lang = null,
//        $unicode = null,
//        $encoding = null,
//        $margin = null
//    ) {
        $this->pdf = new PDF();
//            $orientation ? $orientation : $this->orientation,
//            $format ? $format : $this->format,
//            $lang ? $lang : $this->lang,
//            $unicode ? $unicode : $this->unicode,
//            $encoding ? $encoding : $this->encoding,
//            $margin ? $margin : $this->margin,
//        );

    }

    public function generatePdf($template)
    {
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($template);
        $html2pdf->output();
    }
}
