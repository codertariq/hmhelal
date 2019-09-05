<div class="card border-top-success rounded-top-0">

		<div class="card-body">
			<ul class="nav nav-pills nav-justified">
				<li class="nav-item"><a href="#justified-rounded-pill1" class="nav-link rounded-round active" data-toggle="tab">{{_lang('case_details')}}</a></li>
				<li class="nav-item"><a href="#justified-rounded-pill2" class="nav-link rounded-round" data-toggle="tab">{{_lang('client_details')}}</a></li>
				<li class="nav-item"><a href="#justified-rounded-pill3" class="nav-link rounded-round" data-toggle="tab">{{_lang('hearing_date')}}</a></li>
				<li class="nav-item"><a href="#justified-rounded-pill4" class="nav-link rounded-round" data-toggle="tab">{{_lang('payment')}}</a></li>
			
			</ul>

			<div class="tab-content">
				<div class="tab-pane fade show active" id="justified-rounded-pill1">
				
				<!-- Custom table color -->
				<div class="card">

					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
							@foreach ($client->case as $allcase)
							    <tr>
								<td colspan="3" class="text-center"><b>{{_lang('case_no')}}:{{$loop->iteration}}</b></td>	
								</tr>
								<tr>
									<th>
									{{_lang('title')}} : <b>{{$allcase->title}}</b>
									</th>
									<th>
									 {{_lang('case_no')}} : <b>{{$allcase->case_no}}</b>	
									</th>
									<th>
									{{ _lang('case_category')}}: <b>
									
										@foreach ($allcase->case_categories as $filecase)
											 <span class="badge badge-primary">{{$filecase->category->name}}</span> 
										@endforeach
									</b>
									</th>
								</tr>
								
								  <tr>
									<th>
									{{_lang('court')}} : <b>{{$allcase->client->name}}</b>
									</th>
									<th>
									 {{_lang('case_stage')}} : <b>{{$allcase->case_stage->name}}</b>	
									</th>
									<th>
									{{ _lang('act')}}: <b>
										@foreach ($allcase->case_act as $act)
											 <span class="badge badge-primary">{{$act->actname->name}}</span> 
										@endforeach
									</b>	
									</th>
								</tr>
									<tr>
									<th>
									{{_lang('filing_date')}} : <b>{{$allcase->filling_date}}</b>
									</th>
									<th>
									 {{_lang('first_hearing_date')}} : <b>{{$allcase->first_hearing_date}}</b>	
									</th>
									<th>
									{{ _lang('opposite_lawyer')}}: <b>{{$allcase->opposite_lawyer}}
									</b>	
									</th>
								</tr>

									<tr>
									<th>
									{{_lang('thana')}} : <b>{{$allcase->thana}}</b>
									</th>
									<th>
									 {{_lang('reference')}} : <b>{{$allcase->denemee}}</b>	
									</th>
									<th>
									{{ _lang('file_number')}}: <b>{{$allcase->file_no}}
									</b>	
									</th>
								</tr>
								
								@endforeach
							</thead>
						</table>
					</div>
					</div>

				
				</div>
				<!-- /custom table color -->
				</div>

				<div class="tab-pane fade" id="justified-rounded-pill2">
					<div class="card">
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								
								<tr>
									<th>
									{{_lang('client')}} : <b>{{$client->name}}</b>
									</th>
									<th>
									{{ _lang('division')}}: <b>{{$client->division->name}}</b>	
									</th>

									<th>
									{{ _lang('gender')}}: <b>{{$client->gender}}</b>	
									</th>
								  </tr>
								  <tr>
									<th>
									{{_lang('district')}} : <b>{{$client->district->name}}</b>
									</th>
									<th>
									 {{_lang('gender')}} : <b>{{$client->gender}}</b>	
									</th>
									<th>
									{{ _lang('mobile')}}: <b>
										{{$client->mobile}}
									</b>	
									</th>
								</tr>
									<tr>
									<th>
									{{_lang('email')}} : <b>{{$client->email}}</b>
									</th>
									<th>
									 {{_lang('address')}} : <b>{{$client->address}}</b>	
									</th>
								</tr>
							</thead>
						</table>
					</div>
					</div>

				
				</div>
				</div>


				<div class="tab-pane fade" id="justified-rounded-pill3">
					<div class="row">
					<div class="col-lg-12">
		             <div class="card">
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered ">
							<thead>
								<tr>
									<th>{{_lang('next_date')}}</th>
									<th>{{_lang('note')}}</th>
									<th>{{_lang('attachment')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach  ($client->case as $heardate)
									<tr>
										<td colspan="3" class="text-center"><b>{{_lang('case_no')}}:{{$loop->iteration}}</b></td>	
									</tr>
								@foreach ($heardate->hearing as $nextdate)
								
							
									<tr>
										<td>{{$nextdate->date}}</td>
										<td>{{str_limit($nextdate->note,100)}}</td>
										<td>
										   @if ($nextdate->file)
										   	<a href="{{asset('/storage/case/file/'.$nextdate->file)}}"><i class="icon-download7"></i></a>
										   	@else
										   	<span class="badge badge-danger">{{_lang('no_attachment')}}</span>
										   	@endif	
										</td>
									</tr>
									@endforeach
								@endforeach
							</tbody>
						</table>
					</div>
					</div>

				
				   </div>
		          </div>
		         </div>
				</div>

				<div class="tab-pane fade" id="justified-rounded-pill4">

		             <div class="card">
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>{{_lang('invoice_no')}}</th>
									<th>{{_lang('amount')}}</th>
									<th>{{_lang('mode')}}</th>
									<th>{{_lang('date')}}</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($client->case as $payment)
								@foreach ($payment->case_payment as $allpayment)
									<tr>
										<td>{{$allpayment->invoice_no}}</td>
										<td>{{$allpayment->amount}} {!!get_option('currency')!!}
										</td>
										<td>
										{{$allpayment->mode}}	
										</td>
										<td>
											{{$allpayment->date}}
										</td>
									</tr>
								@endforeach
								@endforeach
						
							</tbody>
						</table>
					</div>
					</div>

				
				</div>
				</div>

		</div>
	</div>
	</div>