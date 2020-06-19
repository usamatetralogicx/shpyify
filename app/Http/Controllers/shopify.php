<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Response;
class shopify extends Controller
{
     public $helper;
    public $multiplier;

      public function __construct()
    {
        $this->helper = new helperController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $all=Product::all();
            return view('dashboard',['all'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function orders()
    {
        //$shop = $this->helper->getShopify()->getShop();

        $count = $this->helper->getShopify()->rest('GET', '/admin/api/2019-07/products.json');
        //dd($count);
        ;
        //dd($count['body']->container['products'][1]['title']);
         foreach($count['body']->container['products'] as $product)
         {
            $products= new Product();
        $products->title=$product['title'];
        $products->body_html=$product['body_html'];
        $products->vendor=$product['vendor'];
        $products->product_type=$product['product_type'];
        $products->handle=$product['handle'];
        $products->tags=$product['tags'];
        $products->save();
    }
            
            $all=Product::all();
            return view('dashboard',['all'=>$all]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getback($id)
    {
           $count = $this->helper->getShopify()->rest( 'PUT' ,'/admin/api/2020-04/products/{product_id}.json');
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
        $product=Product::find($id);
        return view('update',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request){

      $messages=array(
        'title.required'=>'This field is required',
         'body.required'=>'This field is required',
          'vendor.required'=>'This field is required',
       
      );
      $rules=array(
        'title'=>'required|string',
        'body'=>'required',
        'vendor'=>'required',
       
      );
      $validator=\Validator::make($request->all(),$rules,$messages);
      if($validator->fails()){
        return Response::json(['success'=>'0','validation'=>'0','message'=>$validator->errors()]);
      }
        else
        {
        $product= Product::find($request->id);
      $product->title=$request->title;
      $product->body_html=$request->body;
      $product->vendor=$request->vendor;
      $product->save();
               return Response::json(['success' => '1','message' => 'User update successfully']);

        }

        
      
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($id)
    {
       $user =Product::find($id);
       if($user->delete())
       {
         // unlink(public_path().'/images/'.$user->image);
           //unlink(public_path() . $user->avatar->file);
         //    unlink(public_path().'images/thumb/'.$user->image);
        // Storage::disk('public')->delete($user->image);
         return response()->json([
        'success' => 'Record deleted successfully!'
    ]);
       }
  
    }
}
