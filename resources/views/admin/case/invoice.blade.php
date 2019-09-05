<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title> Invoice</title>
<section class="bg-light"> 
    <div class="container ">
        <div class="row py-5">
            <div class="col-md-6" style="border-right: 1px dotted">
                <div class="row">
                    <div class="col-12 text-right">
                        <p> {{_lang('Office_copy')}}</p>
                    </div>
                    <div class="col-2 ml-auto">
                    @if (get_option('logo'))
                       <img class="w-100" src="{{asset('/storage/logo/'.get_option('logo'))}}" alt="">
                       @else
                       <img class="w-100" src="{{asset('/img/logo.png')}}" alt="">
                    @endif
                         
                    </div>
                    <div class="col-8 text-center">
                        <p class="mb-0 h5"> {{get_option('owner_name')?get_option('owner_name'):_lang('Satt Advocate')}} </p>
                        <p class="mb-0 text-uppercase"> {{get_option('education')?get_option('education'):_lang('Satt')}}</p>
                        <p class="mb-0"> {{get_option('phone')}},{{get_option('alt_phone')}}</p>
                        <p class="mb-0"> {{get_option('address')}}</p>
                    </div>
                </div>
                <div class="row py-4">
                    <div class="col-6">
                        <p class="mb-0"> {{_lang('client_name')}}: {{$payment->case->client->name}}</p>
                        <p class="mb-0">{{_lang('case_no')}} : {{$payment->case->case_no}}</p>
                        <p class="mb-0"> {{_lang('invoice_no')}}: {{$payment->invoice_no}}</p>
                    </div>
{{--                     <div class="col-6">
                        <p class="mb-0"> ID No: 00094 </p>
                        <p class="mb-0"> Regtretion: 00121</p>
                    </div> --}}
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{_lang('id')}}</th>
                            <th scope="col">{{_lang('amount')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$payment->amount}} {!!get_option('currency')!!}</td>
                        </tr>
                        <tr>
                            <td>{{_lang('total_amount')}}</td>
                            <td class="font-weight-bold">{{$payment->amount}} {!!get_option('currency')!!}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row fotter pt-5">
                    <div class="col-4">
                        <p> {{_lang('collected_by')}}. Admin</p>
                    </div>
                    <div class="col-4">
                        <p> {{_lang('Date')}}: {{date("F d Y",strtotime($payment->date))}}</p>
                    </div>
                    <div class="col-4">
                        <p> {{_lang('signature_of_author')}}</p>
                    </div>
                </div>
            </div>


              <div class="col-md-6">
                <div class="row">
                    <div class="col-12 text-right">
                        <p> {{_lang('client_Copy')}}</p>
                    </div>
                    <div class="col-2 ml-auto">
                     @if (get_option('logo'))
                       <img class="w-100" src="{{asset('/storage/logo/'.get_option('logo'))}}" alt="">
                       @else
                       <img class="w-100" src="{{asset('/img/logo.png')}}" alt="">
                    @endif
                    </div>
                    <div class="col-8 text-center">
                        <p class="mb-0 h5"> {{get_option('owner_name')?get_option('owner_name'):_lang('Satt Advocate')}} </p>
                        <p class="mb-0 text-uppercase"> {{get_option('education')?get_option('education'):_lang('Satt')}}</p>
                        <p class="mb-0"> {{get_option('phone')}},{{get_option('alt_phone')}}</p>
                        <p class="mb-0"> {{get_option('address')}}</p>
                    </div>
                </div>
                <div class="row py-4">
                    <div class="col-6">
                        <p class="mb-0"> {{_lang('client_name')}}: {{$payment->case->client->name}}</p>
                        <p class="mb-0">{{_lang('case_no')}} : {{$payment->case->case_no}}</p>
                        <p class="mb-0"> {{_lang('invoice_no')}}: {{$payment->invoice_no}}</p>
                    </div>
{{--                     <div class="col-6">
                        <p class="mb-0"> ID No: 00094 </p>
                        <p class="mb-0"> Regtretion: 00121</p>
                    </div> --}}
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{_lang('id')}}</th>
                            <th scope="col">{{_lang('amount')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$payment->amount}} {!!get_option('currency')!!}</td>
                        </tr>
                        <tr>
                            <td>{{_lang('total_amount')}}</td>
                            <td class="font-weight-bold">{{$payment->amount}} {!!get_option('currency')!!}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row fotter pt-5">
                    <div class="col-4">
                        <p> {{_lang('collected_by')}}. Admin</p>
                    </div>
                    <div class="col-4">
                        <p> {{_lang('Date')}}: {{date("F d Y",strtotime($payment->date))}}</p>
                    </div>
                    <div class="col-4">
                        <p> {{_lang('signature_of_author')}}</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>