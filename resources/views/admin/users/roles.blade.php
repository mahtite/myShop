@extends('admin.layouts.master')
@section('title','نقش کاربر ')
@section('content')





    <div class="row">
        <div class="col-xl-6 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">نقش کاربر</h4>

                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form method="post" action="{{ route('update.roles',['user'=>$user->id]) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="exampleInputEmail111">انتخاب نقش</label>
                                <select name="roles" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail111">انتخاب مجوز</label>
                                <select name="permissions[]" class="form-control" multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}" >{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">ثبت</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">نقش انتخاب شده برای {{ $user->name }}</h4>

                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail111">انتخاب نقش</label>
                            <select name="roles" class="form-control" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ in_array($user->id,$role->users()->pluck('id')->toArray())? 'selected':'' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail111">انتخاب مجوز</label>
                            <select name="permissions[]" class="form-control" multiple>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}" {{ in_array($user->id,$permission->users()->pluck('id')->toArray())? 'selected':'' }}>{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
