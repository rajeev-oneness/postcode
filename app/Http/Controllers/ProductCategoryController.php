<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProductCategory;

class ProductCategoryController extends Controller
{
    //category
    public function manageCategory()
    {
        $categories = ProductCategory::all();
        return view('portal.product-category.index', compact('categories'));
    }
    public function createCategory()
    {
        return view('portal.product-category.add');
    }
    public function storeCategory(Request $req)
    {
        $category = new ProductCategory;
        $category->name = $req->name;
        $category->save();
        return redirect()->route('product.category');
    }
    public function editCategory($id)
    {
        $category = ProductCategory::find(decrypt($id));
        return view('portal.product-category.edit', compact('category'));
    }
    public function updateCategory(Request $req)
    {
        $category = ProductCategory::find(decrypt($req->category_id));
        $category->name = $req->name;
        $category->save();
        return redirect()->route('product.category');
    }
    public function deleteCategory($id)
    {
        $delete_id = decrypt($id);
        $delete_product = ProductCategory::where('id', $delete_id)->delete();
        return redirect()->route('product.category');
    }
}
