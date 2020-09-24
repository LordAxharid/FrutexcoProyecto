@extends('layouts.frontLayout.front_design')

@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--Caracteristicas de los articulos-->
					<h2 class="title text-center">{{ $cmsPageDetails->title }}</h2>
					<p>{{ $cmsPageDetails->description }}</p>
				</div><!--Final Caracteristicas de los articulos-->
			</div>
		</div>
	</div>

	
</section>

@endsection
