<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loai_sp = ProductType::paginate(10);
        return view('admin.page.productType.index',compact('loai_sp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.page.productType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,
            [
                'name' => 'required|unique:product_types,name|min:5|max:40',
                'description' => 'required|unique:product_types,description|min:20',
                'image' => 'required'
            ],
            [
                'name.required' => 'tên không được để trống',
                'name.unique' => 'tên đã tồn tại',
                'name.min' => 'tên tối thiểu 5 ký tự',
                'name.max' => 'tên tối đa 40 ký tự',

                'description.required' => 'mô tả không được để trống',
                'description.unique' => 'mô tả đã tồn tại',
                'description.min' => 'mô tả tối thiểu 20 ký tự',
                'image.required' => 'hình ảnh không được để trống'
            ]);
        $loai_sp = new ProductType;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->getClientOriginalExtension('image') == 'jpg' || $file->getClientOriginalExtension('image') == 'png'){
                $file_name = $file->getClientOriginalName('image');
                $file->move('soucre/image/product_type',$file_name);
            }
            else{
                return null;
            }
        }
        else {
            return null;
        }
        //het phan luu anh
        $loai_sp->name = $request->name;
        $loai_sp->description = $request->description;
        $loai_sp->image = $file_name;
        $loai_sp->slug = Str::slug($request->name,'-');
        $loai_sp->save();
        return redirect()->back()->with('thongbao','thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        //
        $productType = ProductType::find($productType->id);

        return view('admin.page.productType.edit',compact('productType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        //
        $loai_sp = ProductType::find($productType->id);
        if($request->name == null && $request->description == null){
             if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->getClientOriginalExtension('image') == 'jpg' || $file->getClientOriginalExtension('image') == 'png'){
                $file_name = $file->getClientOriginalName('image');
                $file->move('soucre/image/product_type',$file_name);
                $loai_sp->image = $file_name;
            }
            else{
                return null;
            }
            }
            else {
                $file = $loai_sp->image;
            }
            //het phan luu anh
             $loai_sp->save();
            return redirect()->back()->with('thongbao','sửa thành công');
        }
        else{
            $this->validate($request,
                [
                    'name' => 'unique:product_types,name|min:5|max:40',
                    'description' => 'unique:product_types,description|min:20'
                ],
                [
                    'name.unique' => 'tên đã tồn tại',
                    'name.min' => 'tên tối thiểu 5 ký tự',
                    'name.max' => 'tên tối đa 40 ký tự',

                    'description.unique' => 'mô tả đã tồn tại',
                    'description.min' => 'mô tả tối thiểu 20 ký tự'
                ]);
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if($file->getClientOriginalExtension('image') == 'jpg' || $file->getClientOriginalExtension('image') == 'png'){
                    $file_name = $file->getClientOriginalName('image');
                    $file->move('soucre/image/product_type',$file_name);
                    $loai_sp->image = $file_name;
                }
                else{
                    return null;
                }
            }
            else {
                $file = $loai_sp->image;
            }
            //het phan luu anh
            $loai_sp->name = $request->name;
            $loai_sp->slug = Str::slug($request->name,'-');
            $loai_sp->description = $request->description;
            $loai_sp->save();
            return redirect()->back()->with('thongbao','thêm mới thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        //
        ProductType::destroy($productType->id);
        return redirect()->back()->with('thongbao','xóa thành công');
    }
}
