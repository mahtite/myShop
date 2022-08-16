<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ChartsExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Maatwebsite\Excel\Facades\Excel;

class ChartController extends Controller
{
    public function index()
    {

        $products = DB::table('order_product')
            ->leftJoin('products','order_product.product_id','=','products.id')
            ->select(
                DB::raw('title as title'),
                DB::raw('price as price'),
                DB::raw('product_id as product_id')
            )
           ->groupBy('product_id')
            ->havingRaw('COUNT(product_id) > 1')
            ->get();

        $result[] = ['نام محصول','قیمت','تعداد'];

        foreach ($products as $key => $value) {
            $result[++$key] = [$value->title,$value->price,(string)$value->product_id];
        }
        $data['title'] = json_encode($result);

        return view('admin.chart.productChart',$data);
    }

    public function getChartData()
    {
        return Excel::download(new ChartsExport, 'charts.xlsx');
    }
}
