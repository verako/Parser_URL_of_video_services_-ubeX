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

        //Captins
        $captins=$text;

        //искомый текст
        $my_str='<title>';
        $my_str2='</title>';

        $pos = strpos($captins, $my_str);
        $pos2 = strpos($captins, $my_str2);
        $lengt=$pos2-$pos-7;//
        $rest = substr($captins, $pos+7, $lengt);

        //description
        $description=$text;
        $my_str3='name="description"';
        $my_str4='"';
        $pos3 = strpos($description, $my_str3);
        //echo $lengt1=$pos4-$pos3;//-44;
        $rest1 = substr($description, $pos3+28, -1);
        $pos4 = strpos($rest1 , $my_str4);
        $rest1 = substr($rest1, 0, $pos4);

        //picture
        $picture=$text;
        $my_str5='property="og:image"';
        $my_str6='>';
        $pos5 = strpos($picture, $my_str5);
        $rest2 = substr($picture, $pos5+29, -1);
        $pos6 = strpos($rest2, $my_str6);
        $rest2 = substr($rest2, 0, $pos6-1);

        //iframe
        $iframe=$text;
        $my_str7='name="twitter:player"';
        $pos7 = strpos($iframe, $my_str7);
        $rest3 = substr($iframe, $pos7, -1);
        $my_str8='htt';
        $pos8 = strpos($rest3 , $my_str8);
        $rest3 = substr($rest3, $pos8, -1);
        $my_str9='"';
        $pos9 = strpos($rest3 , $my_str9);
        $rest3 = substr($rest3, 0, $pos9);

        $file = $request->file('file');
        $pars=ParsModel::create([
            'iframe_video'=>$rest3,
            'caption'=>$rest,
            'description'=>$rest1,
            'picture'=>$rest2,
        ]);
        //return view('pars',[ 'text'  => $rest]);

        return redirect('/pars');
    }
}
