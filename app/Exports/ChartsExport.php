<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ChartsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Name',
            'price',
            'qty',
        ];
    }


    public function collection()
    {
       return $products = DB::table('order_product')
            ->leftJoin('products','order_product.product_id','=','products.id')
            ->select(
                DB::raw('title as title'),
                DB::raw('price as price'),
                DB::raw('product_id as product_id')
            )
            ->groupBy('product_id')
            ->havingRaw('COUNT(product_id) > 1')
            ->get();
    }
}
