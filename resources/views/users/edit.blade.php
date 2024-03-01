@extends('layouts.master')
@section('css')
<script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل المستخدم</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						<div class="mb-3 mb-xl-0">
							
						</div>
					</div>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                    </div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                <div class="row">
                    <div class="col-lg-12 margin-tb mb-4">
                        <div class="pull-left">
                           
                        </div>
                    </div>
                </div>
            
            
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
            
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-md-4 mb-3">
                            <div class="form-group">
                                <strong>الاسم:</strong>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control"
                                    placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 mb-3">
                            <div class="form-group">
                                <strong>الايميل:</strong>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 mb-3">
                            <div class="form-group">
                                <strong>الباسورد:</strong>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 mb-3">
                            <div class="form-group">
                                <strong>تأكيد الباسورد:</strong>
                                <input type="password" name="confirm-password" class="form-control"
                                    placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 mb-3">
                            <div class="form-group">
                                <strong>نوع المستخدم:</strong>
                                <select class="form-control multiple" multiple name="roles[]">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12  mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection