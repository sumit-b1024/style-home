<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\AddToCart;
use App\Models\CustomerQuiz;
use App\Models\RoomLayout;
use App\Models\StyleType;
use App\Models\RoomType;
use App\Models\Country;
use App\Models\FilterGroup;
use App\Models\FilterGroupItem;
use App\Models\FilterProduct;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = Product::all();
        $room_layouts = RoomLayout::all();
        $style_types = StyleType::all();
        $room_types = RoomType::all();
        $countries = Country::all();
        $add_filters = FilterGroup::with('filter_groupitems')->get();
        // dd($add_filters);
        // $filter_groups = FilterGroup::where()->get();
        $addcarts = [];
        if (sizeof($addcarts) > 0) {
            $addcarts = AddToCart::where('user_id', $user->id)->get();
        }
        return view('frontend.product_list', compact('products', 'addcarts', 'countries', 'room_types', 'style_types', 'room_layouts', 'add_filters'));
    }

    public function productDetail($id)
    {
        $user = auth()->user();
        $products = Product::where('id', $id)->first();
        if (isset($products)) {
            $product_images = ProductImage::where('product_id', $id)->get();
            $addcarts = AddToCart::where('user_id', $user->id)->get();
            $checkcart = AddToCart::where('user_id', $user->id)->where('product_id', $products->id)->first();

            return view('frontend.product_details', compact('product_images', 'products', 'user', 'addcarts', 'checkcart'));
        } else {
            abort(404);
        }
    }

    public function addToCart(Request $request)
    {
        $user = auth()->user();
        $customer_temp = CustomerQuiz::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        if (empty($customer_temp)) {
            return redirect()->back()->withError(__('Please complete quiz first!'));
        }
        $cust_id = $customer_temp->id;
        $addcart = AddToCart::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quiz_id' => $cust_id,
        ]);
        return response()->json(['result' => $addcart]);
    }

    public function removeToCart(Request $request)
    {
        $removecart = AddToCart::where(['user_id' => $request->user_id, 'product_id' => $request->product_id])->first();
        if (isset($removecart)) {
            $removecart->delete();
        }
        return response()->json(['result' => $removecart]);
    }

    public function productList()
    {
        $products = Product::with(['product_images' => function ($q) {
            $q->first();
        }])->get();
        
        $html = view('frontend.productlist', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    public function productwithstyletype(Request $request)
    {

        $styletype = $request->styletype;
        $products = Product::where(function ($q) use ($styletype) {
            foreach ($styletype as $key => $c) {
                if ($key == 0) {
                    $q = $q->whereRaw('FIND_IN_SET(' . $c . ',style_type)');
                } else {
                    $q = $q->orWhere(function ($query) use ($c) {
                        $query->whereRaw('FIND_IN_SET(' . $c . ',style_type)');
                    });
                }
            }
        })->with(['product_images' => function ($q) {
            $q->first();
        }])->get();
        $html = view('frontend.productlist', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    public function productwithroomtype(Request $request)
    {
        $roomtype = $request->roomtype;
        $products = Product::where(function ($q) use ($roomtype) {
            foreach ($roomtype as $key => $c) {
                if ($key == 0) {
                    $q = $q->whereRaw('FIND_IN_SET(' . $c . ',room_type)');
                } else {
                    $q = $q->orWhere(function ($query) use ($c) {
                        $query->whereRaw('FIND_IN_SET(' . $c . ',room_type)');
                    });
                }
            }
        })->with(['product_images' => function ($q) {
            $q->first();
        }])->get();
        $html = view('frontend.productlist', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    public function productwithroomlayout(Request $request)
    {
        $roomlayout = $request->roomlayout;
        $products = Product::where(function ($q) use ($roomlayout) {
            foreach ($roomlayout as $key => $c) {
                if ($key == 0) {
                    $q = $q->whereRaw('FIND_IN_SET(' . $c . ',room_layout)');
                } else {
                    $q = $q->orWhere(function ($query) use ($c) {
                        $query->whereRaw('FIND_IN_SET(' . $c . ',room_layout)');
                    });
                }
            }
        })->with(['product_images' => function ($q) {
            $q->first();
        }])->get();
        $html = view('frontend.productlist', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    public function productwithcountry(Request $request)
    {
        $country = $request->country;
        $products = Product::where(function ($q) use ($country) {
            foreach ($country as $key => $c) {
                if ($key == 0) {
                    $q = $q->whereRaw('FIND_IN_SET(' . $c . ',country)');
                } else {
                    $q = $q->orWhere(function ($query) use ($c) {
                        $query->whereRaw('FIND_IN_SET(' . $c . ',country)');
                    });
                }
            }
        })->with(['product_images' => function ($q) {
            $q->first();
        }])->get();
        $html = view('frontend.productlist', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    public function allProducts(Request $request)
    {
        $products = new Product();
        $country = $request->country;
        $roomlayout = $request->roomlayout;
        $roomtype = $request->roomtype;
        $styletype = $request->styletype;
        $addi_filter = $request->addi_filter;
        if (isset($country) && sizeof($country) > 0) {
            $products = $products->where(function ($q) use ($country) {
                foreach ($country as $key => $c) {
                    if ($key == 0) {
                        $q = $q->whereRaw('FIND_IN_SET(' . $c . ',country)');
                    } else {
                        $q = $q->orWhere(function ($query) use ($c) {
                            $query->whereRaw('FIND_IN_SET(' . $c . ',country)');
                        });
                    }
                }
            });
        }
        if (isset($roomlayout) && sizeof($roomlayout) > 0) {
            $products = $products->where(function ($q) use ($roomlayout) {
                foreach ($roomlayout as $key => $c) {
                    if ($key == 0) {
                        $q = $q->whereRaw('FIND_IN_SET(' . $c . ',room_layout)');
                    } else {
                        $q = $q->orWhere(function ($query) use ($c) {
                            $query->whereRaw('FIND_IN_SET(' . $c . ',room_layout)');
                        });
                    }
                }
            });
        }
        if (isset($roomtype) && sizeof($roomtype) > 0) {
            $products = $products->where(function ($q) use ($roomtype) {
                foreach ($roomtype as $key => $c) {
                    if ($key == 0) {
                        $q = $q->whereRaw('FIND_IN_SET(' . $c . ',room_type)');
                    } else {
                        $q = $q->orWhere(function ($query) use ($c) {
                            $query->whereRaw('FIND_IN_SET(' . $c . ',room_type)');
                        });
                    }
                }
            });
        }
        if (isset($styletype) && sizeof($styletype) > 0) {
            $products = $products->where(function ($q) use ($styletype) {
                foreach ($styletype as $key => $c) {
                    if ($key == 0) {
                        $q = $q->whereRaw('FIND_IN_SET(' . $c . ',style_type)');
                    } else {
                        $q = $q->orWhere(function ($query) use ($c) {
                            $query->whereRaw('FIND_IN_SET(' . $c . ',style_type)');
                        });
                    }
                }
            });
        }
        if (isset($addi_filter) && sizeof($addi_filter) > 0) {
            $filter_products = FilterProduct::where(function ($q) use ($addi_filter) {
                foreach ($addi_filter as $key => $c) {
                    if ($key == 0) {
                        $q = $q->whereRaw('FIND_IN_SET(' . $c . ',filter_group_items)');
                    } else {
                        $q = $q->orWhere(function ($query) use ($c) {
                            $query->whereRaw('FIND_IN_SET(' . $c . ',filter_group_items)');
                        });
                    }
                }
            })->select(['product_id'])->get();
            $products = $products->whereIn('id', $filter_products->pluck('product_id'));
        }
        $products = $products->with(['product_images' => function ($q) {
            $q->first();
        }])->get();
        $html = view('frontend.productlist', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    public function designDownload (Request $request)
    {
        return view('frontend.download');
    }
}
