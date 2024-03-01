@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ صلاحيات المستخدمين</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
							
							</div>
						</div>
					</div>
                    <div class="pull-left">
                            
                        <div class="float-end">
                            
                                <a class="btn btn-success" href="{{ route('roles.create') }}">اضافة صلاحية جديدة</a>
                            
                        </div>
                    </h2>
                </div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                <div class="row">
                    
                </div>
            
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            
                <table class="table table-striped table-hover">
                    <tr>
                        <th>اسم الصلاحية</th>
                        <th width="280px">العمليات</th>
                    </tr>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">عرض</a>
                                    {{-- @can('role-edit') --}}
                                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                    {{-- @endcan --}}
            
            
                                    @csrf
                                    @method('DELETE')
                                    {{-- @can('product-delete') --}}
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    {{-- @endcan --}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            
                {!! $roles->render() !!}
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection