<?php

namespace Snono\ReportBuilder\Builder\Classes;

use Snono\ReportBuilder\Dompdf;
use Snono\ReportBuilder\Options;
use Illuminate\Support\Facades\View;

/**
 * This is the PDF class.
 *
 * @author Yaser Ghanawi
 */
class PDF
{
    /**
     * Generate the PDF.
     *
     * @method generate
     *
     * @param ConsoleTVs\Invoices\Classes\ReportBuilder $report
     * @param string                              $template
     *
     * @return Dompdf\Dompdf
     */
    public static function generate(ReportBuilder $report, $template = 'invoice')
    {
        $template = strtolower($template);

        $options = new Options();

        $options->set('isRemoteEnabled', true);
        $options->set('language', $report->getLanguage());
        $options->set('defaultPaperOrientation', $report->getOrientation());  // portrait or landscape

        $pdf = new Dompdf($options);

        $context = stream_context_create([
            'ssl' => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
                'allow_self_signed'=> true,
            ],
        ]);

        $pdf->setHttpContext($context);

        $pdf->loadHtml(View::make('report-builder::'.$template, ['config' => $report]));

        $pdf->render();

        return $pdf;
    }
}
