<?php

namespace Trongnd\Languages;

use Trongnd\Languages\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class LanguageController extends Controller
{
    public function index()
    {
        $data=Language::all();  
        return view('Languages::index',compact('data'));
    }

    public function store(Request $request)
    {
        $this->checkdata($request,true); 
        Language::create($request->all());
        return redirect()->route('lang.language.index');
    }


    public function update(Request $request, $language)
    {       
        $this->checkdata($request,false);
        
        $item=Language::find($language);
        $item->key=$request->key;
        $item->en=$request->en;
        $item->vn=$request->vn;
        $item->page=$request->page;
        $item->save();
        return redirect()->route('lang.language.index');
    }


    public function destroy($id)
    {
        //
        Language::destroy($id);
        return redirect()->route('lang.language.index');
    }

    public function push(){
        $data=Language::all();
        $stren='';
        $strvn='';
        foreach ($data as $value) {
            $stren.='"'.$value->key.'"=>"'.$value->en.'",';
            $strvn.='"'.$value->key.'"=>"'.$value->vn.'",';
        }
        Storage::disk('lang')->put('en/message.php','<?php return ['.$stren.'];');
        Storage::disk('lang')->put('vn/message.php','<?php return ['.$strvn.'];');

        return redirect()->route('lang.language.index')->with('push','OK mày =)');
    }

    public function checkdata(Request $request, $unique=false){
        $str='required';
        if($unique)
        {
            $str='required|unique:languages,key';
        }
        return $this->validate($request, [
                'key' => $str,
                'en' => 'required',
                'vn' => 'required',
                'page' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' =>':attribute đã tồn tại'
            ],
            [
                'key' => 'Key',
                'en' => 'En',
                'vn' => 'Vn',
                'page' => 'Page',
            ]
        );
    }

}
