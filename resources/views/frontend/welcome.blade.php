@extends('layouts.frontend')
@section('content')
  <section>
    <div class="container">
        <h3 class="text-center"> মামলার সংক্ষিপ্ত বিবরণ:</h3>
        <table class="table table-striped table-bordered">
  <thead>
   <tr>
      <th scope="col">বাদী / বিবাদী</th>
      <th scope="col">পক্ষে</th>
      <th scope="col">পরবর্তী তারিখ</th>
      <th scope="col">ধার্য</th>
      <th scope="col">থানা</th>
      <th scope="col">মামলা নং</th>
      <th scope="col">আদালত</th>
      <th scope="col">পূর্ব তারিখ</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($model as $element)
   <tr>
     <td scope="row">{{$element->client->name}}</td>
     <td>{{$element->client_category->name}}</td>
     <td>{{$element->hearing?$element->hearing[0]->date:''}}</td>
     <td>{{$element->case_stage->name}}</td>
     <td>{{$element->thana}}</td>
     <td>{{$element->case_no}}</td>
     <td>{{$element->court->name}}</td>
     <td>{{isset($element->hearing[1])?$element->hearing[1]->date:''}}</td>
   </tr>
  @endforeach
  </tbody>
</table>
{{ $model->links() }}
</div>
</section>
@stop