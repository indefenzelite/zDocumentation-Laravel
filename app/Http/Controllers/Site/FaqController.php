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
    public function index(Request $request,$category_id)
    {
        $length = 10;
        if (request()->get('length')) {
            $length = $request->get('length');
        }
        // if($id == null){
        //     $faq = Faq::where('category_id',$c_id)->where('sub_category_id',$s_id)->latest()->first();
        // }else{
        //     if ($id == 0 && $s_id == 0) {
        //         $faq = Faq::where('category_id',$c_id)->latest()->first();
        //     }else{
            //         $faq = Faq::where('id',$id)->where('sub_category_id',$s_id)->where('category_id',$c_id)->latest()->first();
            //     }
            // }
        $faq = Faq::where('category_id',$category_id)->latest()->first();
        if ($request->ajax()) {
            $data = view('site.faq.load', ['faq'=>$faq,'id'=>$id])->render();
            return response([
                'data' => $data,
            ]);
        }

        $label = $this->label;
        $category = Category::where('id',$category_id)->first();
        $sub_category = [];
        $sub_sub_categories = $category->categories;
        // $sub_category = Category::where('id',$s_id)->first();
        // $sub_sub_categories = $sub_category->childrenCategories ?? [];
        
        return view('site.faq.index', compact('label','sub_sub_categories','faq','category'));
    }
}
