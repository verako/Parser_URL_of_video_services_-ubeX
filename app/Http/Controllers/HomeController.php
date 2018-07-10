<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParsModel;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
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
        $client = new Client();
        $url=$request->get('url');
        $res = $client->request('GET', $url);//get('url');//
        $code = $res->getStatusCode();
        $res->getHeaderLine('content-type');
        $text = $res->getBody();//->getContents()
        //print_r($text);
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
        $desc = substr($rest , 0,$pos4 );
        $picture="picture";
        $file = $request->file('file');
        $pars=ParsModel::create([
            'iframe_video'=>$request->get('url'),
            'caption'=>$rest,
            'description'=>$desc,
            'picture'=>$picture,
        ]);
        //return view('pars',[ 'text'  => $rest]);

        return redirect('/pars');
    }
}
