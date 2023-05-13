@extends('layouts.app')
@section('content')
    @component('client.components.breadcrumb')
        @slot('title') Жеке кабинет@endslot
        @slot('parent') Басты бет @endslot
        @slot('active') Жеке кабинет @endslot
    @endcomponent
    <section class="s-profile">
        <div class="container">
            <div class="profile">
                <div class="profile-image">
                    <div class="profile-image-text">Менің фотом</div>
                    <img src="{{  asset($user->image ? \App\Models\User::IMAGE_PATH.$user->image :  'images/user.png')}}" alt="user image">
                    <form id="uploadImageForm"
                          action="{{ route('profile.upload_image') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="upload_image-file" name="image" type="file"
                               hidden
                               accept="image/jpeg,image/png,image/gif,image/svg+xml"
                               onchange="$('#uploadImageForm').submit()">
                        <label for="upload_image-file" class="default-btn">
                            Сурет жүктеу
                        </label>
                    </form>

                    {{--                    <button class="btn default-btn">--}}
                    {{--                        Добавить свое фото--}}
                    {{--                    </button>--}}
                </div>
                <div class="profile-info">
                    <div class="profile-card">
                        <div class="title">
                            Жеке ақпараттар
                        </div>
                        <div class="profile-card-body">
                            <div class="default-card-table">
                                <div class="card-table-row">
                                    <div class="card-table-key">
                                        Аты-жөні
                                    </div>
                                    <div class="card-table-value">
                                        {{$user->full_name}}
                                    </div>
                                </div>
                                <div class="card-table-row">
                                    <div class="card-table-key">
                                        Электронды пошта
                                    </div>
                                    <div class="card-table-value">
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <div class="card-table-row">
                                    <div class="card-table-key">
                                        Телефон нөмірі
                                    </div>
                                    <div class="card-table-value">
                                        {{ $user->phone ?? 'Не задано' }}
                                    </div>
                                </div>
                            </div>
                            <div class="buttons">

                                <button class="btn default-btn" onclick="openEditUser()">
                                    Өзгерту
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="profile-card">
                        <div class="title">
                            Құпия сөз
                        </div>
                        <div class="profile-card-body">
                            <div class="text-dark">
                                Құпия сөзді өзгерту үшін келесі батырманы басыңыз
                            </div>
                            <div class="buttons">
                                <button class="btn default-btn" onclick="openEditUserPassword()">
                                    Өзгерту
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @component('client/components/modalEditUser', ['user'  => $user])
    @endcomponent
    @component('client/components/modalEditPasswordUser', ['user'  => $user])
    @endcomponent

    {{--    @include('client/components/modalEditPasswordUser', ['user'  => $user])--}}
@endsection

@section('custom_js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            @if(session('success'))
            // console.log(session('success'))
            alertModal()
            @endif
        });
    </script>
@endsection

