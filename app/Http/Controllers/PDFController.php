<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;



class PDFController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function createPDF(Request $request)
    {
        // set certificate file
        //$certificate = 'file://'.base_path().'/public/tcpdf.crt';
        
        //$certificate = 'file://'. realpath($mypath);  
        $destinationPath = 'digsig';
        $certificate= public_path($destinationPath). 'tcpdf.crt';
        /***
        ###Move Uploaded File to public folder
        $destinationPath = 'digsig';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);
      **/
       
        //$certificate = 'file://' . realpath('/var/www/xx/xx/cert/3ecs_sign.crt');


        // set additional information in the signature
        $info = array(
            'Name' => 'PhotoBooth',
            'Location' => 'Office',
            'Reason' => 'photobooth',
            'ContactInfo' => 'https://photo.lumin.institute',
        );

        // set document signature
        PDF::setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);
        
        PDF::SetFont('helvetica', '', 12);
        PDF::SetTitle('Digital Signature');
        PDF::AddPage();

        // print a line of text
        $text = view('tcpdf');

        // add view content
        PDF::writeHTML($text, true, 0, true, 0);

        // add image for signature
        PDF::Image('tcpdf.png', 180, 60, 15, 15, 'PNG');
        
        // define active area for signature appearance
        PDF::setSignatureAppearance(180, 60, 15, 15);
        
        // save pdf file
        PDF::Output(public_path('DigSig.pdf'), 'F');

        PDF::reset();

        dd('pdf created');
    }
}
