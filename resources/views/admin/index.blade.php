@extends('layouts.admin')

@section('title','Админ панель - Басты бет')


@section('content')
    @component('admin.components.breadcrumb')
        @slot('title') Басқару панелі @endslot
        @slot('active') Басты бет @endslot
    @endcomponent
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $coursesCount }}</h3>
                            <p>Курстар саны</p>
                        </div>

                        <a href="{{ route('admin.courses.index')}}" class="small-box-footer">Толық ашу <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $usersCount }}</h3>
                            <p>Тіркелген қолданушылар</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('admin.users.index')}}" class="small-box-footer">Толық ашу <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
