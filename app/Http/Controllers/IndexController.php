<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Banner;
use App\User;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    public function index(){

    	// Obtiene Todos Los Productos
		$productsAll = Product::inRandomOrder()->where('status',1)->where('feature_item',1)->paginate(9);
		
		$productsUltimate = Product::where('status',1)->orderBy('id','Desc')->paginate(4);

    	/*$productsAll = json_decode(json_encode($productsAll));*/
    	/*dump($productsAll);*/
    	/*echo "<pre>"; print_r($productsAll);die;*/


    	// Obtiene Todas Las Categorias Y SubCategorias
    	$categories_menu = "";
    	$categories = Category::with('categories')->where(['parent_id' => 0])->get();
    	$categories = json_decode(json_encode($categories));
    	/*echo "<pre>"; print_r($categories); die;*/
		foreach($categories as $cat){
			$categories_menu .= "
			<div class='panel-heading'>
				<h4 class='panel-title'>
					<a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
						<span class='badge pull-right'><i class='fa fa-plus'></i></span>
						".$cat->name."
					</a>
				</h4>
			</div>
			<div id='".$cat->id."' class='panel-collapse collapse'>
				<div class='panel-body'>
					<ul>";
					$sub_categories = Category::where(['parent_id' => $cat->id])->get();
					foreach($sub_categories as $sub_cat){
						$categories_menu .= "<li><a href='#'>".$sub_cat->name." </a></li>";
					}
						$categories_menu .= "</ul>
				</div>
			</div>
			";
        }




		$banners = Banner::where('status','1')->get();
		// Meta Tags
		$meta_title = "Frutexcp";
		$meta_description = "Exportadora De Frutas";
		$meta_keywords = "frutas, compra online";
    	return view('index')->with(compact('productsAll','productsUltimate','categories_menu','categories','banners','meta_title','meta_description','meta_keywords'));
    }
}
