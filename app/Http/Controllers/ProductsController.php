<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Coupon;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use DB;
use App\Exports\productsExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Carbon\Carbon;

class ProductsController extends Controller
{
	public function addProduct(Request $request){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
		if($request->isMethod('post')){
			$data = $request->all();
			//echo "<pre>"; print_r($data); die;

			$product = new Product;
			$product->category_id = $data['category_id'];
			$product->product_name = $data['product_name'];
			$product->product_code = $data['product_code'];
			$product->product_color = $data['product_color'];
            if(!empty($data['weight'])){
                $product->weight = $data['weight'];
            }else{
                $product->weight = 0;
            }
			if(!empty($data['description'])){
				$product->description = $data['description'];
			}else{
				$product->description = '';
			}
            if(!empty($data['sleeve'])){
                $product->sleeve = $data['sleeve'];
            }else{
                $product->sleeve = '';
            }
            if(!empty($data['pattern'])){
                $product->pattern = $data['pattern'];
            }else{
                $product->pattern = '';
            }
            if(!empty($data['care'])){
                $product->care = $data['care'];
            }else{
                $product->care = '';
            }
            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }
            if(empty($data['feature_item'])){
                $feature_item='0';
            }else{
                $feature_item='1';
            }
			$product->price = $data['price'];

			// Subir Imagen
            if($request->hasFile('image')){
            	$image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Subir Imagen Despues De Redimensionar
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/product/large'.'/'.$fileName;
                    $medium_image_path = 'images/backend_images/product/medium'.'/'.$fileName;
                    $small_image_path = 'images/backend_images/product/small'.'/'.$fileName;

	                Image::make($image_tmp)->save($large_image_path);
 					Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
     				Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

     				$product->image = $fileName;

                }
            }

            // Subir Video
            if($request->hasFile('video')){
                $video_tmp = Input::file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'videos/';
                $video_tmp->move($video_path,$video_name);
                $product->video = $video_name;
            }

            $product->feature_item = $feature_item;
            $product->status = $status;
			$product->save();
			return redirect()->back()->with('flash_message_success', 'El producto ha sido agregado correctamente');
		}

		$categories = Category::where(['parent_id' => 0])->get();

		$categories_drop_down = "<option value='' selected disabled>Select</option>";
		foreach($categories as $cat){
			$categories_drop_down .= "<option value='".$cat->id."'>".$cat->name."</option>";
			$sub_categories = Category::where(['parent_id' => $cat->id])->get();
			foreach($sub_categories as $sub_cat){
				$categories_drop_down .= "<option value='".$sub_cat->id."'>&nbsp;&nbsp;--&nbsp;".$sub_cat->name."</option>";
			}
        }
        
        $levels = Category::where(['parent_id'=>0])->get();

		//echo "<pre>"; print_r($categories_drop_down); die;

        $sleeveArray = array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeveless');

        $patternArray = array('Checked','Plain','Printed','Self','Solid');

		return view('admin.products.add_product')->with(compact('categories_drop_down','levels','sleeveArray','patternArray'));
	}

	public function editProduct(Request $request,$id=null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
		if($request->isMethod('post')){
			$data = $request->all();
			/*echo "<pre>"; print_r($data); die;*/

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            if(empty($data['feature_item'])){
                $feature_item='0';
            }else{
                $feature_item='1';
            }

            if(!empty($data['sleeve'])){
                $sleeve = $data['sleeve'];
            }else{
                $sleeve = '';
            }

            if(!empty($data['pattern'])){
                $pattern = $data['pattern'];
            }else{
                $pattern = '';
            }

			// Subir Imagen
            if($request->hasFile('image')){
            	$image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Subir Imagen Despues De Redimensionar
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/product/large'.'/'.$fileName;
                    $medium_image_path = 'images/backend_images/product/medium'.'/'.$fileName;
                    $small_image_path = 'images/backend_images/product/small'.'/'.$fileName;

	                Image::make($image_tmp)->save($large_image_path);
 					Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
     				Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                }
            }else if(!empty($data['current_image'])){
            	$fileName = $data['current_image'];
            }else{
            	$fileName = '';
            }

            // Subir Video
            if($request->hasFile('video')){
                $video_tmp = Input::file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'videos/';
                $video_tmp->move($video_path,$video_name);
                $videoName = $video_name;
            }else if(!empty($data['current_video'])){
                $videoName = $data['current_video'];
            }else{
                $videoName = '';
            }

            if(empty($data['description'])){
            	$data['description'] = '';
            }

            if(empty($data['care'])){
                $data['care'] = '';
            }

			Product::where(['id'=>$id])->update(['feature_item'=>$feature_item,'status'=>$status,'category_id'=>$data['category_id'],'product_name'=>$data['product_name'],
				'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'care'=>$data['care'],'price'=>$data['price'],'weight'=>$data['weight'],'image'=>$fileName,'video'=>$videoName,'sleeve'=>$sleeve,'pattern'=>$pattern]);

			return redirect()->back()->with('flash_message_success', 'El producto ha sido editado correctamente');
		}

      // Obtener Los Detalles Del Producto Comienza //
		$productDetails = Product::where(['id'=>$id])->first();
	  // Obtener Los Detalles Del Producto Termina //

        // Drop Down De Categorias Comienza //
		$categories = Category::where(['parent_id' => 0])->get();

		$categories_drop_down = "<option value='' disabled>Select</option>";
		foreach($categories as $cat){
			if($cat->id==$productDetails->category_id){
				$selected = "selected";
			}else{
				$selected = "";
			}
			$categories_drop_down .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
			$sub_categories = Category::where(['parent_id' => $cat->id])->get();
			foreach($sub_categories as $sub_cat){
				if($sub_cat->id==$productDetails->category_id){
					$selected = "selected";
				}else{
					$selected = "";
				}
				$categories_drop_down .= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;&nbsp;--&nbsp;".$sub_cat->name."</option>";
			}
		}
	    // Drop Down De Categorias Termina //

        $sleeveArray = array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeveless');

        $patternArray = array('Checked','Plain','Printed','Self','Solid');

        $levels = Category::where(['parent_id'=>0])->get();

		return view('admin.products.edit_product')->with(compact('productDetails','levels','categories_drop_down','sleeveArray','patternArray'));
	}

	public function deleteProductImage($id){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        // Obtiene La Imagen Del Producto
		$productImage = Product::where('id',$id)->first();

        // Obtiene La Ruta De Las Imagenes De Productos
		$large_image_path = 'images/backend_images/product/large/';
		$medium_image_path = 'images/backend_images/product/medium/';
        $small_image_path = 'images/backend_images/product/small/';

        // Elimina La Imagen Grande Si No Existe En El Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Elimina La Imagen Mediana Si No Existe En El Folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

      // Elimina La Imagen Pequenia Si No Existe En El Folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

        // Eliminar La Imagen De La Tabla Productos
        Product::where(['id'=>$id])->update(['image'=>'']);

        return redirect()->back()->with('flash_message_success', 'La imagen del producto ha sido eliminada');
	}

    public function deleteProductVideo($id){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        // Obtiene El Nonbre Del Video
        $productVideo = Product::select('video')->where('id',$id)->first();

        // Obtiene La Ruta Del Video
        $video_path = 'videos/';

        // Elimina El Video Si No Existe En La Carpeta Videos
        if(file_exists($video_path.$productVideo->video)){
            unlink($video_path.$productVideo->video);
        }

        // Elimina Video De La Tabla Productos
        Product::where('id',$id)->update(['video'=>'']);

        return redirect()->back()->with('flash_message_success','El video del producto ja sido eliminado correctamente');
    }

    public function deleteProductAltImage($id=null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }

        // Obtener Imagen Del Producto
        $productImage = ProductsImage::where('id',$id)->first();

        // Obtener Ruta De La Imagen De Los Productos
        $large_image_path = 'images/backend_images/product/large/';
        $medium_image_path = 'images/backend_images/product/medium/';
        $small_image_path = 'images/backend_images/product/small/';

        // Elimina La Imagen Grande Si No Existe En El Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Elimina La Imagen Mediana Si No Existe En El Folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

       // Elimina La Imagen Pequenia Si No Existe En El Folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

        // Elimina La Imagen De La Tabla Products Images
        ProductsImage::where(['id'=>$id])->delete();

        return redirect()->back()->with('flash_message_success', 'La imagen alterna del producto ha sido eliminada correctamente');
    }
public function viewProducts(Request $request){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
		$products = Product::get();
		foreach($products as $key => $val){
			$category_name = Category::where(['id' => $val->category_id])->first();
			$products[$key]->category_name = $category_name->name;
		}
		$products = json_decode(json_encode($products));
		//echo "<pre>"; print_r($products); die;
		return view('admin.products.view_products')->with(compact('products'));
	}

	public function deleteProduct($id = null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'El producto ha sido eliminar correctamente');
    }

    public function deleteAttribute($id = null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Atributo del producto eliminado correctamente');
    }

    public function addAttributes(Request $request, $id=null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        $productDetails = json_decode(json_encode($productDetails));
        /*echo "<pre>"; print_r($productDetails); die;*/

        $categoryDetails = Category::where(['id'=>$productDetails->category_id])->first();
        $category_name = $categoryDetails->name;

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            foreach($data['sku'] as $key => $val){
                if(!empty($val)){
                    $attrCountSKU = ProductsAttribute::where(['sku'=>$val])->count();
                    if($attrCountSKU>0){
                        return redirect('admin/add-attributes/'.$id)->with('flash_message_error', 'El codigo ua existe. por favor ingrese otro codigo.');
                    }
                    $attrCountSizes = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes>0){
                        return redirect('admin/add-attributes/'.$id)->with('flash_message_error', 'El atributo ya existe. Por favor ingresa otro atributo.');
                    }
                    $attr = new ProductsAttribute;
                    $attr->product_id = $id;
                    $attr->sku = $val;
                    $attr->size = $data['size'][$key];
                    $attr->price = $data['price'][$key];
                    $attr->stock = $data['stock'][$key];
                    $attr->save();
                }
            }
            return redirect('admin/add-attributes/'.$id)->with('flash_message_success', 'El atributo del producto ha sido agregado correctamente');

        }

        $title = "Add Attributes";

        return view('admin.products.add_attributes')->with(compact('title','productDetails','category_name'));
    }

    public function editAttributes(Request $request, $id=null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            foreach($data['idAttr'] as $key=> $attr){
                if(!empty($attr)){
                    ProductsAttribute::where(['id' => $data['idAttr'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
            return redirect('admin/add-attributes/'.$id)->with('flash_message_success', 'El atributo del producto ha sido editado correctamente');
        }
    }

    public function addImages(Request $request, $id=null){
        if(Session::get('adminDetails')['products_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        $productDetails = Product::where(['id' => $id])->first();

        $categoryDetails = Category::where(['id'=>$productDetails->category_id])->first();
        $category_name = $categoryDetails->name;

        if($request->isMethod('post')){
            $data = $request->all();
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach($files as $file){
                    // Upload Images after Resize
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/product/large'.'/'.$fileName;
                    $medium_image_path = 'images/backend_images/product/medium'.'/'.$fileName;
                    $small_image_path = 'images/backend_images/product/small'.'/'.$fileName;
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600, 600)->save($medium_image_path);
                    Image::make($file)->resize(300, 300)->save($small_image_path);
                    $image->image = $fileName;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
            }

            return redirect('admin/add-images/'.$id)->with('flash_message_success', 'La imagen del producto ha sido agregada correctamente');

        }

        $productImages = ProductsImage::where(['product_id' => $id])->orderBy('id','DESC')->get();

        $title = "Add Images";
        return view('admin.products.add_images')->with(compact('title','productDetails','category_name','productImages'));
    }

    public function products($url){
        // Muestra Pagina 404 Si La Categoria No Existe
    	$categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
    	if($categoryCount==0){
    		abort(404);
    	}

    	$categories = Category::with('categories')->where(['parent_id' => 0])->get();

    	$categoryDetails = Category::where(['url'=>$url])->first();
    	if($categoryDetails->parent_id==0){
    		$subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
    		$subCategories = json_decode(json_encode($subCategories));
    		foreach($subCategories as $subcat){
    			$cat_ids[] = $subcat->id;
    		}
    		$productsAll = Product::whereIn('products.category_id', $cat_ids)->where('products.status','1')->orderBy('products.id','Desc');
            $breadcrumb = "<a href='/'>Home</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";
    	}else{
    		$productsAll = Product::where(['products.category_id'=>$categoryDetails->id])->where('products.status','1')->orderBy('products.id','Desc');
            $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
            $breadcrumb = "<a href='/'>Home</a> / <a href='".$mainCategory->url."'>".$mainCategory->name."</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";
    	}

        if(!empty($_GET['color'])){
            $colorArray = explode('-',$_GET['color']);
            $productsAll = $productsAll->whereIn('products.product_color',$colorArray);
        }

        if(!empty($_GET['sleeve'])){
            $sleeveArray = explode('-',$_GET['sleeve']);
            $productsAll = $productsAll->whereIn('products.sleeve',$sleeveArray);
        }

        if(!empty($_GET['pattern'])){
            $patternArray = explode('-',$_GET['pattern']);
            $productsAll = $productsAll->whereIn('products.pattern',$patternArray);
        }

        if(!empty($_GET['size'])){
            $sizeArray = explode('-',$_GET['size']);
            $productsAll = $productsAll->join('products_attributes','products_attributes.product_id','=','products.id')
            ->select('products.*','products_attributes.product_id','products_attributes.size')
            ->groupBy('products_attributes.product_id')
            ->whereIn('products_attributes.size',$sizeArray);
        }

        $productsAll = $productsAll->paginate(6);
        /*$productsAll = json_decode(json_encode($productsAll));
        echo "<pre>"; print_r($productsAll); die;*/

        /*$colorArray = array('Black','Blue','Brown','Gold','Green','Orange','Pink','Purple','Red','Silver','White','Yellow');*/

        $colorArray = Product::select('product_color')->groupBy('product_color')->get();
        $colorArray = array_flatten(json_decode(json_encode($colorArray),true));

        $sleeveArray = Product::select('sleeve')->where('sleeve','!=','')->groupBy('sleeve')->get();
        $sleeveArray = array_flatten(json_decode(json_encode($sleeveArray),true));

        $patternArray = Product::select('pattern')->where('pattern','!=','')->groupBy('pattern')->get();
        $patternArray = array_flatten(json_decode(json_encode($patternArray),true));

        $sizesArray = ProductsAttribute::select('size')->groupBy('size')->get();
        $sizesArray = array_flatten(json_decode(json_encode($sizesArray),true));
        /*echo "<pre>"; print_r($sizesArray); die;*/

        $meta_title = $categoryDetails->meta_title;
        $meta_description = $categoryDetails->meta_description;
    	$meta_keywords = $categoryDetails->meta_keywords;
    	return view('products.listing')->with(compact('categories','productsAll','categoryDetails','meta_title','meta_description','meta_keywords','url','colorArray','sleeveArray','patternArray','sizesArray','breadcrumb'));
    }

    public function filter(Request $request){
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/

        $colorUrl="";
        if(!empty($data['colorFilter'])){
            foreach($data['colorFilter'] as $color){
                if(empty($colorUrl)){
                    $colorUrl = "&color=".$color;
                }else{
                    $colorUrl .= "-".$color;
                }
            }
        }

        $sleeveUrl="";
        if(!empty($data['sleeveFilter'])){
            foreach($data['sleeveFilter'] as $sleeve){
                if(empty($sleeveUrl)){
                    $sleeveUrl = "&sleeve=".$sleeve;
                }else{
                    $sleeveUrl .= "-".$sleeve;
                }
            }
        }

        $patternUrl="";
        if(!empty($data['patternFilter'])){
            foreach($data['patternFilter'] as $pattern){
                if(empty($patternUrl)){
                    $patternUrl = "&pattern=".$pattern;
                }else{
                    $patternUrl .= "-".$pattern;
                }
            }
        }

        $sizeUrl="";
        if(!empty($data['sizeFilter'])){
            foreach($data['sizeFilter'] as $size){
                if(empty($sizeUrl)){
                    $sizeUrl = "&size=".$size;
                }else{
                    $sizeUrl .= "-".$size;
                }
            }
        }

        $finalUrl = "products/".$data['url']."?".$colorUrl.$sleeveUrl.$patternUrl.$sizeUrl;
        return redirect::to($finalUrl);
    }

    public function searchProducts(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $categories = Category::with('categories')->where(['parent_id' => 0])->get();
            $search_product = $data['product'];
            /*$productsAll = Product::where('product_name','like','%'.$search_product.'%')->orwhere('product_code',$search_product)->where('status',1)->paginate();*/

            $productsAll = Product::where(function($query) use($search_product){
                $query->where('product_name','like','%'.$search_product.'%')
                ->orWhere('product_code','like','%'.$search_product.'%')
                ->orWhere('description','like','%'.$search_product.'%')
                ->orWhere('product_color','like','%'.$search_product.'%');
            })->where('status',1)->get();

            $breadcrumb = "<a href='/'>Home</a> / ".$search_product;

            return view('products.listing')->with(compact('categories','productsAll','search_product','breadcrumb'));
        }
    }

    public function product($id){

        // Muestra La Pagina 404 Si El Producto Esta Deshabilitado
        $productCount = Product::where(['id'=>$id,'status'=>1])->count();
        if($productCount==0){
            abort(404);
        }

        // Obtiene Detalles Del Producto
        $productDetails = Product::with('attributes')->where('id',$id)->first();
        $relatedProducts = Product::where('id','!=',$id)->where(['category_id' => $productDetails->category_id])->get();

        /*foreach($relatedProducts->chunk(3) as $chunk){
            foreach($chunk as $item){
                echo $item; echo "<br>";
            }
            echo "<br><br><br>";
        }*/

        // Obtiene El Alt De La Imagen Del Producto
        $productAltImages = ProductsImage::where('product_id',$id)->get();
        /*$productAltImages = json_decode(json_encode($productAltImages));
        echo "<pre>"; print_r($productAltImages); die;*/
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();

        $categoryDetails = Category::where('id',$productDetails->category_id)->first();
        if($categoryDetails->parent_id==0){
            $breadcrumb = "<a href='/'>Home</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a> / ".$productDetails->product_name;
        }else{
            $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
            $breadcrumb = "<a style='color:#333;' href='/'>Inicio</a> / <a style='color:#333;' href='/products/".$mainCategory->url."'>".$mainCategory->name."</a> / <a style='color:#333;' href='/products/".$categoryDetails->url."'>".$categoryDetails->name."</a> / ".$productDetails->product_name;
        }


        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');
        $meta_title = $productDetails->product_name;
        $meta_description = $productDetails->description;
        $meta_keywords = $productDetails->product_name;
        return view('products.detail')->with(compact('productDetails','categories','productAltImages','total_stock','relatedProducts','meta_title','meta_description','meta_keywords','breadcrumb'));
    }

    public function getProductPrice(Request $request){
        $data = $request->all();
        $proArr = explode("-",$data['idsize']);
        $proAttr = ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        $getCurrencyRates = Product::getCurrencyRates($proAttr->price);
        echo $proAttr->price."-".$getCurrencyRates['USD_Rate']."-".$getCurrencyRates['GBP_Rate']."-".$getCurrencyRates['EUR_Rate'];
        echo "#";
        echo $proAttr->stock;
    }

    public function addtocart(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        //echo "<pre>"; print_r($data); die;

        if(!empty($data['wishListButton']) && $data['wishListButton']=="Wish List"){
            /*echo "Wish List is selected"; die;*/

            // Revisa Si EL Usuario Esta Logueado
            if(!Auth::check()){
                return redirect()->back()->with('flash_message_error','Por favor inicia sesión para agregar el producto a la lista de deseos');
            }

            // Revisa Si El Metodo De Envio Esta Seleccionado
            if(empty($data['size'])){
                return redirect()->back()->with('flash_message_error','Por favor selecciona el método de Envio para agregar a la lista de deseos');
            }

            // Obtiene El Metodo De Envio Del Producto
            $sizeIDArr = explode('-',$data['size']);
            $product_size = $sizeIDArr[1];

            // Obtiene El Precio Del Producto
            $proPrice = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$product_size])->first();
            $product_price = $proPrice->price;

            // Obtiene El NombreUsuario/Correo Del Usuario
            $user_email = Auth::user()->email;

            // Poner Cantidad En 1
            $quantity = 1;

            // Obtener La Fecha Actual
            $created_at = Carbon::now();

            $wishListCount = DB::table('wish_list')->where(['user_email'=>$user_email,'product_id'=>$data['product_id'],'product_color'=>$data['product_color'],'size'=>$product_size])->count();

            if($wishListCount>0){
                return redirect()->back()->with('flash_message_error','El Producto Ya Existe En La Lista De Deseos!');
            }else{
                // Insertar Productos En La Lista De Deseo
                DB::table('wish_list')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'price'=>$product_price,'size'=>$product_size,'quantity'=>$quantity,'user_email'=>$user_email,'created_at'=>$created_at]);
                return redirect()->back()->with('flash_message_success','El producto ha sido agregado a la lista de deseos');
            }


        }else{

            // Si El Producto Es Agregado A La Lista De Deseos
            if(!empty($data['cartButton']) && $data['cartButton']=="Add to Cart"){
                $data['quantity'] = 1;
            }

            // Revisa Si El Stock Del Producto Esta Disponible O No
            $product_size = explode("-",$data['size']);
            $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$product_size[1]])->first();

            if($getProductStock->stock<$data['quantity']){
                return redirect()->back()->with('flash_message_error','La cantidad requerida mo esta disponible!');
            }

            if(empty(Auth::user()->email)){
                $data['user_email'] = '';
            }else{
                $data['user_email'] = Auth::user()->email;
            }

            $session_id = Session::get('session_id');
            if(!isset($session_id)){
                $session_id = str_random(40);
                Session::put('session_id',$session_id);
            }


            $sizeIDArr = explode('-',$data['size']);
            $product_size = $sizeIDArr[1];

            if(empty(Auth::check())){
                $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],'product_color' => $data['product_color'],'size' => $product_size,'session_id' => $session_id])->count();
                if($countProducts>0){
                    return redirect()->back()->with('flash_message_error','El producto ya existe en el Ccrrito!');
                }
            }else{
                $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],'product_color' => $data['product_color'],'size' => $product_size,'user_email' => $data['user_email']])->count();
                if($countProducts>0){
                    return redirect()->back()->with('flash_message_error','El producto ya existe en el carrito!');
                }
            }


            $getSKU = ProductsAttribute::select('sku')->where(['product_id' => $data['product_id'], 'size' => $product_size])->first();

            DB::table('cart')->insert(['product_id' => $data['product_id'],'product_name' => $data['product_name'],
                'product_code' => $getSKU['sku'],'product_color' => $data['product_color'],
                'price' => $data['price'],'size' => $product_size,'quantity' => $data['quantity'],'user_email' => $data['user_email'],'session_id' => $session_id]);

                return redirect()->back()->with('flash_message_success','El producto ha sido agregado a el carrito!');

        }

    }

    public function cart(){
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
        }

        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        /*echo "<pre>"; print_r($userCart); die;*/
        $meta_title = "Frutexco";
        $meta_description = "Carrito Frutexco";
        $meta_keywords = "shopping cart, e-com Website";
        return view('products.cart')->with(compact('userCart','meta_title','meta_description','meta_keywords'));
    }

    public function wishList(){
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userWishList = DB::table('wish_list')->where('user_email',$user_email)->get();
            foreach($userWishList as $key => $product){
                $productDetails = Product::where('id',$product->product_id)->first();
                $userWishList[$key]->image = $productDetails->image;
            }
        }else{
            $userWishList = array();
        }
        $meta_title = "Frutexco";
        $meta_description = "Ver Lista De Deseos";
        $meta_keywords = "wish list, e-com Website";
        return view('products.wish_list')->with(compact('userWishList','meta_title','meta_description','meta_keywords'));
    }

    public function updateCartQuantity($id=null,$quantity=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $getProductSKU = DB::table('cart')->select('product_code','quantity')->where('id',$id)->first();
        $getProductStock = ProductsAttribute::where('sku',$getProductSKU->product_code)->first();
        $updated_quantity = $getProductSKU->quantity+$quantity;
        if($getProductStock->stock>=$updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart')->with('flash_message_success','La cantidad de productos ha sido actualizada!');
        }else{
            return redirect('cart')->with('flash_message_error','La cantidad de producto mo esta disponible!');
        }
    }

    public function deleteCartProduct($id=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_message_success','El producto ha sido eliminado del carro!');
    }

    public function applyCoupon(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0){
            return redirect()->back()->with('flash_message_error','El cupon no existe!');
        }else{
            // Realiza Otra Verificaciones Como Activa/Inactiva, Fecha De Vencimiento..

            // Obtener Detalles Del Cupon
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();

            // Si El Cupon Esta Inactivo
            if($couponDetails->status==0){
                return redirect()->back()->with('flash_message_error','El cupon no esta activo!');
            }

            // Si El Cupon Expiro
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                return redirect()->back()->with('flash_message_error','El cupon expiro!');
            }

            // Si El Cupon Es Valido Para El Descuento

            // Ontiene El Total Del Monto Del Carrito
            if(Auth::check()){
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
            }else{
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
            }

            $total_amount = 0;
            foreach($userCart as $item){
               $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            // Revisa Si El Tipo De Descuento Es Fijo O Por Porcentaje
            if($couponDetails->amount_type=="Fixed"){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            // Agregar El Codigo Del Cupon & Monton En La Sesion
            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);

            return redirect()->back()->with('flash_message_success','El cupon ha sido aplicado correctamente!');

        }
    }

    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        //Revisa Si La Direccion De Envio Existe
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount>0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }

        // Actualiza La Tabla Del carrito Con El Correo Del Usuario
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            // Regrese A La Página De Confirmacion De Direccion Si Alguno De Los Campos Está Vacío
            if(empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city']) || empty($data['billing_state']) || empty($data['billing_country']) || empty($data['billing_pincode']) || empty($data['billing_mobile']) || empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country']) || empty($data['shipping_pincode']) || empty($data['shipping_mobile'])){
                    return redirect()->back()->with('flash_message_error','Por favor complete todos los campos para pagar!');
            }

            // Actualizar Detalles Del Usuario
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],'pincode'=>$data['billing_pincode'],'country'=>$data['billing_country'],'mobile'=>$data['billing_mobile']]);

            if($shippingCount>0){
                // Actualiza Direccion De Envio
                DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'pincode'=>$data['shipping_pincode'],'country'=>$data['shipping_country'],'mobile'=>$data['shipping_mobile']]);
            }else{
                // Agrega Nueva Direccion De Envio
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->country = $data['shipping_country'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
            }

         /*  $pincodeCount = DB::table('pincodes')->where('pincode',$data['shipping_pincode'])->count();
            if($pincodeCount == 0){
                return redirect()->back()->with('flash_message_error','Tu Localizacion No Esta Disponible Para Envios, Por Favor Ingrese Otra Localizacion.');
            }   */

            return redirect()->action('ProductsController@orderReview');
        }

        $meta_title = "Pagar - Frutexco";
        return view('products.checkout')->with(compact('userDetails','countries','shippingDetails','meta_title'));
    }

    public function orderReview(){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));
        $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
        $total_weight = 0;
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
            $total_weight = $total_weight + $productDetails->weight;
        }
        /*echo "<pre>"; print_r($userCart); die;*/
       /* $codpincodeCount = DB::table('cod_pincodes')->where('pincode',$shippingDetails->pincode)->count();
        $prepaidpincodeCount = DB::table('prepaid_pincodes')->where('pincode',$shippingDetails->pincode)->count(); */

        // Obtener Gastos De Envio
        $shippingCharges = Product::getShippingCharges($total_weight,$shippingDetails->country);
        Session::put('ShippingCharges',$shippingCharges);

        $meta_title = "";
        return view('products.order_review')->with(compact('userDetails','shippingDetails','userCart','meta_title','shippingCharges'));
    }

    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            // Evitar pedidos de productos agotados
            $userCart = DB::table('cart')->where('user_email',$user_email)->get();
            foreach($userCart as $cart){

                $getAttributeCount = Product::getAttributeCount($cart->product_id,$cart->size);
                if($getAttributeCount==0){
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error','Uno de los productos mo esta disponible. Intentalo de nuevo!');
                }

                $product_stock = Product::getProductStock($cart->product_id,$cart->size);
                if($product_stock==0){
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error','Producto agotado eliminado del carrito. Intentalo de nuevo!');
                }
                /*echo "Original Stock: ".$product_stock;
                echo "Demanded Stock: ".$cart->quantity; die;*/
                if($cart->quantity>$product_stock){
                    return redirect('/cart')->with('flash_message_error','Reduce la cantidad de productos e intente nuevamente.');
                }

                $product_status = Product::getProductStatus($cart->product_id);
                if($product_status==0){
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error','Producto deshabilitado y eliminado del carrito. Intentelo de nuevo!');
                }

                $getCategoryId = Product::select('category_id')->where('id',$cart->product_id)->first();
                $category_status = Product::getCategoryStatus($getCategoryId->category_id);
                if($category_status==0){
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error','Una de las categorías de productos está deshabilitada. Por favor intentelo de nuevo!');
                }

            }

            // Obtener La Direccion De Envio Del Usuario
            $shippingDetails = DeliveryAddress::where(['user_email' => $user_email])->first();

           /* $pincodeCount = DB::table('pincodes')->where('pincode',$shippingDetails->pincode)->count();
            if($pincodeCount == 0){
                return redirect()->back()->with('flash_message_error','Su ubicación no está disponible para la entrega. Por favor ingrese otra ubicación.');
            }
*/
            if(empty(Session::get('CouponCode'))){
               $coupon_code = '';
            }else{
               $coupon_code = Session::get('CouponCode');
            }

            if(empty(Session::get('CouponAmount'))){
               $coupon_amount = '';
            }else{
               $coupon_amount = Session::get('CouponAmount');
            }

            /*// Obtener los gastos de envío
            $shippingCharges = Product::getShippingCharges($shippingDetails->country);*/

            $grand_total = Product::getGrandTotal();

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->pincode = $shippingDetails->pincode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->shipping_charges = Session::get('ShippingCharges');
            $order->grand_total = $grand_total;
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $pro){
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_size = $pro->size;
                $product_price = Product::getProductPrice($pro->product_id,$pro->size);
                $cartPro->product_price = $product_price;
                $cartPro->product_qty = $pro->quantity;
                $cartPro->save();

                // Reduce El Stock Script Comienza
                $getProductStock = ProductsAttribute::where('sku',$pro->product_code)->first();
                /*echo "Original Stock: ".$getProductStock->stock;
                echo "Stock to reduce: ".$pro->quantity;*/
                $newStock = $getProductStock->stock - $pro->quantity;
                if($newStock<0){
                    $newStock = 0;
                }
               ProductsAttribute::where('sku',$pro->product_code)->update(['stock'=>$newStock]);
                  // Reduce El Stock Script Termina
            }

            Session::put('order_id',$order_id);
            Session::put('grand_total',$grand_total);

            if($data['payment_method']=="COD"){

                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails),true);
                /*echo "<pre>"; print_r($productDetails);*/ /*die;*/

                $userDetails = User::where('id',$user_id)->first();
                $userDetails = json_decode(json_encode($userDetails),true);
                /*echo "<pre>"; print_r($userDetails); die;*/

                /* Codigo Para El Correo De La Orden Comienza */
                $email = $user_email;
                $emailEmp = array("jhonjairomedinasilva11@gmail.com");
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails
                ];
                Mail::send('emails.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Cotizacion realizada - FRUTEXCO');
                });
                Mail::send('emails.orderEmpre',$messageData,function($message) use($emailEmp){
                    $message->to($emailEmp)->subject('Nueva cotizacion Frutexco');
                });

               /* Codigo Para El Correo De La Orden Termina */

                // Cotizacion COD - Redirecciona A El Usuario A La Pagina De Gracias Depues De Guardar La Orden
                return redirect('/thanks');
            }else if($data['payment_method']=="Payumoney"){
                // Payumoney - Redirecciona A El Usuario A PayuMoney Despues De Hacer La Orden
                return redirect('/payumoney');
            }else{
                // Paypal - Redirect user to paypal page after saving order
                // Paypal - Redirecciona A El Usuario A Paypal Despues De Hacer La Orden
                return redirect('/paypal');
            }


        }
    }

    public function thanks(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.thanks');
    }

    public function thanksPaypal(){
        return view('orders.thanks_paypal');
    }

    public function paypal(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.paypal');
    }

    public function cancelPaypal(){
        return view('orders.cancel_paypal');
    }

    public function ipnPaypal(Request $request){
        $data = $request->all();
        if($data['payment_status']=="Completed"){
            // Le Enviaremos Un Correo A El Usuario/Administrados
            // Actualizar El Estado De La Cotizacion A Pago Relizado

            // Obtiene El Id De La Orden
            $order_id = Session::get('order_id');

            // Actualiza Orden
            Order::where('id',$order_id)->update(['order_status'=>'Payment Captured']);

            $productDetails = Order::with('orders')->where('id',$order_id)->first();
            $productDetails = json_decode(json_encode($productDetails),true);
            /*echo "<pre>"; print_r($productDetails);*/ /*die;*/

            $user_id = $productDetails['user_id'];
            $user_email = $productDetails['user_email'];
            $name = $productDetails['name'];

            $userDetails = User::where('id',$user_id)->first();
            $userDetails = json_decode(json_encode($userDetails),true);
            /*echo "<pre>"; print_r($userDetails); die;*/
            /* Codigo Para El Email De La Orden Comienza */
            $email = $user_email;
            $messageData = [
                'email' => $email,
                'name' => $name,
                'order_id' => $order_id,
                'productDetails' => $productDetails,
                'userDetails' => $userDetails
            ];
            Mail::send('emails.order',$messageData,function($message) use($email){
                $message->to($email)->subject('Orden realizada - FRUTEXCO');
            });

           /* Codigo Para El Email De La Orden Termina */

            // Empty Cart
            DB::table('cart')->where('user_email',$user_email)->delete();
        }
    }

    public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        /*$orders = json_decode(json_encode($orders));
        echo "<pre>"; print_r($orders); die;*/
        return view('orders.user_orders')->with(compact('orders'));
    }

    public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        /*echo "<pre>"; print_r($orderDetails); die;*/
        return view('orders.user_order_details')->with(compact('orderDetails'));
    }

    public function viewOrders(){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        $orders = json_decode(json_encode($orders));

        /*echo "<pre>"; print_r($orders); die;*/
        return view('admin.orders.view_orders')->with(compact('orders'));
    }

    public function viewOrderDetails($order_id){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        /*echo "<pre>"; print_r($orderDetails); die;*/
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        $products = Product::get();
        /*$userDetails = json_decode(json_encode($userDetails));
        echo "<pre>"; print_r($userDetails);*/
        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails','products'));
    }

    public function viewOrderInvoice($order_id){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        /*echo "<pre>"; print_r($orderDetails); die;*/
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        /*$userDetails = json_decode(json_encode($userDetails));
        echo "<pre>"; print_r($userDetails);*/
        return view('admin.orders.order_invoice')->with(compact('orderDetails','userDetails'));
    }

    public function viewPDFInvoice($order_id){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        /*echo "<pre>"; print_r($orderDetails); die;*/
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        /*$userDetails = json_decode(json_encode($userDetails));
        echo "<pre>"; print_r($userDetails);*/

        $output = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Frutexco</title>
    <style>
    .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;
  height: 29.7cm;
  margin: 0 auto;
  color: #001028;
  background: #FFFFFF;
  font-family: "Montserrat", sans-serif;
  font-size: 12px;
  font-family: "Montserrat";
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="images/backend_images/FRUTEXCO.png">
      </div>
      <h1>Factura '.$orderDetails->id.'</h1>
      <div id="project" class="clearfix">
        <div><span>ID de la orden</span> '.$orderDetails->id.'</div>
        <div><span>Fecha de orden</span> '.$orderDetails->created_at.'</div>
        <div><span>Estado de orden</span> '.$orderDetails->order_status.'</div>
        <div><span>Metodo de pago</span> '.$orderDetails->payment_method.'</div>
      </div>
      <div id="project" style="float:right;">
        <div><strong>Direccion De Envio</strong></div>
        <div>'.$orderDetails->name.'</div>
        <div>'.$orderDetails->address.'</div>
        <div>'.$orderDetails->city.', '.$orderDetails->state.'</div>
        <div>'.$orderDetails->pincode.'</div>
        <div>'.$orderDetails->country.'</div>
        <div>'.$orderDetails->mobile.'</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
            <tr>
                <td style="width:18%"><strong>Codigo del producto</strong></td>
                <td style="width:18%" class="text-center"><strong>Tipo de envio</strong></td>

                <td style="width:18%" class="text-center"><strong>Precio</strong></td>
                <td style="width:18%" class="text-center"><strong>Cantidad</strong></td>
                <td style="width:18%" class="text-right"><strong>Total</strong></td>
            </tr>
        </thead>
        <tbody>';
        $Subtotal = 0;
        foreach($orderDetails->orders as $pro){
            $output .= '<tr>
                <td class="text-left">'.$pro->product_code.'</td>
                <td class="text-center">'.$pro->product_size.'</td>

                <td class="text-center">USD '.$pro->product_price.'$</td>
                <td class="text-center">'.$pro->product_qty.'</td>
                <td class="text-right">USD '.$pro->product_price * $pro->product_qty.'$</td>
            </tr>';
            $Subtotal = $Subtotal + ($pro->product_price * $pro->product_qty); }
        $output .= '<tr>
            <td colspan="5">Total</td>
            <td class="total">USD '.$Subtotal.'$</td>
          </tr>

        </tbody>
      </table>
    </main>
    <footer>
      Este documento es una factura generada por el sistema de Frutexco.
    </footer>
  </body>
</html>';

    // instanciar y usar la clase dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($output);

    // (Opcional) Configurar el tamaño y la orientación del papel
    $dompdf->setPaper('A4', 'landscape');

    // Renderizar el HTML como PDF
    $dompdf->render();

    // Salida del PDF generado al navegador
    $dompdf->stream();

}

    public function updateOrderStatus(Request $request){
        if(Session::get('adminDetails')['orders_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','No tienes acceso ha este modulo');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('flash_message_success','El estado de la cotizacion ha sido actualizado correctamente!');
        }
    }

    /*public function checkPincode(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            echo $pincodeCount = DB::table('pincodes')->where('pincode',$data['pincode'])->count();
        }
    }*/

    public function exportProducts(){
        return Excel::download(new productsExport,'Productos.xlsx');
    }

    public function deleteWishlistProduct($id){
        DB::table('wish_list')->where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','El producto ha sido eliminado de la lista de deseos');
    }

    public function viewOrdersCharts(){
        $current_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $last_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        return view('admin.products.view_orders_charts')->with(compact('current_month_orders','last_month_orders','last_to_last_month_orders'));
    }

}
