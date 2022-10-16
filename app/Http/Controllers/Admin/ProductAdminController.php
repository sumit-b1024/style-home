<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDocument;
use App\Models\ProductImage;
use App\Models\RoomLayout;
use App\Models\StyleType;
use App\Models\RoomType;
use App\Models\FilterGroup;
use App\Models\FilterGroupItem;
use App\Models\FilterProduct;
use Str;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::paginate();
        $user = auth()->user();
        return view('admin.product.index')->with(['products' => $products, 'user' => $user]);
    }

    public function add()
    {
        $user = auth()->user();
        $room_layouts = RoomLayout::all();
        $style_types = StyleType::all();
        $room_types = RoomType::all();
        $countries = Country::all();
        $filter_groups = FilterGroup::select(['id', 'name'])->get();
        return view('admin.product.add', compact('user', 'room_types', 'style_types', 'room_layouts', 'countries', 'filter_groups'));
    }

    public function update(Product $product)
    {
        $roomtypes = $product->roomtypes()->get();
        $styletypes = $product->styletypes()->get();
        $roomlayouts = $product->roomlayouts()->get();
        $user = auth()->user();
        $product_images = ProductImage::where('product_id', $product->id)->get();
        $room_layouts = RoomLayout::all();
        $style_types = StyleType::all();
        $room_types = RoomType::all();
        $countries = Country::all();
        $filter_groups = FilterGroup::all();
        $filterproducts = FilterProduct::where('product_id', $product->id)->get();
        $filter_groupitems = FilterGroupItem::whereIn('filter_group_id', $filterproducts->pluck('filter_group_id'))->get();
        
        // dd($filter_groupitems);
        return view('admin.product.update', compact('user', 'room_types', 'style_types', 'room_layouts', 'countries', 'product', 'product_images', 'styletypes', 'roomtypes', 'roomlayouts', 'filter_groups', 'filterproducts', 'filter_groupitems'));
    }

    public function doUpdate(Request $request, Product $product)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'document' => 'sometimes|array',
            'document.*' => 'mimes:doc,docx,application/msword,jpg,jpeg,png,svg,gif|max:2048',
            // 'document' => 'sometimes|mimes:doc,docx,application/msword,jpg,jpeg,png,svg,gif|max:2048',
            'price'   => 'required',
            'available_qty' => 'required',
            'description' => 'required',
            'room_type' => 'required',
            'style_type' => 'required',
            'room_layout' => 'required',
            'country' => 'required',
            'color_scheme' => 'required',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,jpg,png,svg,gif'
        ]);
        // if ($request->hasfile('document')) {
        //     if (isset($product->document)) {
        //         $doc_path = 'public/product_document/' . $product->document;
        //         if (file_exists($doc_path)) {
        //             @unlink($doc_path);
        //         }
        //     }
        //     $image = $request->file('document');
        //     $doc_name = uniqid(Str::random(12)) . '.' . $image->getClientOriginalExtension();
        //     $request->document->move('public/product_document', $doc_name);
        //     $product->document =  $doc_name;
        // }

        $product->title = $request->title;
        $product->price = $request->price;
        $product->available_qty = $request->available_qty;
        $product->description = $request->description;
        $product->room_type = implode(",", $request->room_type);
        $product->style_type = implode(",", $request->style_type);
        $product->room_layout = implode(",", $request->room_layout);
        $product->country = $request->country;
        $product->color_scheme = $request->color_scheme;
        $product->dimensions = $request->dimensions ?? null;
        $product->materials = $request->materials ?? null;
        $product->save();
        if ($request->hasfile('document')) {
            foreach ($request->file('document') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('product_document'), $name);
                // $files[] = $name;
                $product_docss = new ProductDocument();
                $product_docss->product_id = $product->id;
                $product_docss->document_name = $name;
                $product_docss->save();
            }
        }
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('product'), $name);
                // $files[] = $name;
                $product_images = new ProductImage();
                $product_images->product_id = $product->id;
                $product_images->image = $name;
                $product_images->save();
            }
        }
        if ($product) {
            if ($request->filters) {
                FilterProduct::where('product_id', $product->id)->delete();
                if (sizeof($request->filters) > 0) {
                    foreach ($request->filters as $grp) {
                        if (isset($grp['group']) && isset($grp['item'])) {
                            FilterProduct::create([
                                'product_id' => $product->id,
                                'filter_group_id' => $grp['group'],
                                'filter_group_items' => implode(",", $grp['item'])
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->back()->withSuccess(__('Product Updated Successfuly'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([

            'title' => 'required',
            'document' => 'sometimes|array',
            'document.*' => 'mimes:doc,docx,application/msword,jpg,jpeg,png,svg,gif|max:2048',
            // 'document' => 'sometimes|mimes:doc,docx,application/msword,jpg,jpeg,png,svg,gif|max:2048',
            'price'   => 'required',
            'available_qty' => 'required',
            'description' => 'required',
            'room_type' => 'required',
            'style_type' => 'required',
            'room_layout' => 'required',
            'country' => 'required',
            'color_scheme' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,jpg,png,svg,gif',
            'filters.*' => 'sometimes|array',
        ]);

        // $doc_name = NULL;
        // if ($request->hasfile('document')) {
        //     $image = $request->file('document');
        //     $doc_name = uniqid(Str::random(12)) . '.' . $image->getClientOriginalExtension();
        //     $request->document->move('public/product_document', $doc_name);
        // }


        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        // $product->document = $doc_name;
        $product->available_qty = $request->available_qty;
        $product->description = $request->description;
        $product->room_type = implode(",", $request->room_type);
        $product->style_type = implode(",", $request->style_type);
        $product->room_layout = implode(",", $request->room_layout);
        $product->country = $request->country;
        $product->color_scheme = $request->color_scheme;
        $product->dimensions = $request->dimensions ?? null;
        $product->materials = $request->materials ?? null;
        $product->save();

        if ($request->hasfile('document')) {
            foreach ($request->file('document') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('product_document'), $name);
                // $files[] = $name;
                $product_docss = new ProductDocument();
                $product_docss->product_id = $product->id;
                $product_docss->document_name = $name;
                $product_docss->save();
            }
        }

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('product'), $name);
                // $files[] = $name;
                $product_images = new ProductImage();
                $product_images->product_id = $product->id;
                $product_images->image = $name;
                $product_images->save();
            }
        }

        if ($product) {
            if ($request->filters) {
                if (sizeof($request->filters) > 0) {
                    foreach ($request->filters as $grp) {
                        if (isset($grp['group']) && isset($grp['item'])) {
                            FilterProduct::create([
                                'product_id' => $product->id,
                                'filter_group_id' => $grp['group'],
                                'filter_group_items' => implode(",", $grp['item'])
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->back()->withSuccess(__('Product Added Successfuly'));
    }


    public function delete(Product $product)
    {

        if ($product) {
            // if (isset($product->document)) {
            //     $doc_path = 'public/product_document/' . $product->document;
            //     if (file_exists($doc_path)) {
            //         @unlink($doc_path);
            //     }
            // }
            $product_docss = ProductDocument::where('product_id', $product->id)->get();
            if (sizeof($product_docss) > 0) {
                foreach ($product_docss as $docs) {
                    if (isset($docs->document_name)) {
                        $docs_path = 'public/product_document/' . $docs->document_name;
                        if (file_exists($docs_path)) {
                            @unlink($docs_path);
                        }
                        ProductDocument::where('id', $docs->id)->delete();
                    }
                }
            }
            $images = ProductImage::where('product_id', $product->id)->get();
            foreach ($images as $image) {
                if (isset($image->image)) {
                    $image_path = 'public/product/' . $image->image;
                    if (file_exists($image_path)) {
                        @unlink($image_path);
                    }
                    ProductImage::where('id', $image->id)->delete();
                }
            }
            $filterproduct = FilterProduct::where('product_id', $product->id)->get();
            if (sizeof($filterproduct) > 0) {
                $filterproduct->delete();
            }
            $product->delete();
            return redirect()->back()->withSuccess(__('Product Deleted Successfuly'));
        }
    }

    public function getGroupItems(Request $request)
    {
        // dd($request->group_id);
        $group_items = FilterGroupItem::where('filter_group_id', $request->group_id)->select(['id', 'item_name', 'filter_group_id'])->get();
        return response()->json(['group_items' => $group_items]);
    }
}
