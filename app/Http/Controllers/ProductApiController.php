<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Response;

class ProductApiController extends Controller
{
    
    public function index()
    { 
        $data = Product::all();
        return json_encode(['data' => $data, 'success' => true]); 
        exit;
    }


    public function get($id)
    { 
        $existingItem = Product::find($id);

        if ($existingItem) 
        { 
            return json_encode(['data' => $existingItem, 'success' => true]); 
            exit;
        }

        return json_encode(['error' => "No product found", 'success' => false]);  
        exit;
    }

    public function store(Request $request)
    { 

        $validated = $request->validate([
                'title'       => 'required|max:255',
                'description' => 'required',
                'price'       => 'required' 
        ]); 
        $data = [
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'price'       => $request->input('price') 
        ];
        $new_product = Product::create($data); 
        if ($new_product) 
        {
            return json_encode(['success' => true, 'message' => "Data has been added successfully."]);
            exit;
        }else{
            return json_encode(['error' => "Error please try again later.", 'success' => false]); 
            exit; 
        }
        
    }


    public function update(Request $request, $id)
    { 
        $existingItem = Product::find($id);

        if ($existingItem) 
        { 
            $existingItem->title       = $request->input('title');
            $existingItem->description = $request->input('description');
            $existingItem->price       = $request->input('price');
            $existingItem->update();

            return json_encode(['data' => $existingItem, 'success' => true, 'message' => "Data has been updated successfully."]);
            exit;
        }
        return json_encode(['error' => "Item not found.", 'success' => false]); 
        exit; 
    }


    public function destroy($id)
    { 
        $existingItem = Product::find($id);

        if ($existingItem) 
        {
            $existingItem->delete(); 
            return json_encode(['message' => "Item deleted successfully.", 'success' => true]);
            exit; 
        }  
        return json_encode(['error' => "No product found", 'success' => false]);  
        exit; 
    }


    public function export_csv()
    {
         

        $items = Product::all();

        $responseHeaders = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=Products.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
            
        $callback = function () use ($items) 
        {
            // Header row
            $header = [
                'ID','Title', 'Descrition', 'Price'
            ];

            $file = fopen('php://output', 'w');

            // Put the header row content to the csv
            fputcsv($file, $header);
        
            foreach ($items as $item) {
                $item = (object) $item;
                // Put each item row to the csv
                fputcsv($file, [
                    $item->id,
                    $item->title,
                    $item->description,
                    $item->price,
                ]);
            }

            fclose($file);
        };
            
        return Response::stream($callback, 200, $responseHeaders);
    }

}
