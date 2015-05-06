<?php namespace Congkhuong\LaravelDesign\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Congkhuong\LaravelDesign\Models\File;
class DatabasesController extends Controller {

	public function index()
	{
		exit('index');
		return view('index');
	}

	public function dbs(){
		$filename = File::all();
		$data = array();
		foreach ($filename as $item) {
			unset($item['data']);
			$data = array_merge($data,array($item));
		}
		$return = array('dbs' => $data);
		return json_encode($return);
	}

	public function ajax(Request $request)
	{
		if($request->isMethod('post')){
			$id = $request->input('dbfilename');
			$file = File::find($id);
			$data = array(
				'description' => $file['description'],
				'files' => array(
					$file['name'] => array(
						'content' => $file['data']
					)
				),
				'public' => 'true'
			);
			$return = '{"description":"'.$file['description'].'","files":{"'.$file['name'].'":{"content":'.$file['data'].'}},"public":true}';
			return $return;
		}
	}

	public function save(Request $request){
		if($request->isMethod('post')){
			$file = new File;
			$input = $request->input('json_post');
			$file->description = $input['description'];
			$file->public = $input['public'];
			$filename = $input['files'];
			foreach ($filename as $key => $value) {
				$file->name = $key;
				$file->data = $filename[$key]['content'];
			}
			if($file->save()){
				return 'Success';
			}
		}
	}

	public function update(Request $request){
		if ($request->isMethod('post')) {
			$id = $request->input('dbid');
			$file = File::find($id);
			$input = $request->input('json_post');
			$file->description = $input['description'];
			$filename = $input['files'];
			foreach ($filename as $key => $value) {
				$file->name = $key;
				$file->data = $filename[$key]['content'];
			}
			if($file->save()){
				return 'Success';
			}
		}
	}
}