<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Product;
use DB;

class ProductController extends Controller
{
      public function index() {

        $categories = Product::select('groop1')
            ->distinct()
            ->orderBy('groop1')
        ->get();

        return view('products.index', compact('categories'));
    }

    public function products(Request $request, $main_category)
    {   

        // session()->flush();
        session()->put('main_category', $main_category);
        $products = $this->handleResults($request, $main_category);

        $produsers = Product::where('produser', '!=', '')
            ->select('produser')->where('groop1', $main_category)
            ->distinct()
            ->orderBy('produser')
        ->get();

        $categories = Product::where('groop2', '!=', '')
            ->select('groop2')->where('groop1', $main_category)
            ->distinct()
            ->orderBy('groop2')
        ->get();



        return view('products.products', compact('produsers', 'products', 'main_category', 'categories'));
    }



    public function handleResults(Request $request) {

        $value = $request->input('filters');
        $main_category = session()->get('main_category');
        if(session()->has('filters_'.$value)) {
            session()->forget('filters_'.$value);
        } else {
            $request->session()->put('filters_'.$value, $value);
        }


        $filters = session()->all();
        
        $pattern = '/filters/';
        $flags = 0;
        $keys = preg_grep( $pattern, array_keys( $filters ), $flags );
        $vals = array();
        foreach ( $keys as $key ) {
            $vals[$key] = $filters[$key];
        }

        $products = Product::whereIn('produser', $vals)->where('groop1', $main_category)->paginate(20);
        

        if (empty($products->items())) { 
            $products = Product::where('groop1', $main_category)->paginate(20);
        }

        return $products;

    }
    
    public function filterResults(Request $request) {
        $products = $this->handleResults($request);
        $products = $products->items();
        return $products;

    }



    public function updateProducts()
    {
        $extension = pathinfo(env('CSV_URL'), PATHINFO_EXTENSION);

        // записвам си файла локално
        // $file = file_get_contents(env('CSV_URL'));
        // $save = file_put_contents(storage_path().'/csv/'.env('CSV_STORAGE_NAME'), $file);

        $csvData = file_get_contents(env('CSV_URL'));
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);
        $lines = count($rows);
        DB::table('products')->truncate();
        $i = 1;
        foreach ($rows as $row) {
            $record = array_combine($header, $row);
            Product::create([
                'art' => $record['art'],
                'name' => $record['name'],
                'produser' => $record['produser'],
                'country' => $record['country'],
                'unit' => $record['unit'],
                'price' => $record['price'],
                'groop1' => $record['groop1'],
                'groop2' => $record['groop2'],
                'groop3' => $record['groop3'],
                'groop4' => $record['groop4'],
                'groop5' => $record['groop5'],
                'fasovka' => $record['fasovka'],
                'qty' => $record['qty'],
                'min_qty' => $record['min_qty'],
                'text' => $record['text'],
                'sclad' => $record['sclad'],
                'source_id' => $record['id'],
            ]);
            if ($i++ == $lines - 1) break;
        }
    }


}