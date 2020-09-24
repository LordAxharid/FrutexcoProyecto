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
    <h3>Productos</h3>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Agregar producto</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/add-product') }}" name="add_product" id="add_product" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Poner en la categoria</label>
                <div class="controls">
                  <select name="category_id" id="category_id" style="width:220px;">
                    <?php echo $categories_drop_down; ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nombre producto</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Código producto</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Color producto</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Descripción</label>
                <div class="controls">
                  <textarea name="description" class="textarea_editor span12"></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Cuidados</label>
                <div class="controls">
                  <textarea name="care" class="textarea_care span12"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Presentación caja</label>
                <div class="controls">
                  <input type="text" name="sleeve" id="sleeve">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Cantidades aprox por kilo</label>
                <div class="controls">
                  <input type="text" name="pattern" id="pattern">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Precio</label>
                <div class="controls">
                  <input type="text" name="price" id="price">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Peso(kg)</label>
                <div class="controls">
                  <input type="text" name="weight" id="weight">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Imagen</label>
                <div class="controls">
                  <div id="uniform-undefined"><input name="image" id="image" type="file"></div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Producto destacado</label>
                <div class="controls">
                  <input type="checkbox" name="feature_item" id="feature_item" value="1">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Habilitado</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Agregar producto" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
