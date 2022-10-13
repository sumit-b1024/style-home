<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FilterGroup;
use App\Models\FilterGroupItem;

class ProductFilterAdminController extends Controller
{
    public function index()
    {
        $filter_groups = FilterGroup::paginate(15);
        return view('admin.filters.index', compact('filter_groups'));
    }

    public function add()
    {
        // $user = auth()->user();
        return view('admin.filters.add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'group_name' => 'required',
            'group_items.*' => 'required',

        ], [
            'group_items.*.required' => 'The group_items field is required',
        ]);
        $filtergroup = new FilterGroup();
        $filtergroup->name = $request->group_name;
        $filtergroup->save();
        if ($filtergroup) {
            foreach ($request->group_items as $item) {
                FilterGroupItem::create([
                    'filter_group_id' => $filtergroup->id,
                    'item_name' => $item,
                ]);
            }
        }
        return redirect()->back()->withSuccess(__('Filter Added Successfuly'));
    }

    public function update(FilterGroup $group)
    {
        // $user=auth()->user();
        $group_items = FilterGroupItem::where('filter_group_id', $group->id)->select(['id', 'item_name'])->get();
        return view('admin.filters.update', compact('group', 'group_items'));
    }

    public function doUpdate(Request $request, FilterGroup $group)
    {
        $request->validate([
            'group_name' => 'required',
            'group_items.*' => 'required',

        ], [
            'group_items.*.required' => 'The group_items field is required',
        ]);
        $filtergroup = FilterGroup::where('id',$group->id)->first();
        $filtergroup->name = $request->group_name;
        $filtergroup->save();
        if ($filtergroup) {
            // FilterGroupItem::where('filter_group_id', $group->id)->whereIn('item_name',$request->group_items)->get()->dd();
            foreach ($request->group_items as $item) {
                FilterGroupItem::updateOrCreate([
                    'filter_group_id' => $group->id,
                    'item_name'=>$item,
                ]);
            }
        }
        return redirect()->back()->withSuccess(__('Filter Updated Successfuly'));
    }




    public function delete(FilterGroup $group)
    {
        FilterGroupItem::where('filter_group_id',$group->id)->delete();
        $group->delete() ;
        return redirect()->back()->withSuccess(__('Filter Deleted Successfuly'));
    }

}
