@extends('layouts.admin')

@section('title','Админ панель - Қолданушыны өзгерту')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin_asset/admin.css')}}">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Қолданушыны өзгерту № {{ $user->id }}@endslot
        @slot('parent') Басты бет @endslot
        @slot('users') Қолданушылар тізімі @endslot
        @slot('active') Қолданушы № {{ $user->id }}@endslot
    @endcomponent

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <form method="post" action="{{ route('admin.users.update', $user)}}" class="add_product_form"
                              name="add_product_form"
                              enctype="multipart/form-data"
                        >
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">{{__('Аты-жөні')}} <i class="fa red">*</i></label>
                                    <input type="text" value="{{ old('full_name') ?? ($user->full_name ?? "")}}"
                                           name="full_name" placeholder="Аты-жөні"
                                           class="form-control"
                                           required
                                    >
                                    @error('full_name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('Почта')}}</label>
                                    <input type="email" value="{{ old('email') ?? ($user->email ?? "")}}"
                                           name="email" placeholder="Почта"
                                           class="form-control"
                                    >
                                    @error('email')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('Телефон')}} <i class="fa red">*</i></label>
                                    @php
                                        $phone  = old('phone') ?? ($user->phone ?? "");

                    if (!empty($phone)) {
                                        $phone =  preg_replace('~.*(\d{1})(\d{3})(\d{3})(\d{2})(\d{2}).*~', '+$1 ($2)-$3-$4-$5', $user->phone);
                    }


                                    @endphp
                                    <input id="login_phone" name="phone"
                                           value="{{ $phone}}"
                                           required
                                           class="default-input modal-form-input" type="text"
                                           placeholder="+7 (700)-999-99-99">
                                    @error('phone')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('Құпия сөз')}}</label>
                                    <input type="password"
                                           name="password" placeholder="Құпия сөз"
                                           class="form-control"
                                    >
                                    @error('password')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сақтау</button>
                                <a class="btn btn-danger"
                                   href="{{ redirect()->getUrlGenerator()->previous() }}">Артқа</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
