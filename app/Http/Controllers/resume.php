<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Knp\Snappy\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class resume extends Controller
{
    //

    public function showResume(Request $request)
    {
        
        $data = $request->all();
        return view('resume.show_template',compact('data'));
    }   
     public function generateResume(Request $request)
    {
        
        $data = $request->data;
        $pdf = PDF::loadview('resume.template',compact('data'))
        ->setPaper('a4')
        ->setOrientation('portrait')
        ->setOption('page-width','600')
        ->setOption('margin-top','0')
        ->setOption('margin-bottom','0')
        ->setOption('margin-right','2')
        ->setOption('margin-left','2');
        
        
        return $pdf->download('resume.pdf');
        
        // return view('resume.show-template',compact('data'));
    }


}