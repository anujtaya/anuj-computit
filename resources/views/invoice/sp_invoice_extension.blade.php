<!-- invoice items and extra breakdown summary-->
<div  class="pl-4 pr-4 pt-2">
   <div class="w3-row m-2">
      <div class="w3-col s12">
      <table class="table  w3-margin-bottom" style="align:right;">
            <tr>
               <th class="border-0">Item Description</th>
               <th class="w3-right-align border-0">QTY</th>
               <th class="w3-right-align border-0">Price</th>
               <th class="w3-right-align border-0">Total</th>
            </tr>
            <tr class="mt-1 border-0">
               <td  class="border-0">{{{$job->service_category_name}}} - {{{$job->service_subcategory_name}}}</td>
               <td class="w3-right-align border-0">1</td>
               <td class="w3-right-align border-0">{{number_format($conversation->json['offer'], 2)}}</td>
               <td class="w3-right-align border-0">${{number_format($conversation->json['offer'], 2)}}</td>
            </tr>
            <tr  class="text-white">
               <td style="border-bottom: 6px solid #dee2e6!important;border-top:0px;">.</td>
               <td style="border-bottom: 6px solid #dee2e6!important;border-top:0px;">.</td>
               <td style="border-bottom: 6px solid #dee2e6!important;border-top:0px;">.</td>
               <td style="border-bottom: 6px solid #dee2e6!important;border-top:0px;">.</td>
            </tr>
            @if($extras !=null)
            <tr class="text-white">
               <td class="w3-right-align border-0">.</td>
               <td class="w3-right-align border-0">.</td>
               <td class="w3-right-align border-0">.</td>
               <td class="w3-right-align border-0">.</td>
            </tr>
            <tr class="mt-1">
               <th class="border-0">Extras</th>
               <th class="w3-right-align border-0"></th>
               <th class="w3-right-align border-0"></th>
               <th class="w3-right-align border-0"></th>
            </tr>
            @foreach($extras as $extra)
            <tr class="mt-1">
               <td class="border-0">{{{$extra->name}}} - {{{$extra->description}}}</td>
               <td class="w3-right-align border-0">{{$extra->quantity}}</td>
               <td class="w3-right-align border-0">{{$extra->price}}</td>
               <td class="w3-right-align border-0">${{number_format((float)$extra->price * $extra->quantity, 2, '.', '')}}</td>
            </tr>
            @endforeach
            <tr  class="text-white">
               <td style="border-bottom: 6px solid #dee2e6!important;border-top:0px;">.</td>
               <td style="border-bottom: 6px solid #dee2e6!important;border-top:0px;">.</td>
               <td style="border-bottom: 6px solid #dee2e6!important;border-top:0px;">.</td>
               <td style="border-bottom: 6px solid #dee2e6!important;border-top:0px;">.</td>
            </tr>
            @else
            <tr>
               <td>
                  <p>No extras were assigned to this job.</p>
               </td>
            </tr>
            @endif
         </table>
      </div>
   </div>
</div>
<!-- service seeker info and payment summary -->
<div  class="pl-4 pr-4 pt-2">
   <div class="w3-row m-2">
      <div class="w3-col s6">
         <p class="font-weight-bolder">Service Seeker</p>
         <p class="mt-1">{{$service_seeker->first}} {{$service_seeker->last}}</p>
         <p>{{$service_seeker->email}}</p>
      </div>
      <div class="w3-col s6">
            <table class="table table-sm table-borderless">
               <tr>
                  <td class="font-weight-bolder" style="padding: .1rem;">Sub Total:</td>
                  <td class="text-right" style="padding: .1rem;">${{number_format($job_payment->job_price,2)}}</td>
               </tr>
               <tr>
                  <td class="font-weight-bolder" style="padding: .1rem;">Service Fee (0%): <br><small>(Service fee waved for a limited time.)</small></td>
                  <td class="text-right" style="padding: .1rem;">- ${{number_format($job_payment->service_fee_price,2)}}</td>
               </tr>
               <tr>
                  <td class="font-weight-bolder" style="padding: .1rem;">GST (10%):</td>
                  <td class="text-right" style="padding: .1rem;">+ ${{number_format($job_payment->gst_fee_value,2)}}</td>
               </tr>
               <tr>
                  <td class="font-weight-bolder" style="padding: .1rem;">Grand Total:</td>
                  <td class="text-right" style="padding: .1rem;">${{number_format($job_payment->service_provider_gets,2)}}</td>
               </tr>
            </table>
      </div>
   </div>
</div>
