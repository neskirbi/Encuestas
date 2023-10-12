<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Token;

class LinkController extends Controller
{
    function index(){
        $links=Token::orderby('mail','asc')->paginate(20);
        return view('soporte.links.links',['links'=>$links]);
    }
}
