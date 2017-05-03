
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
var empty_table_row =  '<tr id="empty_row"> '+
    '<td style="border-right: 0; "></td>'+
    '<td style="border-right: 0;border-left: 0"></td>'+
    '<td style="border-right: 0;border-left: 0"> Nuk ka artikuj.</td>'+
    '<td style="border-right: 0;border-left: 0"></td>'+
    '<td style="border-left: 0; "></td>'+
    '</tr>';

function add_item_to_cart(id,code,price) {

    $('#shopping_cart_table').append(
        '<tr id="item_'+id+'"> '+
        '<td class="cart_item_code">'+code+'</td>'+
        '<td class="cart_item_price">'+price+'</td>'+
        '<td><input type="text" style="text-align: center" class="cart_item_quantity" onkeyup="update_cart('+id+',$(this))" data-id="'+id+'" data-value="1"  value="1" onkeypress="return isNumber(event)" ></td>'+
        '<td class="cart_item_total" id="item_'+id+'_total">'+price+'</td>'+
        '<td style="text-align:center;"><a class="btn btn-sm red cart_item_delete" onclick="remove_item_from_cart('+id+')" data-content="'+id+'"><i class="fa fa-trash"></i></a></td>'+
        '</tr>');
    var total_cart_price = $('#cart_total_price');
    var cart_client_paid = $('#cart_client_paid').append('<input type="text" onkeyup="get_rest_debt($(this))" style="text-align: center" data-id="'+id+'"  onkeypress="return isNumber(event)" >');

    var total_cart_price_float = parseFloat(total_cart_price.text());
    total_cart_price_float = parseFloat(price) + total_cart_price_float;
    total_cart_price.text(total_cart_price_float.toFixed(2));
    shopping_cart.push({'id':id,'quantity':1 , 'price':Number(price) , 'total':Number(price)});

}

function get_rest_debt(t) {

    var total = $('#cart_total_price').text();
    var client_paid = $(t).val();
    var resto = Number(client_paid) - Number(total);

    if(resto > 0)
    {
        $('#cart_rest').html('<button type="button" class="btn btn-success">'+resto+'</button>');
        $('#cart_debit').html('<button type="button" class="btn btn-danger">0</button>');
    }else {

        $('#cart_rest').html('<button type="button" class="btn btn-success">0</button>');
        $('#cart_debit').html('<button type="button" class="btn btn-danger">'+resto+'</button>');
    }

}

function remove_item_from_cart(id) {

    for (var i in shopping_cart) {
        if (shopping_cart[i].id == id) {
            shopping_cart.splice(Number(i), 1);
            break;
        }
    }
    $('#item_'+id).remove();

    var cart_total = 0;
    for (var y in shopping_cart) {
        cart_total = cart_total +  Number(shopping_cart[y].total) ;
    }

    $('#cart_total_price').html(Number(cart_total).toFixed(2));
}

function update_cart(id,element) {
    var quantity = element.val();

    if(quantity !='' || quantity !=0)
    {
        for (var i in shopping_cart) {
            if (shopping_cart[i].id == id) {
                var price = shopping_cart[i].price;
                shopping_cart[i].quantity = Number(quantity);
                shopping_cart[i].total = (price * Number(quantity)).toFixed(2);
                break;
            }
        }

        $('#item_'+id+'_total').html((price * Number(quantity)).toFixed(2));
    }

    var cart_total = 0;
    for (var y in shopping_cart) {
        cart_total = cart_total +  Number(shopping_cart[y].total) ;
    }

    $('#cart_total_price').html(Number(cart_total).toFixed(2));

    console.log(shopping_cart[0]);
}

$( "#product_dorpdown" ).on('change', function () {
    var data = $(this).select2().find(":selected").data("content");
    add_item_to_cart(data.id,data.code,data.price_total);

});
