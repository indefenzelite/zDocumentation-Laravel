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
    public function index(Request $request,$c_id,$s_id,$id = null)
    {
        $length = 10;
        if (request()->get('length')) {
            $length = $request->get('length');
        }

        if($id == null){
            $faq = Faq::where('category_id',$c_id)->where('sub_category_id',$s_id)->latest()->first();
        }else{
            $faq = Faq::where('id',$id)->where('sub_category_id',$s_id)->where('category_id',$c_id)->latest()->first();
        }
        if ($request->ajax()) {
            $data = view('site.faq.load', ['faq' => $faq])->render();
            return response([
                'data' => $data,
            ]);
        }

        $label = $this->label;
        $sub_category = Category::where('id',$s_id)->first();
        $sub_sub_categories = $sub_category->childrenCategories ?? [];
        
        return view('site.faq.index', compact('label','c_id','s_id','sub_sub_categories','id'));
    }
}
