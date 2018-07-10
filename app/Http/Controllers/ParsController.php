<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ParsModel;

class ParsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://www.youtube.com/watch?v=V6hmvgLo0Cc');
        $code = $res->getStatusCode();
        $res->getHeaderLine('content-type');
        $text = $res->getBody();//->getContents()
        //print_r($text);

        //Captins
        $main_str=$text;

        //искомый текст
        $my_str='<title>';
        $my_str2='</title>';

        $pos = strpos($main_str, $my_str);
        $pos2 = strpos($main_str, $my_str2);
        $lengt=$pos2-$pos;
        $rest = substr($text, $pos+7, $lengt-7);
        //description
        $description=$text;
        $my_str3='name="description"';
        $my_str4='>';
        echo $pos3 = strpos($description, $my_str3);
        //
        $rest = substr($text, $pos3,300 );
        echo $pos4 = strpos($rest , $my_str4);
        $rest = substr($rest , 0,$pos4 );
        return view('pars',[ 'text'  => $rest]);

        //return view('pars');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pars.create',['pars'=>new ParsModel()]);//добавляем пустую переменную pars

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $desc="content";
        $picture="picture";
        $file = $request->file('file');
        $pars=ParsModel::create([
            'iframe_video'=>$request->get('url'),
            'caption'=>$rest,
            'description'=>$desc,
            'picture'=>$picture,
        ]);

        return redirect('/message');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
