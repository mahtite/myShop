$(document).ready(function () {


    /**************** Increment/Decrement/Button *************/

    var quantitiy = 1;
    $('.quantity-right-minus').click(function (e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        if (quantity > 1) {
            $('#quantity').val(quantity - 1);
        }
    });

    $('.quantity-left-plus').click(function (e) {
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        $('#quantity').val(quantity + 1);
    });

});
    /*****************************************************/



    /*$(document).on('click', '#update_data', function (e) {

        var url = "{{URL('carts/'.$carts->id)}}";
        var id=
            $.ajax({
                url: url,
                type: "PATCH",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                   id: $("#cart").val(),
                    quantity: $('#quantity').val(),
                },
                success: function (dataResult) {
                    window.location.reload();
                }
                ,error:function (error) {
                    console.log(error);
                }
            });
    });
});


    // alert("u");

       /* e.preventDefault();

        var url= "/update-cart";

        var ele = $(this);

        $.ajax({
            url: url,
            type: "PATCH",
            cache: false,
            //dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success:function (r) {
                window.location.reload();
            },
            error:function (error) {
                console.log(error);
            }
        })*/











   /* const getparent=function(evt,tag){
        let n=evt.target;
        while( n.tagName.toLowerCase()!==tag ) {
            if( n.nodeName==='BODY' )return false;
            n=n.parentNode;
        }
        return n;
    }

    $(document).on('click','.qty',function (e) {
       // alert("u");

        e.preventDefault();

        let parent=getparent(e,'tr');
        var quantity = e.target.value;
        var id = parent.querySelector('td input[ name="cart_id" ]').value;

        $.ajax({
            url: "/update-cart",
            method: "get",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                quantity: quantity,
                id: id
            },
            success:function (r) {
                window.location.reload();
            },
            error:function (error) {
                console.log(error);
            }
        })*/



        /*$.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });*/


          /*  var ele = $(this);

            $.ajax({
                url:'/update-cart',
                method: "get",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });*/
    /**************************************************************/
       /* e.preventDefault();
        var $form = $('.myform');
        //var user=$('#userLog').val();
        var  qty = $("#quantity").val();
        var    url = $form.attr("action");
        var id=$("#quantity").val();
        alert(id);
      //  var _token  = $('meta[name="csrf-token"]').attr('content');


        $.ajax({
            url:url,
            type:"POST",
            data:{
                qty:qty,
                id:id,
                _token: '{{ csrf_token() }}'
            },
            success:function(response){
                console.log(response);
                if(response) {
                    console.log(response)
                }
            },
            error: function(error) {
                console.log(error);
            }
        });*/



/*********************************************************/
   /* $(document).on('click', '.qty', function (e) {
        e.preventDefault();

        var $form = $(this),
            quantity = $(this).val(),
            product_id=$('.proid').val(),
            token = "{{ csrf_token() }}";
            url = ($form).attr("action");

            $.ajax({
            url:url,
            method:"post",

            data: {
                _token: "{{ csrf_token() }}",
                quantity: quantity,
                product_id:product_id
            },
            success:function (r) {
                console.log(r);
            },
            error:function (error)
            {
                console.log(error);
            }
        });
    });*/

