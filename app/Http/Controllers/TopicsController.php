<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Topic $topic)
	{
//		$topics = Topic::with(['user', 'category'])->paginate();
		$topics = $topic->withOrder($request->order)->paginate();
		return view('topics.index', compact('topics'));
	}

    public function show(Request $request, Topic $topic)
    {
    	if (! empty($topic->slug) && $topic->slug != $request->slug) {
    		return redirect($topic->link(), 301);
	    }
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
		$categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
		$topic->fill($request->all());
		$topic->user_id = Auth::id();
		$topic->save();
//		return redirect()->route('topics.show', $topic->id)->with('success', '帖子创建成功！');
		return redirect()->to($topic->link())->with('success', '帖子创建成功！');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

//		return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
		return redirect()->to($topic->link())->with('message', 'Updated successfully.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '成功删除！');
	}
	
	
	public function uploadImage(Request $request, ImageUploadHandler $uploader)
	{
		$data = [
			'success'   =>  false,
			'msg'       =>  '上传失败',
			'file_path' =>  '',
		];
		
		if ($file = $request->upload_file) {
			// 保存图片到本地
			$result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
			
			// 图片保存成功的话
			if ($result) {
				$data['success'] = true;
				$data['msg'] = '上传成功';
				$data['file_path'] = $result['path'];
			}
		}
		
		return $data;
		
	}
}