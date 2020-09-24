@extends('layouts.frontLayout.front_design')

<?php 

use App\Http\Controllers\Controller;
use App\Product;
use App\Gallery;
$mainCategories =  Controller::mainCategories();

?>

@section('content')
<div class="blog-layout">
        <div class="container">
          <div class="row">
            <div class="col-xl-3">
              <div class="blog-sidebar">
                <button class="no-round-btn" id="filter-sidebar--closebtn">Close sidebar</button>
                <div class="blog-sidebar_search">
                  <div class="search_block">
                
                  </div>
                </div>
                <div class="blog-sidebar_categories">
                  <div class="categories_top mini-tab-title underline">
                    <h2 class="title">Categorías</h2>
                  </div>
                  <div class="categories_bottom">
                  @foreach($mainCategories as $cat)
                    <ul>
                      <li> <a class="category-link" href="{{ asset('products/'.$cat->url) }}">{{ $cat->name }}</a></li>
                    </ul>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="filter-sidebar--background" style="display: none"></div>
            </div>
            <div class="col-12 col-xl-9">
              <div class="blog-list">
                <div id="show-filter-sidebar">
                  <h5> <i class="fas fa-bars"></i>Ultimas noticias</h5>
                </div>
                @foreach($New as $nw)
                <div class="blog-block">
                  <div class="row">
                 
                    <div class="col-5">
                      <div class="blog-img"><a><img src="{{ asset('/images/frontend_images/news/'.$nw->image) }}" alt="imagen noticia"></a></div>
                    </div>
                    <div class="col-7">
                      <div class="blog-text">
                        <h5 class="blog-tag">Frutexco</h5><br><a class="blog-title" >{{$nw->title}}</a>
                        <div class="blog-credit">
                          <p class="credit date">{{$nw->created_at}}</p>
                         
                        </div>
                        <p class="blog-describe">{{ $nw->newDescription }}</p><a class="blog-readmore"><span></span></a>
                      </div>
                    </div>
                  </div>
                 
                </div>
                @endforeach
              </div>
            
            </div>
          </div>
        </div>
      </div>


	<section>

    </div>
@endsection
