<?php

namespace App\Http\Controllers\Seller;

use App\Models\BusinessSetting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Notifications\ShopVerificationNotification;
use Auth;
use Illuminate\Support\Facades\Notification;

class ShopController extends Controller
{
    public function index()
    {
        $shop = Auth::user()->shop;
        return view('seller.shop', compact('shop'));
    }

    public function update(Request $request)
    {
        $shop = Shop::find($request->shop_id);

        if ($request->has('name') && $request->has('address')) {
            if ($request->has('shipping_cost')) {
                $shop->shipping_cost = $request->shipping_cost;
            }

            $shop->name             = $request->name;
            $shop->address          = $request->address;
            $shop->phone            = $request->phone;
            $shop->slug             = preg_replace('/\s+/', '-', $request->name) . '-' . $shop->id;
            $shop->meta_title       = $request->meta_title;
            $shop->meta_description = $request->meta_description;
            $shop->logo             = $request->logo;
        }

        if ($request->has('delivery_pickup_longitude') && $request->has('delivery_pickup_latitude'))
        {
            $shop->delivery_pickup_longitude    = $request->delivery_pickup_longitude;
            $shop->delivery_pickup_latitude     = $request->delivery_pickup_latitude;
        } 
        elseif ($request->has('facebook') || $request->has('google') || $request->has('twitter') ||$request->has('youtube') || $request->has('instagram'))
        {
            $shop->facebook = $request->facebook;
            $shop->instagram = $request->instagram;
            $shop->google = $request->google;
            $shop->twitter = $request->twitter;
            $shop->youtube = $request->youtube;
        }

        if ($shop->save()) {
            flash(translate('Your Shop has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function bannerUpdate(Request $request){
        $shop = Shop::find($request->shop_id);
        $shop->top_banner_image     = $request->top_banner_image;
        $shop->top_banner_link      = $request->top_banner_link;
        $shop->slider_images        = $request->slider_images;
        $shop->slider_links         = $request->slider_links;
        $shop->banner_full_width_1_images   = $request->banner_full_width_1_images;
        $shop->banner_full_width_1_links    = $request->banner_full_width_1_links;
        $shop->banners_half_width_images    = $request->banners_half_width_images;
        $shop->banners_half_width_links     = $request->banners_half_width_links;
        $shop->banner_full_width_2_images   = $request->banner_full_width_2_images;
        $shop->banner_full_width_2_links    = $request->banner_full_width_2_links;
        if ($shop->save()) {
            flash(translate('Your Shop banners has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function verify_form()
    {
        if (Auth::user()->shop->verification_info == null) {
            $shop = Auth::user()->shop;
            return view('seller.verify_form', compact('shop'));
        } else {
            flash(translate('Sorry! You have sent verification request already.'))->error();
            return back();
        }
    }

    public function verify_form_store(Request $request)
    {
        $data = array();
        $i = 0;
        foreach (json_decode(BusinessSetting::where('type', 'verification_form')->first()->value) as $key => $element) {
            $item = array();
            if ($element->type == 'text') {
                $item['type'] = 'text';
                $item['label'] = $element->label;
                $item['value'] = $request['element_' . $i];
            } elseif ($element->type == 'select' || $element->type == 'radio') {
                $item['type'] = 'select';
                $item['label'] = $element->label;
                $item['value'] = $request['element_' . $i];
            } elseif ($element->type == 'multi_select') {
                $item['type'] = 'multi_select';
                $item['label'] = $element->label;
                $item['value'] = json_encode($request['element_' . $i]);
            } elseif ($element->type == 'file') {
                $item['type'] = 'file';
                $item['label'] = $element->label;
                $item['value'] = $request['element_' . $i]->store('uploads/verification_form');
            }
            array_push($data, $item);
            $i++;
        }
        $shop = Auth::user()->shop;
        $shop->verification_info = json_encode($data);
        if ($shop->save()) {
            $users = User::findMany([User::where('user_type', 'admin')->first()->id]);
            $data = array();
            $data['shop'] = $shop;
            $data['status'] = 'submitted';
            $data['notification_type_id'] = get_notification_type('shop_verify_request_submitted', 'type')->id;
            Notification::send($users, new ShopVerificationNotification($data));
            
            flash(translate('Your shop verification request has been submitted successfully!'))->success();
            return redirect()->route('seller.dashboard');
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function show()
    {
    }

    public function categoriesWiseCommission(Request $request){
        $sort_search =null;
        $categories = Category::orderBy('order_level', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%'.$sort_search.'%');
        }
        $categories = $categories->paginate(15);
        return view('seller.categoryWise_commission', compact('categories'))->render();
    }
}
