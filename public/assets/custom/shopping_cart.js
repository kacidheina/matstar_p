function notification_handler(state,message)
{
    var notification;
    var random_id =Math.floor((Math.random() * 10000) + 1);
    if(state)
    {
        notification = '<div id="'+random_id+'" class="toast toast-error"> <div id="toast-container-js-title"class="toast-title"></div> Error <div id="toast-container-js-message" class="toast-message">'+message+'</div> </div>';
        $('#toast-container').append(notification);
    }
    else
    {
        notification = '<div id="'+random_id+'" class="toast toast-success"> <div id="toast-container-js-title"class="toast-title"></div> Error <div id="toast-container-js-message" class="toast-message">'+message+'</div> </div>';
        $('#toast-container').append(notification);
    }
    setTimeout(function() { $("#"+random_id+"").fadeOut('slow', function() { $(this).remove(); });}, 3000);

}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$( "#add_new_client" ).click(function() {
    $('#basic').modal('show');

});
$( "#add_client_form_modal" ).submit(function(e) {
    e.preventDefault();

    if($(this).valid() != false)
    {
        var formData = {
            name:$("input[name=name]").val(),
            phone:$("input[name=phone]").val(),
            city:$("input[name=city]").val(),
            nipt:$("input[name=nipt]").val()
        };

        $.ajax({
            type: 'POST',
            url: super_path+'/add_client_ajax',
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content")
            },
            success: function (data)
            {
                notification_handler(false,data['message']);
                $('#client_dropdown').append('<option value="'+data.data['id']+'" selected>'+data.data['name']+'</option>').trigger("change");
                $('#basic').modal('hide');
                $("input[name=name]").val("");
                $("input[name=phone]").val("");
                $("input[name=city]").val("");
                $("input[name=nipt]").val("");

            },
            error: function (data) {
                notification_handler(true,data['message']);
                console.log(data);
            }
        });
    }

});

var shopping_cart = [];

function add_item_to_cart(id,code,price) {
    $('#shopping_cart_table').append(
        '<tr id="item_'+id+'"> '+
        '<td class="cart_item_code">'+code+'</td>'+
        '<td class="cart_item_price">'+price+'</td>'+
        '<td><input type="text" style="text-align: center" class="cart_item_quantity" data-id="'+id+'" data-value="1" onkeypress="return isNumber(event)" ></td>'+
        '<td class="cart_item_total">'+price+'</td>'+
        '<td style="text-align:center;"><a class="btn btn-sm red cart_item_delete" data-content="'+id+'"><i class="fa fa-trash"></i></a></td>'+
        '</tr>');
    var total_cart_price = $('#cart_total_price');
    var total_cart_price_float = parseFloat(total_cart_price.text());
    total_cart_price_float = parseFloat(price) + total_cart_price_float;
    total_cart_price.text(total_cart_price_float);
    shopping_cart.push({'id':id,'quantity':1 , 'price':price , 'total':price});
}

function remove_item_from_cart(id,total) {

}

function update_cart(id,quantity) {
    var result = $.grep(shopping_cart, function(e){ return e.id == id; })[0];
    console.log(result);
    console.log(quantity);
}

$( "#product_dorpdown" ).on('change', function () {
    var data = $(this).select2().find(":selected").data("content");

    $('#small').modal('show');

    add_item_to_cart(data.id,data.code,data.price_customer);

});


$(document).on('keyup', $('.cart_item_quantity'), function()
{
    var item = $('.cart_item_quantity');
    update_cart(item.attr('data-id'),item.val());
});