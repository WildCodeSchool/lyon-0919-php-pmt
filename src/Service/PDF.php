<?php

namespace App\Service;

use Spipu\Html2Pdf\Html2Pdf;

class PDF
{
    private $orientation;
    private $format;
    private $lang;
    private $unicode;
    private $encoding;
    private $margin;


    public function __construct(
        $orientation = null,
        $format = null,
        $lang = null,
        $unicode = null,
        $encoding = null,
        $margin = null
    ) {
        $this->orientation = $orientation;
        $this->format = $format;
        $this->lang = $lang;
        $this->unicode = $unicode;
        $this->encoding = $encoding;
        $this->margin = $margin;
    }

//    public function create()
//    {
//
//
//        $this->pdf = new PDF(
//            $orientation ? $orientation : $this->orientation,
//            $format ? $format : $this->format,
//            $lang ? $lang : $this->lang,
//            $unicode ? $unicode : $this->unicode,
//            $encoding ? $encoding : $this->encoding,
//            $margin ? $margin : $this->margin,
//        );
//    }

    public function generatePdf($template)
    {
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($template);
        $html2pdf->output();
    }
}
