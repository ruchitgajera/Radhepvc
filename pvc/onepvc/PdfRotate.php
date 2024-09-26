<?php

namespace CzProject\PdfRotate;

use setasign\Fpdi\Fpdi;

class PdfRotate
{
    const DEGREES_0 = 0;
    const DEGREES_90 = 90;
    const DEGREES_180 = 180;
    const DEGREES_270 = 270;

    /**
     * @param  string $sourceFile
     * @param  string $outputFile
     * @param  int $degrees
     * @return void
     */
    public function rotatePdf($sourceFile, $outputFile, $degrees)
    {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($sourceFile); // the original file

        for ($i = 1; $i <= $pageCount; $i++) {
            $tpage = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($tpage);
            $orientation = ($size['width'] > $size['height'] ? 'L' : 'P');

            $pdf->AddPage($orientation, [$size['width'], $size['height']], $degrees);
            $pdf->useTemplate($tpage);
        }

        $pdf->Output($outputFile, "F");
    }
}
