@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="panel panel-primary tabs-style-3">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu ">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-info-circle"></i> تفاصيل الفاتورة</a></li>
                                    <li><a href="#tab12" data-toggle="tab"><i class="fa fa-credit-card"></i> حالات الدفع</a></li>
                                    <li><a href="#tab13" data-toggle="tab"><i class="fa fa-paperclip"></i> المرفقات </a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab11">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">تفاصبل الفاتورة</h4>
                                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                                        <tbody>
                                                            <tr>
                                                                <td>رقم الفاتورة : {{$details->invoice_number}}</td>
                                                                <td>تاريخ الاصدار :{{$invoice->invoice_date}}</td>
                                                                <td>تاريخ الاستحقاق :{{$invoice->due_date}}</th>
                                                                <td>القسم : {{$invoice->section->section_name}}</td>
                                                                <td>المنتج :{{$invoice->product}}</td>
                                                                <td>المستخدم : {{$details->user}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>مبلغ التحصيل : {{$invoice->amount_collection}}</td>
                                                                <td>مبلغ العمولة : {{$invoice->amount_commission}}</td>
                                                                <td>الخصم : {{$invoice->discount}}</td>
                                                                <td>نسبة الضريبة: {{$invoice->rate_vat}}</td>
                                                                <td>قيمة الضريبة: {{$invoice->value_vat}}</td>
                                                                <td>الاجمالي مع الضريبة: {{$invoice->total}}</td>
                                                            </tr>
                                                            <tr>
                                                                
                                                                @if ($invoice->value_status == 1)
                                                                <td>الحالة الحالية:<span
                                                                        class="badge badge-pill badge-success"> {{$invoice->status}}</span>
                                                                </td>
                                                            @elseif($invoice->value_status ==2)
                                                                <td>الحالة الحالية:<span
                                                                        class="badge badge-pill badge-danger"> {{$invoice->status}}</span>
                                                                </td>
                                                            @else
                                                                <td>الحالة الحالية:<span
                                                                        class="badge badge-pill badge-warning">  {{$invoice->status}} </span>
                                                                </td>
                                                            @endif
                                                                <td>ملاحظات: {{$invoice->note}}</td>
                                                                
                                                            </tr>

                                                           
                                                        </tbody>
                                                    </table>
                                                </div><!-- bd -->
                                            </div><!-- bd -->
                                        </div><!-- bd -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab12">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header pb-0 ">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">حالات الدفع</h4>
                                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                                </div>
                                           </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>رقم الفاتورة</th>
                                                                <th>حالات الدفع</th>
                                                                <th>القسم</th>
                                                                <th>ملاحظات</th>
                                                                <th>تاريخ الاضافة</th>
                                                                <th>المستخدم</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{$details->invoice_number}}</td>
                                                                @if ($invoice->value_status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success"> {{$invoice->status}}</span>
                                                                </td>
                                                            @elseif($invoice->value_status ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger"> {{$invoice->status}}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">  {{$invoice->status}} </span>
                                                                </td>
                                                            @endif
                                                               <td>{{$invoice->section->section_name}}</td>
                                                                <td>{{$invoice->note}}</td>
                                                                <td>{{$invoice->created_at}}</td>
                                                                <td>{{$details->user}}</td>
                                                            </tr>
                                              
                                                        </tbody>
                                                    </table>
                                                </div><!-- bd -->
                                            </div><!-- bd -->
                                        </div><!-- bd -->
                                    </div>
                                    <!--/div-->
                 </div>
                                <div class="tab-pane" id="tab13">
                                    <div class="card card-statistics">
                                     
                                            <div class="card-body">
                                                <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                <h5 class="card-title">اضافة مرفقات</h5>
                                                <form method="post" action="{{ url('/InvoiceAttachments') }}"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            name="file_name" required>
                                                        <input type="hidden" id="customFile" name="invoice_number"
                                                            value="{{ $invoice->invoice_number }}">
                                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                                            value="{{ $invoice->id }}">
                                                        <label class="custom-file-label" for="customFile">حدد
                                                            المرفق</label>
                                                    </div><br><br>
                                                    <button type="submit" class="btn btn-primary btn-sm "
                                                        name="uploadedFile">تاكيد</button>
                                                </form>
                                            </div>
                                      
                                        <br>

                                        <div class="table-responsive mt-15">
                                            <table class="table center-aligned-table mb-0 table table-hover"
                                                style="text-align:center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th scope="col">م</th>
                                                        <th scope="col">اسم الملف</th>
                                                        <th scope="col">قام بالاضافة</th>
                                                        <th scope="col">تاريخ الاضافة</th>
                                                        <th scope="col">العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($attachments as $attachment)
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $attachment->file_name }}</td>
                                                            <td>{{ $attachment->Created_by }}</td>
                                                            <td>{{ $attachment->created_at }}</td>
                                                            <td colspan="2">

                                                                <a class="btn btn-outline-success btn-sm"
                                                                    href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                    role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                    عرض</a>

                                                                <a class="btn btn-outline-info btn-sm"
                                                                    href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                    role="button"><i
                                                                        class="fas fa-download"></i>&nbsp;
                                                                    تحميل</a>

                                                                    <button class="btn btn-outline-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-file_name="{{ $attachment->file_name }}"
                                                                        data-invoice_number="{{ $attachment->invoice_number }}"
                                                                        data-id_file="{{ $attachment->id }}"
                                                                        data-target="#delete_file">حذف</button>
                                                                

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
				</div>
				<!-- row closed -->
                 <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('delete_file') }}" method="post">

                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                    </p>

                    <input type="hidden" name="id_file" id="id_file" value="">
                    <input type="hidden" name="file_name" id="file_name" value="">
                    <input type="hidden" name="invoice_number" id="invoice_number" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
            </form>
        </div>
    </div>
    
                
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_file = button.data('id_file')
        var file_name = button.data('file_name')
        var invoice_number = button.data('invoice_number')
        var modal = $(this)

        modal.find('.modal-body #id_file').val(id_file);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })
</script>
@endsection