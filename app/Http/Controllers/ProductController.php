<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Producttype;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
        $sanpham = Product::paginate(5);
        return view('admin.page.product.index',compact('sanpham'))->render();
        }
        else{
            $sanpham = Product::paginate(5);
            return view('admin.page.product.index',compact('sanpham'));
        }
    }
    public function minus(Product $product){
        $data = Product::find($product->id);
        if($data->quantity <= 0){
            $data->quantity = 0;
        }
        else{

        $data->quantity --;
        }
        $data->save();
        return redirect()->back();
    }
    public function plush(Product $product){
        $data = Product::find($product->id);
        $data->quantity ++;
        $data->save();
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $loai_sp = ProductType::all()->pluck('id','name');
        return view('admin.page.product.create',compact('loai_sp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,
            [
                'name' => 'required|unique:products,name|min:10|max:150',
                'productType' => 'required',
                'price' => 'required',
                'description' => 'required|unique:products,description|min:50|max:250',

                'content' => 'required|unique:products,content|min:50|max:5000',
                'image' => 'required'
            ],
            [
                'name.required' => 'tên sản phẩm không được để trống',
                'name.unique' => 'tên sản phẩm đã tồn tại',
                'name.min' => 'tên sản phẩm tối thiểu 10 ký tự',
                'name.max' => 'tên sản phẩm tối đa 70 ký tự',

                'productType.required' => 'loại sản phẩm không được để trống',
                'price.required' => 'giá sản phẩm không được để trống',

                'description.required' => 'description không được để trống',
                'description.unique' => 'description đã tồn tại',
                'description.min' => 'description tối thiểu 30 ký tự',
                'description.max' => 'description tối đa 150 ký tự',

                'content.required' => 'content không được để trống',
                'content.unique' => 'content đã tồn tại',
                'content.min' => 'content tối thiểu 50 ký tự',
                'content.max' => 'content tối đa 5000 ký tự',
                'image.required' => 'hình ảnh không được để trống'
        ]);

        $product = new Product;
        if($request->hasfile('image')){
            $file = $request->file('image');
            if($file->getClientOriginalExtension('image') == 'jpg' || $file->getClientOriginalExtension('image') == 'png'){
                $file_name = $file->getClientOriginalName('image');
                $file->move('soucre/image/product',$file_name);
                $product->image = $file_name;
                // echo 'da luu anh';
            }
            else{
                return redirect()->route('product.create')->with(['flag' => 'danger', 'mesage' => 'vui lòng chọn file có phần mở rộng là .jpg hoặc .png']);
            }
        }
        else{
            return redirect()->route('product.create')->with(['flag' => 'success','mesage' => 'vui lòng chọn hình ảnh']);
        }
        $product->name = $request->name;
        $product->id_type = $request->productType;
        $product->unit_price = $request->price;
        $product->promotion_price =($request->price * $request->promotion)/100;
        $product->new = $request->new;
        $product->slug = Str::slug($request->name,'-');
        $product->quantity = 1;
        $product->description = $request->description;
        $product->content = $request->content;
        $product->save();
        return redirect()->route('product.create')->with(['flag' => 'success', 'mesage' => 'thêm sản phẩm thành công']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $data = Product::find($product->id);
        $loai_sp = ProductType::all();
        return view('admin.page.product.edit',compact('data','loai_sp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $this->validate($request,
            [
                'productType' => 'required',
                'price' => 'required',
                'description' => 'required|min:30|max:250',

                'content' => 'required|min:50|max: 5000'
            ],
            [
                'productType.required' => 'loại sản phẩm không được để trống',
                'price.required' => 'giá sản phẩm không được để trống',

                'description.required' => 'description không được để trống',
                'description.unique' => 'description đã tồn tại',
                'description.min' => 'description tối thiểu 30 ký tự',
                'description.max' => 'description tối đa 150 ký tự',

                'content.required' => 'content không được để trống',
                'content.unique' => 'content đã tồn tại',
                'content.min' => 'content tối thiểu 50 ký tự',
                'content.max' => 'content tối đa 500 ký tự'
        ]);
        $product = Product::find($product->id);
        if($request->hasfile('image')){
            $file = $request->file('image');
            if($file->getClientOriginalExtension('image') == 'jpg' || $file->getClientOriginalExtension('image') == 'png'){
                $file_name = $file->getClientOriginalName('image');
                $file->move('soucre/image/product',$file_name);
                $product->image = $file_name;
            }
            else{
                return redirect()->back()->with(['flag' => 'danger', 'mesage' => 'vui lòng chọn file có phần mở rộng là .jpg hoặc .png']);
            }
        }
        else{
            $product->image = $product->image; 
        }
        if($request->name != null){
            $this->validate($request,[

                'name' =>'unique:products,name|min:10|max:70'
            ],
            [   
                'name.unique' => 'tên sản phẩm đã tồn tại',
                'name.min' => 'tên sản phẩm tối thiểu 10 ký tự',
                'name.max' => 'tên sản phẩm tối đa 70 ký tự'
            ]);
            $product->name = $request->name;
            $product->slug = Str::slug($request->name,'-');

        }
        else{
            $product->name = $product->name;
            $product->slug = Str::slug($product->name,'-');
        }
        $product->id_type = $request->productType;
        $product->unit_price = $request->price;
        $product->promotion_price =($request->price * $request->promotion)/100;
        $product->new = $request->new;

        $product->description = $request->description;
        $product->content = $request->content;
        $product->save();
        
        return redirect()->back()->with(['flag' => 'success', 'mesage' => 'sửa sản phẩm thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        Product::destroy($product->id);
        return redirect()->route('product.index')->with(['flag' => 'success','mesage' => 'xóa sản phẩm thành công']);
    }
}
