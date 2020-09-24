@extends('layouts.frontLayout.front_design')

@section('content')



<div class="faq">
        <div class="container">
       

          <div id="accordion">
          @foreach($Faq as $fq)
            <div class="faq-question"><i class="icon_plus"></i>
              <h3 class="faq-question">{{$fq->ask}}</h3>
            </div>
            <div class="faq-answer">
              <p>{{ $fq->answer }}</p>
            </div>
            
            @endforeach
          </div>
         
        </div>
        
      </div>

@endsection




