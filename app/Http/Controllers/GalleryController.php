<?php

namespace App\Http\Controllers;
use App\Gallery;
use Image;
use App\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\ProductsImage;

class GalleryController extends Controller
{


    public function Gallery(Request $request){
        /*$images =Gallery::all();
        dd($images);*/

        $galleries = Gallery::where('status','1')->get();
        return view('gallery.indexGallery')->with(compact('galleries'));

    }


    public function addGallery(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;

    		$gallery = new Gallery;
			$gallery->ImageName = $data['ImageName'];

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
                    $gallery_path = 'images/frontend_images/gallery/'.$fileName;
     				Image::make($image_tmp)->resize(500, 500)->save($gallery_path);
     				$gallery->image = $fileName;
                }
            }

            $gallery->status = $status;
			$gallery->save();
			return redirect()->back()->with('flash_message_success', 'Imagen agregada ha la galeria correctamente');
    	}

    	return view('admin.gallery.add_gallery');
    }


    public function viewGallery(){
        $gallery = Gallery::get();
        return view('admin.gallery.view_gallery')->with(compact('gallery'));
    }

    public function deleteGallery($id = null){
        Gallery::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'La imagen ha sido eliminada correctamente');
    }

    public function editGallery(Request $request, $id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            if(empty($data['ImageName'])){
                $data['ImageName'] = '';
            }

            // Subir Imagen
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Subir Imagen Despues De Redimensionarla
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $gallery_path = 'images/frontend_images/gallery/'.$fileName;
                    Image::make($image_tmp)->resize(500, 500)->save($gallery_path);
                }
            }else if(!empty($data['current_image'])){
                $fileName = $data['current_image'];
            }else{
                $fileName = '';
            }


            Gallery::where('id',$id)->update(['status'=>$status,'ImageName'=>$data['ImageName'],'image'=>$fileName]);
            return redirect()->back()->with('flash_message_success','La imagen ha sido agregada correctamente');

        }
        $galleryDetails = Gallery::where('id',$id)->first();
        return view('admin.gallery.edit_gallery')->with(compact('galleryDetails'));
    }



}
