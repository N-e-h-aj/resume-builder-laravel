<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
// use Knp\Snappy\Pdf;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use mpdfform;

class resume extends Controller
{
    //

    public function showResume(Request $request)
    {

        $data = $request->all();
        return view('resume.show_template', compact('data'));
    }
    public function generateResume(Request $request)
    {
        $data = $request->data;
try {
        $mpdf = new Mpdf();

        $html = view('resume.template', compact('data'))->render();
        $mpdf->WriteHTML($html);

        $filePath = 'pdfs/document.pdf';
        $directoryPath = storage_path('app/pdfs');

        // Ensure the directory exists using PHP's mkdir function
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        $fullPath = $directoryPath . '/document.pdf';

        // Output PDF to file
        $mpdf->Output($fullPath, \Mpdf\Output\Destination::FILE);

        // Return the file as a download response
        return response()->download($fullPath, 'document.pdf');

    } catch (\Mpdf\MpdfException $e) {
        return response()->json(['error' => 'PDF generation failed: ' . $e->getMessage()], 500);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
    }
        }


}