<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    //
    public function showProducts(Request $request) {
        $query = DB::table('products');

        // check if the request has search and display the searched product
        if ($request->has('search') && !empty($request->input('search'))) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->input('search') . '%')
                      ->orWhere('description', 'LIKE', '%' . $request->input('search') . '%');
            });
        }

        // used to filter products using category
        if($request->query('category') && !empty($request->query('category'))) {
            $query->where('category', $request->query('category'));
        }

        // paginate the data. max 5 products per page
        return response($query->paginate(5));
    }

    public function productList() {
        return view('product_list', ['page' => 'Product List']);
    }

    public function deleteProduct(Request $request, $id) {
        $product = DB::table('products')
        ->where('id', $id);        

        if(!$product) {
            return response()->json(['message' => 'Item Not Found']);
        }

        $product->delete();

        return response()->json(['message' => 'Product Deleted Successfully']);
    }

    public function getSpecificProduct(Request $request, $id) {
        $product = DB::table('products')
        ->where('id', $id);        

        $images = DB::table('product_images')
        ->select('id', 'product_id', 'file_name')
        ->where('product_id', $id);

        if(!$product) {
            return response()->json(['message' => 'Item Not Found']);
        }

        return response()->json(['product' => $product->get(),
                                'images' => $images->get()]);
    }

    public function showCreateProduct() {
        return view('create_product', ['page' => 'Create Product']);
    }

    public function createProduct(Request $request) {
        $name = $request->input('name');
        $category = $request->input('category');
        $description = $request->input('description');
        $dateTime = Carbon::parse($request->input('date_time'));
        $parsedDateTime = $dateTime->toDateTimeString(); 

        // get the ID of the created product
        $createdProduct = DB::table('products')->insertGetId([
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'date_and_time' => $parsedDateTime
        ]);


        if(!$createdProduct) {
            return response()->json(['message' => 'Product Creation Failed',
                                    'status' => 'error']);
        }
        else if($createdProduct) {
            // handle the image upload
            $images = $request->file('images');

            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->move(public_path('images'), $imageName);
                
                DB::table('product_images')->insert([
                    'product_id' => $createdProduct,
                    'file_name' => $imageName,
                    'image_path' => $imagePath
                ]);
            }          

            return response()->json(['message' => 'Product Created Successfully',
            'status' => 'success']);
        }

        
    }
    
    public function showEditProduct($id) {
        return view('edit_product', ['page' => 'Edit Product', 'product_id' => $id]);
    }

    public function editProduct(Request $request, $id) {
        $name = $request->input('name');
        $category = $request->input('category');
        $description = $request->input('description');
        $dateTime = Carbon::parse($request->input('date_time'));
        $parsedDateTime = $dateTime->toDateTimeString(); 

        $updatedProduct = DB::table('products')
        ->where('id', $id)
        ->update([
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'date_and_time' => $parsedDateTime
        ]);

            // handle image upload 
            $images = $request->file('images');
            
            if(empty($images)) {
                return response()->json(['message' => 'Product Edited Successfully',
                'status' => 'success']);
            }
            else if(!empty($images)) {
                DB::table('product_images')
                    ->where('product_id', $id)
                    ->delete();

                foreach ($images as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $imagePath = $image->move(public_path('images'), $imageName);                    
                    
                    DB::table('product_images')
                    ->where('product_id', $id)
                    ->insert([
                        'product_id' => $id,
                        'file_name' => $imageName,
                        'image_path' => $imagePath
                    ]);
                }          
    
                return response()->json(['message' => 'Product Edited Successfully',
                'status' => 'success']);

            }


    }
}
