<?php

namespace App\Http\Controllers\staff\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Models\Category\CategorySub;
use App\Models\Master\Attribute\Attribute;
use Illuminate\Support\Facades\DB;
use Flasher\Prime\FlasherInterface;


class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory = CategorySub::get();
        // $attribute_data = Attribute::get();
        $attribute = CategorySub::join(
            'master_attribute',
            'category_sub.id',
            '=',
            'master_attribute.category_sub_id'
        )
            ->get();

        return view('layout.staff.products.attribute-listing')
            ->with([
                'subcategory' => $subcategory,
                'attribute' => $attribute
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        $attribute = new Attribute;

        try {
            $attribute->category_sub_id = $request->category_sub_id;
            $attribute->attribute_name = $request->name;
            $attribute->value = json_encode($request->value);
            $attribute->status = $request->status ?? 1;
            $attribute->save();

            $flasher->addSuccess('New Attribute Added successfully!');
            return redirect()->route('attribute.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('attribute.master.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, FlasherInterface $flasher)
    {
        try {
            Attribute::where("id", $id)->delete();
            $flasher->addsuccess('Product Attribute Removed!');
            return redirect()->route('attribute.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('attribute.master.index');
        }
    }



    public function getAttributes(Request $request)
    {
        $attribute_data = Attribute::where('category_sub_id', $request->sub_category_id)->get();
        return response()->json($attribute_data);
    }

    public function getSubCategory(Request $request)
    {
        $attribute_data = Attribute::where('category_sub_id', $request->sub_category_id)->get();
        return response()->json($attribute_data);
    }
}
