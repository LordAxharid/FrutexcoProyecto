@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
 
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
    <h1>Productos</h1>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Editar producto</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/edit-product/'.$productDetails->id) }}" name="edit_product" id="edit_product" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Poner en categoría</label>
                <div class="controls">
                  <select name="category_id" id="category_id" style="width:220px;">
                    <?php echo $categories_drop_down; ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nombre producto</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" value="{{ $productDetails->product_name }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Código producto</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" value="{{ $productDetails->product_code }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Color producto</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color" value="{{ $productDetails->product_color }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Descripción</label>
                <div class="controls">
                  <textarea name="description" class="textarea_editor span12">{{ $productDetails->description }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Cuidados</label>
                <div class="controls">
                  <textarea name="care" class="textarea_care span12">{{ $productDetails->care }}</textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Presentación caja</label>
                <div class="controls">
                  <input type="text" name="sleeve" id="sleeve" value="{{ $productDetails->sleeve }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Cantidades aprox por kilo</label>
                <div class="controls">
                  <input type="text" name="pattern" id="pattern" value="{{ $productDetails->pattern }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Precio</label>
                <div class="controls">
                  <input type="text" name="price" id="price" value="{{ $productDetails->price }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Peso(kg)</label>
                <div class="controls">
                  <input type="text" name="weight" id="weight" value="{{ $productDetails->weight }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Imagen</label>
                <div class="controls">
                  <div id="uniform-undefined">
                    <table>
                      <tr>
                        <td>
                          <input name="image" id="image" type="file">
                          @if(!empty($productDetails->image))
                            <input type="hidden" name="current_image" value="{{ $productDetails->image }}">
                          @endif
                        </td>
                        <td>
                          @if(!empty($productDetails->image))
                            <img style="width:30px;" src="{{ asset('/images/backend_images/product/small/'.$productDetails->image) }}"> | <a href="{{ url('/admin/delete-product-image/'.$productDetails->id) }}">Eliminar</a>
                          @endif
                        </td>
                      </tr>
                    </table>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Video</label>
                <div class="controls">
                  <div id="uniform-undefined">
                    <input name="video" id="video" type="file">
                    @if(!empty($productDetails->video))
                      <input type="hidden" name="current_video" value="{{ $productDetails->video }}">
                      <a target="_blank" href="{{ url('videos/'.$productDetails->video) }}">Ver</a> |
                      <a href="{{ url('/admin/delete-product-video/'.$productDetails->id) }}">Eliminar</a>
                    @endif
                  </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Producto destacado</label>
                <div class="controls">
                  <input type="checkbox" name="feature_item" id="feature_item" @if($productDetails->feature_item == "1") checked @endif value="1">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Habilitado</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($productDetails->status == "1") checked @endif value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Editar Producto" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
