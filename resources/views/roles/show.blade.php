@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						<div class="mb-3 mb-xl-0">
						
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-lg-12 margin-tb mb-4">
                        
                    </div>
                </div>
            
            
                <div class="row">
                    <div class="col-xs-12 mx-auto mb-3">
                        <div class="form-group">
                            <strong>اسم الصلاحية:</strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <br>
                    <div class="col-xs-12 mx-auto mb-3">
                        <div class="form-group">
                            <strong>الصلاحيات:</strong>
                            @if (!empty($rolePermissions))
                                @foreach ($rolePermissions as $v)
                                    <label class="label label-secondary text-dark">{{ $v->name }},</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection