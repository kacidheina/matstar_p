<form action="{{url('add_product')}}" id="add_product_form" method="post" class="form-horizontal">
    {{csrf_field()}}
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-3">Kategoria
                <span class="required"> * </span>
            </label>
            <div class="col-md-5">
                <select class="form-control" name="category">
                    <option value="">Zgjidh...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Emertimi
                <span class="required"> * </span>
            </label>
            <div class="col-md-5">
                <input type="text" name="name"  data-required="1" class="form-control" placeholder="Vendos kodin e artikullit" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Kodi
                <span class="required"> * </span>
            </label>
            <div class="col-md-5">
                <input type="text" name="code"  data-required="1" class="form-control" placeholder="Vendos kodin e artikullit" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Pershkrim
            </label>
            <div class="col-md-9">
                <textarea class="wysihtml5 form-control" rows="6" name="description" data-error-container="#editor1_error" placeholder="Pershkrim per artikullin"></textarea>
                <div id="editor1_error"> </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Shenim
            </label>
            <div class="col-md-9">
                <textarea class="wysihtml5 form-control" rows="6" name="note" data-error-container="#editor2_error" placeholder="Shenim per artikullin"></textarea>
                <div id="editor2_error"> </div>
            </div>
        </div>
    </div>
    <div class="form-body">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn green">Ruaj</button>
            </div>
        </div>
    </div>
</form>