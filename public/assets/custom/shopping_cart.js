function notification_handler(state, message) {
    var notification;
    var random_id = Math.floor((Math.random() * 10000) + 1);

    notification = '<div id="' + random_id + '" class="toast toast-' + state + '"> <div id="toast-container-js-title"class="toast-title"></div> Error <div id="toast-container-js-message" class="toast-message">' + message + '</div> </div>';
    $('#toast-container').append(notification);
    setTimeout(function () {
        $("#" + random_id + "").fadeOut('slow', function () {
            $(this).remove();
        });
    }, 3000);
}

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
            url: super_path + '/add_client_ajax',
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
                console.log(data);
            }
        });
    }

});

var shopping_cart = [];


var empty_table_row = '<div class="empty_row"> <b>Nuk ka produkte.</b></div>';

function manage_empty_row(cart) {
    if (cart.length > 0) {
        $('.empty_row').remove();
    }
    else {
        $('#table_container').append(empty_table_row);
    }
}

function add_item_to_cart(id, code, price) {

    $('#shopping_cart_table').append(
        '<tr id="item_' + id + '"> ' +
        '<td class="cart_item_code">' + code + '</td>' +
        '<td class="cart_item_price"><input type="text" style="text-align: center" class="col-md-12 cart_item_original_price" onkeyup="change_item_price(' + id + ',$(this).val())"  value="' + price + '" onkeypress="return isNumber(event)" ></td>' +
        '<td><input type="text" style="text-align: center" class="col-md-12 cart_item_quantity" onkeyup="update_cart(' + id + ',$(this).val())" id="cart_item_quantity_' + id + '" data-value="1"  value="1" onkeypress="return isNumber(event)" ></td>' +
        '<td class="cart_item_total" id="item_' + id + '_total">' + price + '</td>' +
        '<td style="text-align:center;"><a class="btn btn-sm red cart_item_delete" onclick="remove_item_from_cart(' + id + ')" data-content="' + id + '"><i class="fa fa-trash"></i></a></td>' +
        '</tr>');

    var total_cart_price = $('#cart_total_price');

    var total_cart_price_float = parseFloat(total_cart_price.text());
    total_cart_price_float = parseFloat(price) + total_cart_price_float;
    total_cart_price.text(total_cart_price_float.toFixed(2));
    shopping_cart.push({'id': id, 'quantity': 1, 'price': Number(price), 'total': Number(price)});

    get_rest_debt($('#client_paid_input'));
    manage_empty_row(shopping_cart);
}

function get_rest_debt(element) {
    var cart_total = 0;
    for (var y in shopping_cart) {
        cart_total = cart_total + Number(shopping_cart[y].total);
    }
    var payment = element.val();
    var difference = Number(payment) - Number(cart_total);

    if (difference > 0) {
        $('#cart_rest').html(difference);
        $('#cart_debit').html(0);
    }
    else {
        $('#cart_debit').html(difference);
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
    var data = $(this).select2().find(":selected").data("content");
    add_item_to_cart(data.id, data.code, data.price_total);

});


$("#submit_order").on('click', function () {

    $('#cart_details').val(JSON.stringify(shopping_cart));
    $('#client_paid_final_form').val($('#cart_client_paid').val());
    if (shopping_cart.length === 0) {
        notification_handler('error', 'Ju nuk keni zgjedhur asnje produkt.');
    }
    else if (!$("#client_dropdown").val()) {
        notification_handler('error', 'Ju nuk keni zgjedhur klientin.');
    }
    else {
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