@extends('layouts.main')

@section('content')
<!-- Page header -->

@if(session()->has('success'))
    <div class="alert alert-success alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                class="sr-only">Close</span></button>
        <span class="text-semibold">Well done!</span> {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('msg'))
    <div class="alert alert-success alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                class="sr-only">Close</span></button>
        <span class="text-semibold">Well done!</span> {{ session()->get('msg') }}
    </div>
    @endif
      @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                class="sr-only">Close</span></button>
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Quote</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Quote</li>
                </ul>
            </div>
           
            
                    <form id="contact-form" action="{{route('quote_update',['id' => $arrData->id])}}" method="post">
                        {{ csrf_field() }}
            {{ method_field('post') }}
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box user-icon mb-30">
                                    <input type="text" name="name" placeholder="Name" value="{{$arrData->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box email-icon mb-30">
                                    <input type="text" name="phone" placeholder="Phone" value="{{$arrData->phone}}">
                                </div>
                            </div>
                             <div class="col-lg-6 col-md-6">
                                <div class="form-box email-icon mb-30">
                                    <input type="text" name="company" placeholder="Company" value="{{$arrData->company}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <div class="select-itms">
                                    <select name="select1" id="select2">
                                        <option value="">Customer</option>
                                        <option value="">Hospital</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box subject-icon mb-30">
                                    <input type="Email" name="email" placeholder="Email" value="{{$arrData->email}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-box message-icon mb-65">
                                    <textarea name="message" id="message" placeholder="Message" value="">{{$arrData->message}}</textarea>
                                </div>
                                <div class="submit-info">
                                    <button class="" type="submit">Submit Now <i class="ti-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
           
        </div></div></div>

@endsection