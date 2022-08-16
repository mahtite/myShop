@extends('layouts.master')

@section('style')
    <style>
        select.listproduct {
            padding: 4px;
            width: 100%;
            margin: 10px 0;
            border: 1px solid lightgray;
            border-radius: 4px;
        }

        .th{width: 140px;}

        select.listproduct:focus{outline: 0;}
    </style>
@endsection

@section('content')

    <main class="cart-page default">
        <div class="container">
            <div class="row">

                <div class="col-md-6 ">
                    <select name="product[]" class="listproduct">
                        @foreach($products as $productx)
                            <option style="color: blue" value="{{ $productx->id }}" >{{ $productx->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">

                    <!--<form method="post" action=" route('compare.delete',$product->id) }}">
                        csrf
                        method('delete')
                        <button class="">
                            <i class="fa fa-remove"></i>
                        </button>
                    </form>-->


                    <table class="table table-striped" id="">
                        <tr>
                            <th></th>
                            <td>
                                    @php
                                        $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                    @endphp
                                    <img class="zoom-img" id="img-product-zoom" src="/{{ $gallery->img }}" width="300" />
                            </td>
                            <td>
                                <img src="" id="img" width="300" class="zoom-img" >
                            </td>
                        </tr>
                        <tr>
                            <th class="th">نام</th>
                            <td>{{ $product->title }}</td>
                            <td id="title"></td>
                        </tr>

                        <tr>
                            <th class="th">قیمت</th>
                            <td>{{ number_format($product->price) }} تومان</td>
                            <td id="price"></td>
                        </tr>

                        <tr>
                            <th class="th">دسته</th>
                            <td>
                                @foreach($categories as $category )
                                    {{ $category->name. ' , '  }}
                                @endforeach
                            </td>
                            <td id="cat"></td>
                        </tr>

                        <tr>
                             <th class="th">توضیحات</th>
                            <td>{{ $product->text }}</td>
                            <td id="text"></td>
                        </tr>

                        <tbody id="dataBody"></tbody>
                    </table>
                </div>
                <div class="col-md-9"></div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/front/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>

    <script>
        $(".listproduct").on('change',function () {
           var id=$(this).val();

           $.ajax
            ({
                url: '/getProduct/'+id,
                type: 'get',
                dataType: 'json',

                success: function (data) {

                  /*  var img=data['data'].img;
                    var title = data['data'].title;
                    var price = data['data'].price +'تومان';
                    var text = data['data'].text;*/

                   var img = data.pic.img;
                   // var id = data.output.id;
                   var title = data.output.title;
                   // var formatter=new Intl.NumberFormat('en-US);
                   var price = data.output.price + 'تومان';
                   var cat = data.cat.name;
                   var text = data.output.text;


                   $("#img").attr('src', '/' + img);
                   $("#title").text(title);
                   $("#price").text(price);
                   $("#cat").text(cat);
                   $("#text").text(text);

                }
            });
        });

    </script>
@endsection




