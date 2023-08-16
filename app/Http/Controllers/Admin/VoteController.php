<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\VoteRequest;
use App\Models\Vote;
use Maatwebsite\Excel\Facades\Excel;

class VoteController extends Controller
{
    
    protected $viewPath; 
    protected $routePath; 
    public function __construct(){
        $this->viewPath = 'admin.votes.';
        $this->routePath = 'admin.votes.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(VoteRequest $request)
     {
         $length = 10;
         if(request()->get('length')){
             $length = $request->get('length');
         }
         $votes = Vote::query();
         
            if($request->get('search')){
                $votes->where('id','like','%'.$request->search.'%')
                                  
                ->orWhere('status','like','%'.$request->search.'%')
                                 
                ->orWhere('user_id','like','%'.$request->search.'%')
                                 
                ->orWhere('ip_address','like','%'.$request->search.'%')
               ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $votes->whereBetween('created_at', [\Carbon\Carbon::parse($request->from)->format('Y-m-d').' 00:00:00',\Carbon\Carbon::parse($request->to)->format('Y-m-d')." 23:59:59"]);
            }

            if($request->get('asc')){
                $votes->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $votes->orderBy($request->get('desc'),'desc');
            }
            if($request->get('trash') == 1){
                $votes->onlyTrashed();
            }
            $votes = $votes->paginate($length);
            $bulkActivation = Vote::BULK_ACTIVATION;
            if ($request->ajax()) {
                return view($this->viewPath.'load', ['votes' => $votes,'bulkActivation'=>$bulkActivation])->render();  
            }
 
        return view($this->viewPath.'index', compact('votes','bulkActivation'));
    }

    public function print(Request $request){
        $votes = collect($request->records['data']);
        return view($this->viewPath.'print', ['votes' => $votes])->render();   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view($this->viewPath.'create');
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoteRequest $request)
    {
        try{         
            $vote = Vote::create($request->all());
       
                                    
            if($request->ajax())
                return response()->json([
                    'id'=> $vote->id,
                    'status'=>'success',
                    'message' => 'Success',
                    'title' => 'Record Created Successfully!'
                ]);
            else         
            return redirect()->route($this->routePath.'index')->with('success','Vote Created Successfully!');
        }catch(Exception $e){            
            $bug = $e->getMessage();
            if(request()->ajax())
                return  response()->json([$bug]);
            else
                return redirect()->back()->with('error', $bug)->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        try{
            return view($this->viewPath.'show',compact('vote'));
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {   
        try{
            return view($this->viewPath.'edit',compact('vote'));
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoteRequest $request,Vote $vote)
    {
        try{                
            if($vote){
                        
                $chk = $vote->update($request->all());
                
                if($request->ajax())
                    return response()->json([
                        'id'=> $vote->id,
                        'status'=>'success',
                        'message' => 'Success',
                        'title' => 'Record Updated Successfully!'
                    ]);
                else         
                return redirect()->route($this->routePath.'index')->with('success','Record Updated!');
            }
            return back()->with('error','Vote not found')->withInput($request->all());
        }catch(Exception $e){            
            $bug = $e->getMessage();
            if(request()->ajax())
            return  response()->json([$bug]);
            else
            return redirect()->back()->with('error', $bug)->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        try{
            if($vote){
                                        
                $vote->delete();
                return back()->with('success','Vote deleted successfully');
            }else{
                return back()->with('error','Vote not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function restore($id)
    {
        try{
           $vote = Vote::withTrashed()->where('id', $id)->first();
            if($vote){
                $vote->restore();
                return back()->with('success','Vote restore successfully');
            }else{
                return back()->with('error','Vote not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function moreAction(VoteRequest $request)
    {
        if(!$request->has('ids') || count($request->ids) <= 0){
            return response()->json(['error' => "Please select atleast one record."], 401);
        }
        try{
            switch (explode('-',$request->action)[0]) {     
                case 'status':
                    $action = explode('-',$request->action)[1]; 
                    Vote::withTrashed()->whereIn('id', $request->ids)->each(function($q) use($action){
                        $q->update(['status'=>trim($action)]);
                    });
                    return response()->json([
                        'message' => 'Status changed successfully.',
                    ]);
                    break;        ;
    
                case 'Move To Trash':
                    Vote::whereIn('id', $request->ids)->delete();
                    return response()->json([
                        'message' => 'Records moved to trashed successfully.',
                    ]);
                    break;
    
                case 'Delete Permanently':
                    
                    for ($i=0; $i < count($request->ids); $i++) {
                        $vote = Vote::withTrashed()->find($request->ids[$i]);                         
                        $vote->forceDelete();
                    }
                    return response()->json([
                        'message' => 'Records deleted permanently successfully.',
                    ]);
                    break;
    
                case 'Restore':
                    
                    for ($i=0; $i < count($request->ids); $i++) {
                       $vote = Vote::withTrashed()->find($request->ids[$i]);
                       $vote->restore();
                    }
                    return response()->json([
                        'message' => 'Records restored successfully.',
                    ]);
                    break;
    
                case 'Export':

                    return Excel::download(new VoteExport($request->ids), 'Vote-'.time().'.csv');
                    return response()->json(['error' => "Sorry! Action not found."], 401);
                    break;
                
                default:
                
                    return response()->json(['error' => "Sorry! Action not found."], 401);
                    break;
            }
        }catch(Exception $e){
            return response()->json(['error' => "Sorry! Action not found."], 401);
        }
    }
      

}
