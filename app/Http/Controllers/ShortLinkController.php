<?php

namespace App\Http\Controllers;

use App\Jobs\crawlWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ShortLink;

class ShortLinkController extends Controller
{
    public function index(){
        $shortLinks = ShortLink::all();
        return view('shortLinks', ['shortLinks' => $shortLinks]);
    }

    public function store(Request $request){
        $request->validate([
            'link' => 'required|url',
            'short_code' => 'unique'
        ]);
        $data['link'] = $request->link;
        $data['short_code'] = Str::random(8);
        ShortLink::create($data);
        dispatch(new crawlWeb($data['short_code']));
//        $crawler = new crawlWeb($data['short_code']);
//        $crawler->dispatch();
        return redirect('short-url/list')->with('success','Code generated successfully');
    }
    public function show($code){
        $short_link = ShortLink::where('short_code',$code)->first();
        $status = 302;
        $headers = array();
        return redirect()->intended($short_link->link, $status, $headers);
    }
}