<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProductCategory;
use App\Model\ProductSubcategory;


class ProductSubcategoryController extends Controller
{
    //Subcategory
    public function manageSubcategory()
    {
        $subcategories = ProductSubcategory::with('category')->get();
        return view('portal.product-subcategory.index', compact('subcategories'));
    }
    public function createSubcategory()
    {
        $categories = ProductCategory::all();
        return view('portal.product-subcategory.add', compact('categories'));
    }
    public function storeSubcategory(Request $req)
    {
        $category = new ProductSubcategory;
        $category->category_id = $req->category_id;
        $category->name = $req->name;
        $category->save();
        return redirect()->route('product.subcategory');
    }
    public function editSubcategory($id)
    {
        $categories = ProductCategory::all();
        $subcategory = ProductSubcategory::find(decrypt($id));
        return view('portal.product-subcategory.edit', compact('subcategory', 'categories'));
    }
    public function updateSubcategory(Request $req)
    {
        // dd($req->all());
        $category = ProductSubcategory::find(decrypt($req->subcategory_id));
        $category->category_id = $req->category_id;
        $category->name = $req->name;
        $category->save();
        return redirect()->route('product.subcategory');
    }
    public function deleteSubcategory($id)
    {
        $delete_id = decrypt($id);
        $delete_product = ProductSubcategory::where('id', $delete_id)->delete();
        return redirect()->route('product.subcategory');
    }
}
