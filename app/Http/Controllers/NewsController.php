<?php

namespace App\Http\Controllers;
use App\News;
use Image;
use App\Category;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news(){


        $date = News::get();
        $New = News::where('status','1')->orderBy('id','Desc')->get();
        return view('news.indexNews')->with(compact('New'));

    }

    public function viewNewsAdmin(Request $request){

            $New = News::get();
            return view('admin.news.view_news')->with(compact('New'));

    }
    public function addNews(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;

            $New = new News;
            $New->title = $data['title'];
			$New->newDescription = $data['newDescription'];

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            date_default_timezone_set('America/Bogota');


			// Subir Imagen
            if($request->hasFile('image')){
            	$image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Subir Imagen Despues De Redimensionarla
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $New_path = 'images/frontend_images/news/'.$fileName;
     				Image::make($image_tmp)->resize(800, 600)->save($New_path);
     				$New->image = $fileName;
                }
            }

            $New->status = $status;
			$New->save();
			return redirect()->back()->with('flash_message_success', 'Noticia agregada correctamente');
        }

        return view('admin.news.add_news');


}


public function deleteNew($id = null){
    News::where(['id'=>$id])->delete();
    return redirect()->back()->with('flash_message_success', 'La noticia ha sido eliminada correctamente');
}

public function editNews(Request $request, $id=null){
    if($request->isMethod('post')){
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/

        if(empty($data['status'])){
            $status='0';
        }else{
            $status='1';
        }

        if(empty($data['newDescription'])){
            $data['newDescription'] = '';
        }

        // Subir Imagen
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                 // Subir Imagen Despues De Redimensionarla
                $extension = $image_tmp->getClientOriginalExtension();
                $fileName = rand(111,99999).'.'.$extension;
                $New_path = 'images/frontend_images/news/'.$fileName;
                Image::make($image_tmp)->resize(800, 600)->save($New_path);
            }
        }else if(!empty($data['current_image'])){
            $fileName = $data['current_image'];
        }else{
            $fileName = '';
        }


        News::where('id',$id)->update(['status'=>$status,'newDescription'=>$data['newDescription'],'title'=>$data['title'],'image'=>$fileName]);
        return redirect()->back()->with('flash_message_success','La imagen ha sido agregada correctamente');

    }

    $NewDetails = News::where('id',$id)->first();
    return view('admin.news.edit_news')->with(compact('NewDetails'));
}


}
