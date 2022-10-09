<?php

namespace App\Http\Controllers;

use App\cr;
use Illuminate\Http\Request;

class Paygate extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      


            $client = new Client();
            $post_request = ['PAYGATE_ID' =>  $request["PAYGATE_ID"],  'PAY_REQUEST_ID' =>$request["PAY_REQUEST_ID"], 'CHECKSUM' =>  $request["CHECKSUM"]];
    
            try {
    
                $body = $client->post('https://secure.paygate.co.za/payhost/redirect.trans', [RequestOptions::FORM_PARAMS => $post_request]);
               // return 1;
                //return ["body"=>"<h1>Angular<h1/>"];
                return ["body" => $body->getBody()->getContents()];
            } catch(\Exception $ex){
                print_r($ex->getMessage());
            }
            exit;
            //$payload = json_encode($payload);
            $postRequest = "PAYGATE_ID=" . $request["PAYGATE_ID"] ."&"."PAY_REQUEST_ID=".$request["PAY_REQUEST_ID"] . "&CHECKSUM=".$request["CHECKSUM"];
    
                // Prepare new cURL resource
                         $ch = curl_init('https://secure.paygate.co.za/payhost/redirect.trans');
                         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                         curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                         curl_setopt($ch, CURLOPT_POST, true);
                         curl_setopt($ch, CURLOPT_POSTFIELDS, $postRequest);
                         curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
                 // Set HTTP Header for POST request
                         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                 //'Content-Type: application/json',
                                 'Content-Type: application/x-www-form-urlencoded',
                                 'Content-Length: ' . strlen($postRequest))
                         );
    
                 // Submit the POST request
                         $result = curl_exec($ch);
            print_r(curl_error($ch));
            echo "INfo";
            print_r($result);
    
                 // Close cURL session handle
                         curl_close($ch);
    
    
                         exit;
    
                 return $result;
    
    
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
