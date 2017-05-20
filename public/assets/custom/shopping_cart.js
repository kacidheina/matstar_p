
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$("#add_new_client").click(function () {
    $('#basic').modal('show');
});


$("#add_client_form_modal").submit(function (e) {
    e.preventDefault();

    if ($(this).valid() != false) {
        var formData = {
            name: $("input[name=name]").val(),
            phone: $("input[name=phone]").val(),
            city: $("input[name=city]").val(),
            nipt: $("input[name=nipt]").val()
        };

        $.ajax({
            type: 'POST',
            url: super_path + '/add_client',
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content")
            },
            success: function (data) {
                notification_handler('success', data['message']);
                $('#client_dropdown').append('<option value="' + data.data['id'] + '" selected>' + data.data['name'] + '</option>').trigger("change");
                $('#basic').modal('hide');
                $("input[name=name]").val("");
                $("input[name=phone]").val("");
                $("input[name=city]").val("");
                $("input[name=nipt]").val("");

            },
            error: function (data) {
                notification_handler('error', data['message']);
            }
        });
    }

});

var shopping_cart = [];
var selected_product_code;
var empty_table_row = '<div class="empty_row"> <b>Nuk ka produkte.</b></div>';

function manage_empty_row(cart) {
    if (cart.length > 0) {
        $('.empty_row').remove();
    }
    else {
        $('#table_container').append(empty_table_row);
    }
}

function add_item_to_cart(id, code, price,size,color,color_code,color_id) {
    var was_found = false;

    console.log('searching for :'+id);
    for (var i in shopping_cart) {

        console.log('found :'+shopping_cart[i].id);
        if (shopping_cart[i].id === id) {
            was_found = true;
            break;
        }
        else
        { was_found = false;}
    }
    console.log(was_found);
    if (!was_found)
    {
        $('#shopping_cart_table').append(
            '<tr id="item_' + id + '"> ' +
            '<td class="cart_item_code">Kodi: <strong>' + code + '</strong><br>Numer: <strong>' + size + '</strong><br>Ngjyra: <strong>' + color + '</strong></td>' +
            '<td class="cart_item_price"><input type="text" style="text-align: center" class="col-md-12 cart_item_original_price" onkeyup="change_item_price(\'' + id + '\',$(this).val())"  value="' + price + '" onkeypress="return isNumber(event)" ></td>' +
            '<td><input type="text" style="text-align: center" class="col-md-12 cart_item_quantity" onkeyup="update_cart(\'' + id + '\',$(this).val())" id="cart_item_quantity_' + id + '" data-value="1"  value="1" onkeypress="return isNumber(event)" ></td>' +
            '<td class="cart_item_total" id="item_' + id + '_total">' + price + '</td>' +
            '<td style="text-align:center;"><a class="btn btn-sm red cart_item_delete" onclick="remove_item_from_cart(\''+id+'\')" data-content="' + id + '"><i class="fa fa-trash"></i></a></td>' +
            '</tr>');

        var total_cart_price = $('#cart_total_price');

        var total_cart_price_float = parseFloat(total_cart_price.text());
        total_cart_price_float = parseFloat(price) + total_cart_price_float;
        total_cart_price.text(total_cart_price_float.toFixed(2));


        shopping_cart.push({'id': id, 'quantity': 1, 'price': Number(price), 'total': Number(price), 'color': color_id, 'size': Number(size)});

        get_rest_debt($('#client_paid_input'));
        manage_empty_row(shopping_cart);
    }
    console.log(shopping_cart);
}

function get_rest_debt(element) {
    var cart_total = 0;
    for (var y in shopping_cart) {
        cart_total = cart_total + Number(shopping_cart[y].total);
    }
    var payment = element.val();
    $('#client_paid_final_form').val(Number(payment));
    var difference = Number(payment) - Number(cart_total);

    if (difference > 0) {
        $('#cart_rest').html(difference.toFixed(2));
        $('#cart_debit').html(0);
    }
    else {
        $('#cart_debit').html(difference.toFixed(2));
        $('#cart_rest').html(0);
    }

}

function remove_item_from_cart(id) {

    for (var i in shopping_cart) {
        if (shopping_cart[i].id == id) {
            shopping_cart.splice(Number(i), 1);
            break;
        }
    }
    $('#item_' + id).remove();

    var cart_total = 0;
    for (var y in shopping_cart) {
        cart_total = cart_total + Number(shopping_cart[y].total);
    }

    $('#cart_total_price').html(Number(cart_total).toFixed(2));
    get_rest_debt($('#client_paid_input'));
    manage_empty_row(shopping_cart);

}

function change_item_price(id, new_price) {

    var quantity = Number($('#cart_item_quantity_' + id).val());

    if (quantity != '' || quantity != 0) {
        for (var i in shopping_cart) {
            if (shopping_cart[i].id == id) {
                shopping_cart[i].price = Number(new_price);
                var price = Number(new_price);
                shopping_cart[i].quantity = Number(quantity);
                shopping_cart[i].total = (price * Number(quantity)).toFixed(2);
                break;
            }
        }

        $('#item_' + id + '_total').html((price * Number(quantity)).toFixed(2));
    }

    var cart_total = 0;
    for (var y in shopping_cart) {
        cart_total = cart_total + Number(shopping_cart[y].total);
    }

    $('#cart_total_price').html(Number(cart_total).toFixed(2));
    get_rest_debt($('#client_paid_input'));
}


function update_cart(id, quantity) {

    if (quantity != '' || quantity != 0) {
        for (var i in shopping_cart) {
            if (shopping_cart[i].id == id) {
                var price = shopping_cart[i].price;
                shopping_cart[i].quantity = Number(quantity);
                shopping_cart[i].total = (price * Number(quantity)).toFixed(2);
                break;
            }
        }

        $('#item_' + id + '_total').html((price * Number(quantity)).toFixed(2));
    }

    var cart_total = 0;
    for (var y in shopping_cart) {
        cart_total = cart_total + Number(shopping_cart[y].total);
    }

    $('#cart_total_price').html(Number(cart_total).toFixed(2));
    get_rest_debt($('#client_paid_input'));
}


$("#product_dorpdown").on('change', function () {
    // var id = $(this).select2().find(":selected").val();
    var product_details = JSON.parse($(this).val());
    selected_product_code = product_details['details']['code'];
    var id = product_details.id;
    if(id != '')
    {
        $.ajax(
            {
                url: super_path + '/get_product_variations/'+id,
                type: 'GET',
                success: function (data) {
                    if (data['error'] != true)
                    {
                        var color_dd = $("#variation_dropdown");
                        color_dd .empty();
                        var data_array = $.map(data.data, function(value, index) {
                            return [value];
                        });


                        for (var i = 0; i < data_array.length;i ++ )
                        {
                            for (var y = 0; y < data_array[i].length;y ++ )
                            {
                                var nested_array = $.map(data_array[i][y], function(value, index) {
                                    return [value];
                                });

                                for (var z = 0; z < nested_array.length;z ++ )
                                {   var color_code = nested_array[z].color_code;
                                    color_dd.append(' <option  value="'+id+'-'+nested_array[z].size+'-'+color_code.replace(/^#+/i, '')+'"  data-special=\'{"color_id" : "'+nested_array[z].color_id+'","color" : "'+nested_array[z].color_name+'","color_code" : "'+nested_array[z].color_code+'","size" : "'+nested_array[z].size+'","price" : '+nested_array[z].total_price+'}\'  data-content="Numri: <strong>'+nested_array[z].size+'</strong> <br>Mbetur: <strong>'+nested_array[z].stock+'</strong> Cope <br> Ngjyra : <strong>'+nested_array[z].color_name+'</strong><br> Cmimi Mesatar : <strong>'+nested_array[z].total_price+'</strong> LEK <span class=\'label color_dd\' style=\'background-color:'+nested_array[z].color_code+';color:'+nested_array[z].color_code+'\'>.</span>"> </option>');
                                    color_dd.selectpicker("refresh");
                                }
                            }
                        }
                    }
                    else
                    {
                        notification_handler('error', data['message']);
                    }
                },
                error:function () {
                    notification_handler('error', 'Dicka shkoi gabim. Ju lutem provoni perseri.');
                }
            });
    }
});


function selectIdDecomposer(composed_id) {
    var data =  composed_id.split("-");
    return {prod_id:data[0], size:data[1], color:'#'+data[2]};
}

$("#variation_dropdown").on('change',function(){
    var selected = $('#variation_dropdown').find('option:selected').val();
    var data = selectIdDecomposer(selected);
    var details = JSON.parse($('#variation_dropdown').find('option:selected').attr('data-special'));
    add_item_to_cart(selected, selected_product_code, details.price,details.size,details.color,details.color_code,details.color_id);
});


$("#submit_order").on('click', function (e) {

    if (shopping_cart.length === 0) {
        notification_handler('error', 'Ju nuk keni zgjedhur asnje produkt.');
    }
    else if (!$("#client_dropdown").val()) {
        notification_handler('error', 'Ju nuk keni zgjedhur klientin.');
    }
    else {
        $('#cart_details').val(JSON.stringify(shopping_cart));
        $("#add_order_form").submit();
    }

});


function print_bill() {
    $('#print_area').printThis({
        debug: false,               // show the iframe for debugging
        importCSS: true,            // import page CSS
        importStyle: true,          // import style tags
        printContainer: true,       // grab outer container as well as the contents of the selector // path to additional css file - use an array [] for multiple
        removeInline: false,        // remove all inline styles from print elements
        printDelay: 333,            // variable print delay; depending on complexity a higher value may be necessary
        header: null,               // prefix to html
        footer: null,               // postfix to html
        base: false,               // preserve the BASE tag, or accept a string for the URL
        formValues: true,           // preserve input/form values
        canvas: false,             // copy canvas elements (experimental)
        loadCSS: "../pages/css/invoice-2.min.css"  // path to additional css file - us an array [] for multiple
    });
}

