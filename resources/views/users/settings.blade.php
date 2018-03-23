@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Settings</div>

                <div class="card-body">
                   <form action="/user/settings" method="post" enctype="multipart/form-data">
                       {{ csrf_field() }}
                       {{ method_field('PUT') }}
                       <input type="file" name="image" id="image">
                       <button type="submit">Update</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
