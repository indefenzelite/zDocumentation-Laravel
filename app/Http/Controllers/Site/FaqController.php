<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Category;

class FaqController extends Controller
{
    public $label;

    function __construct()
    {
        $this->label = 'FAQS';
    }
    public function index(Request $request,$id)
    {
        $length = 10;
        if (request()->get('length')) {
            $length = $request->get('length');
        }
       $faq = Faq::where('id',$id)->first();
       $category = Category::where('id',request()->get('category_id'))->first();
        if ($request->ajax()) {
            $data = view('site.faq.load', ['faq'=>$faq,'id'=>$id,'category'=>$category])->render();
            return response([
                'data' => $data,
            ]);
        }

        $label = $this->label;
        
        return view('site.faq.index', compact('label','faq','category','id'));
    }
}
