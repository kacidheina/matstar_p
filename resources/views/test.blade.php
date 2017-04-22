<div class="modal fade" id="add_new_client" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Shto Klient te Ri</h4>
            </div>
            <div class="modal-body">
                <form action="{{url('add_client')}}" id="add_client_form" method="post" class="form-horizontal">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Emer & Mbiemer
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="name"  data-required="1" class="form-control" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Numer Telefoni
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="phone"  data-required="1" class="form-control" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Qyteti
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="city"  data-required="1" class="form-control" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nipt.
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="nipt"  data-required="1" class="form-control" /> </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal"id="close_add_client_modal">Mbyll</button>
                        <button type="submit" class="btn green" id="save_client">Ruaj</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>