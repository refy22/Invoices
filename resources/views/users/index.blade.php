@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المستخدمين</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								
							</div>
						</div>
					</div>
          <div class="pull-left">
            @haspermission('اضافة مستخدم','web')
            <div class="float-end">
              <a class="btn btn-success" href="{{ route('users.create') }}"> اضافة مستخدم جديد</a>
          </div>
            @endhaspermission                                
            
                
            </div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="row">
                        <div class="col-lg-12 margin-tb mb-4">
                          
                        </div>
                    </div>
                    
                    
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success my-2">
                      <p>{{ $message }}</p>
                    </div>
                    @endif
                    
                    
                    <table class="table table-bordered table-hover table-striped">
                     <tr>
                       <th>الاسم</th>
                       <th>الايميل</th>
                       <th>حالة المستخدم</th>
                       <th>نوع المستخدم</th>
                       <th width="280px">العمليات</th>
                     </tr>
                     @foreach ($data as $key => $user)
                      <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                     
                       <input type="hidden"  @if($user->Status == 'مفعل'){{$act = 'badge-success'}}@endif>
                       <td> <label class="badge {{$act}} text-dark">{{ $user->Status }}</label></td>
                     
                     
                        <td>
                          @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                               <label class="badge badge-secondary text-dark">{{ $v }}</label>
                            @endforeach
                          @endif
                        </td>
                        <td>
                           <a class="btn btn-sm btn-info" href="{{ route('users.show',$user->id) }}">عرض</a>
                           <a class="btn btn-sm btn-primary" href="{{ route('users.edit',$user->id) }}">تعديل</a>
                          <span class="btn btn-sm btn-danger" ><form method='post' action='{{route('users.destroy',$user->id)}}'>
                            @csrf
                            @method('delete')
                           <button class="btn btn-sm btn-danger" type='submit' ">حذف</button>
                           </form></span>
                        </td>
                      </tr>
                     @endforeach
                    </table>
                    
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection