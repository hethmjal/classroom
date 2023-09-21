@extends('layout.master',['title' => 'Plans'])
@section('content')

<div class="container">
    <div class="card-deck mb-3 text-center">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Pricing</h1>
            <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" aria-hidden="true" class="_8pb48z0 _1n5grcp1r _1n5grcp59v _1n5grcp2k9"><path d="M486.2 50.2c-9.6-3.8-20.5-1.3-27.5 6.2l-98.2 125.5-83-161.1C273 13.2 264.9 8.5 256 8.5s-17.1 4.7-21.5 12.3l-83 161.1L53.3 56.5c-7-7.5-17.9-10-27.5-6.2C16.3 54 10 63.2 10 73.5v333c0 35.8 29.2 65 65 65h362c35.8 0 65-29.2 65-65v-333c0-10.3-6.3-19.5-15.8-23.3z"></path></svg>
          </div> 


        <div class="row">
           
            @foreach ($plans as $plan)
            <div class="col-md-4 ">
                   
                <div class="card mb-4 box-shadow border-primary">
                    <div style="@if($plan->featured) background-color: rgb(103, 103, 211);  color: white; @endif" class="card-header text-bg-primary border-primary">
                      <h4 class="my-0 font-weight-normal">{{$plan->name}}</h4>
                    </div>
                    <div class="card-body">
                      <h1 class="card-title pricing-card-title">${{$plan->price}} <small class="text-muted">/ mo</small></h1>
                      <ul class="list-unstyled mt-3 mb-4">
                        @foreach ($plan->features as $feature)
                        <li> {{$feature->name}}: {{$feature->pivot->feature_value}}</li>
                        @endforeach
                     
                      </ul>
                      <form action="{{route('subscribe')}}" method="post">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{$plan->id}}">
                        <input type="hidden" name="period" value="3">
                        <button 
                        tyle="@if($plan->featured) background-color: rgb(103, 103, 211);  color: white; @endif"
                         type="submit" class="btn btn-lg btn-block btn-outline-primary">Subscribe</button>

                    </form>
                    </div>
                  </div>
                </div>
            @endforeach
    

        </div>
    </div>
</div>
@endsection