<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use App\Ward;
use App\District;
use App\City;
use Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check()){
        $datas = Address::where('id_user',Auth::user()->id)->paginate(5);
        return view('show_view.pages.diachi',compact('datas'));
        }
        else{
            return redirect()->back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all()->pluck('matp','name');
        return view('show_view.pages.diachi_moi',compact('cities'));


    }
        public function district($id){
          $district = District::where('id_thanhpho',$id)->pluck('name','maqh');
          return json_encode($district);
        }
        public function ward($id){
            $ward = Ward::where('id_quanhuyen',$id)->pluck('name','xaid');
            return json_encode($ward);
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   if(Auth::check()){
            $city = $request->city;
            $district = $request->district;
            $ward = $request->ward;
            $getCity = City::where('matp',$city)->first();
            $getDistrict = District::where('maqh',$district)->first();
            $getWard = Ward::where('xaid',$ward)->first();

            $address = new Address;
            $address->city = $getCity->name;
            $address->district = $getDistrict->name;
            $address->ward = $getWard->name;
            $address->phone_number = $request->phone;
            $address->home = $request->home;
            $address->id_user = Auth::user()->id;
            $address->save();
            return redirect()->back()->with('thongbao','thêm địa chỉ thành công');
        }
        // city | district | ward | id_user
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function default(Address $address)
    {
        //
        $data = Address::where('id_user', Auth::id())->get();
        foreach($data as $df){
            $df->default = null;
            $df->save();
        }
        $add = Address::find($address->id);
        // dd($add->default);
        if($add->default == null){
            $add->default = '1';
            $add->save();

        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {    if (Auth::check()) {
            $cities = City::all()->pluck('matp','name');
             $add = Address::where('id_user',Auth::user()->id)->first();
            return view('show_view.pages.sua_diachi',compact('cities','add'));
            }
        else  
            {
                return redirect()->back(); 
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //

            // dd($address->id);
        if(Auth::check()){
            $city = $request->city;
            $district = $request->district;
            $ward = $request->ward;
            $getCity = City::where('matp',$city)->first();
            // dd($getCity);
            $getDistrict = District::where('maqh',$district)->first();
            $getWard = Ward::where('xaid',$ward)->first();

            $address =  Address::find($address->id);
            $address->city = $getCity->name;
            $address->district = $getDistrict->name;
            $address->ward = $getWard->name;
            $address->phone_number = $request->phone;
            $address->home = $request->home;
            $address->save();
            return redirect()->back()->with('thongbao','sua địa chỉ thành công');
        }
        // city | district | ward | id_user

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
        Address::destroy($address->id);
        return redirect()->back()->with('thongbao','xoa thanh cong');
    }
}
