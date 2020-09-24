@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
 
<div class="container-fluid">
  <div class="topbar-bottom-colors">
      <i style="background-color: #9857b2;"></i>
      <i style="background-color: #2c81ba;"></i>
      <i style="background-color: #5dc12e;"></i>
      <i style="background-color: #feb506;"></i>
      <i style="background-color: #e17c21;"></i>
      <i style="background-color: #bc382a;"></i>
      <i style="background-color: #2c3e50;"></i>
    </div>
    <hr>
    <h3>Productos</h3>
    <hr>
    @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
  
  <div style="margin-left:20px;">
    <a href="{{ url('/admin/export-products') }}" class="btn btn-primary btn-mini">Exportar Productos</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Productos</h5>
          </div>
          <div class="widget-content nopadding table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Categoría</th>
                  <th>Nombre categoría</th>
                  <th>Producto</th>
                  <th>Código </th>
                  <th>Color </th>
                  <th>Presentación </th>
                  <th>Cantidades por kilo</th>
                  <th>Precio</th>
                  <th>Imagen</th>
                  <th>Destacado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($products as $product)
                <tr class="gradeX">
                  <td class="center">{{ $product->id }}</td>
                  <td class="center">{{ $product->category_id }}</td>
                  <td class="center">{{ $product->category_name }}</td>
                  <td class="center">{{ $product->product_name }}</td>
                  <td class="center">{{ $product->product_code }} <?php echo DNS2D::getBarcodeHTML($product->product_code, "QRCODE",2,2); ?> </td>
                  <td class="center">{{ $product->product_color }}</td>
                  <td class="center">{{ $product->sleeve }}</td>
                  <td class="center">{{ $product->pattern }}</td>
                  <td class="center">USD {{ $product->price }}</td>
                  <td class="center">
                    @if(!empty($product->image))
                    <img src="{{ asset('/images/backend_images/product/small/'.$product->image) }}" style="width:50px;">
                    @endif
                  </td>
                  <td class="center">@if($product->feature_item == 1) SI @else NO @endif</td>
                  <td class="center">
                    <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini"><i class="mdi mdi-image-filter-vintage"></i></a>
                    
                        <div id="myModal{{ $product->id }}" class="modal hide">
                          <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button" style="color:red;">×</button>
                            <h3 style="color:black; font-size: 20px;">Acciones {{ $product->product_name }}<br>
                            <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-mini"><i class="mdi mdi-lead-pencil"></i></a>Editar<br><br>
                            <a href="{{ url('/admin/add-attributes/'.$product->id) }}" class="btn btn-success btn-mini"><i class="mdi mdi-library-plus"></i></a>Agregar característica<br><br>
                            <a href="{{ url('/admin/add-images/'.$product->id) }}" class="btn btn-info btn-mini"><i class="mdi mdi-folder-multiple-image"></i></a>Agregar imagen<br><br>
                            <a id="delProduct" rel="{{ $product->id }}" rel1="delete-product" href="javascript:" class="btn btn-danger btn-mini deleteRecord"><i class="mdi mdi-delete-forever"></i></a>Eliminar<br>
                            <button data-dismiss="modal" class="close" type="button" style="color:blue;">Cerrar</button></h3><br><br>
                           
                          </div>
                        
                        </div>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

