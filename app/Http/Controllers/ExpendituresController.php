<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Http\Requests\ExpenditureRequest;
use App\Handlers\ImageUploadHandler;
use App\Models\Expenditure;
use Carbon\Carbon;

class ExpendituresController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function index()
    {
        $lists = Auth::user()->expenditureInfo()->get();
        return view('expenditures.lists', compact('lists'));
    }
    
    public function create()
    {
    	return view('expenditures.create');
    }
    
    public function edit()
    {
    
    }
    
    public function update(Request $request, User $user)
    {
    
    }
    
    public function store(ExpenditureRequest $request, ImageUploadHandler $uploader)
    {
        $data = $request->all();
        
        if ($request->pic) {
        	$result = $uploader->save($request->pic, 'expenditures', Auth::user()->id, 416);
        	if ($result) {
        		$data['pic'] = $result['path'];
	        }
        }
        $data['user_id'] = Auth::user()->id;
        $data['expenditure_time'] = now();
	
	    Expenditure::create($data);
	    
	    return redirect()->route('expenditures.index')->with('success', '消费添加成功');
    }
    
    public function destroy(Expenditure $expenditure)
    {
	    $this->authorize('destroy',$expenditure);
        $expenditure->delete();
        session()->flash('success', '消费记录删除成功！');
	    return back();
    }
}
