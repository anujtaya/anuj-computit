<div  class="w3-padding  w3-border w3-border-light-grey w3-tiny ">
   @if($service_provider_business == null)
   <div class="w3-row">
      <div class="w3-col s4">
         <p style="font-weight: bold;">From:</p>
         <p>{{$service_provider->first}} {{$service_provider->last}}</p>
         <p>ABN: {{$abn_formatted}}</p>
      </div>
      <div class="w3-col s4">
         <p style="font-weight: bold;">To:</p>
         <p>{{$service_seeker->first}} {{$service_seeker->last}}</p>
      </div>
      <div class="w3-col s4">
         <p style="font-weight: bold;">Invoice Information:</p>
         <p>Invoice Number: #INV-{{$job->id}}</p>
         <p>Date -   <?php $phpdate = strtotime( $job->created_at ); $mysqldate = date( 'D d/m/Y', $phpdate );  ?>{{ $mysqldate}}</p>
      </div>
   </div>
   @else
   <div class="w3-row">
      <div class="w3-col s4">
         <p style="font-weight: bold;">From:</p>
         <p>Business Name: {{$service_provider_business->business_name}}</p>
         <p>Email: {{$service_provider_business->business_email}}</p>
         <p>ABN: {{$abn_formatted}}</p>
      </div>
      <div class="w3-col s4">
         <p style="font-weight: bold;">To:</p>
         <p>{{$service_seeker->first}} {{$service_seeker->last}}</p>
      </div>
      <div class="w3-col s4">
         <p style="font-weight: bold;">Invoice Information:</p>
         <p>Invoice Number: #INV-{{$job->id}}</p>
         <p>Date -   <?php $phpdate = strtotime( $job->created_at ); $mysqldate = date( 'D d/m/Y', $phpdate );  ?>{{ $mysqldate}}</p>
      </div>
   </div>
   @endif
</div>
<div  class=" w3-border w3-padding w3-border-light-grey w3-tiny ">
   <p><strong>Invoice Items</strong></p>
   <div  class=" w3-margin-top    w3-tiny">
      <div class="w3-row">
         <table class="table table-bordered w3-margin-bottom" style="align:right;">
            <tr>
               <th >Main Item<small>(s)</small></th>
               <th class="w3-right-align">Item Cost</th>
               <th class="w3-right-align">Item Quantity</th>
               <th class="w3-right-align">Rate</th>
               <th class="w3-right-align">Total</th>
            </tr>
            <tr>
               <td >{{{$job->service_category_name}}} - {{{$job->service_subcategory_name}}}</td>
               <td class="w3-right-align">{{number_format($conversation->json['offer'], 2)}}</td>
               <td class="w3-right-align">1</td>
               <td class="w3-right-align">{{number_format($conversation->json['offer'], 2)}}</td>
               <td class="w3-right-align">${{number_format($conversation->json['offer'], 2)}}</td>
            </tr>
            <tr class=" ">
               <td style="border: none;"></td>
               <td style="border: none;"></td>
               <td style="border: none;"></td>
               <td style="border: none;"></td>
               <td style="border: none;"></td>
            </tr>
            @if($extras !=null)
            <tr>
               <th >Extras</th>
               <th class="w3-right-align">Notes</th>
               <th class="w3-right-align">Quantity</th>
               <th class="w3-right-align">Rate</th>
               <th class="w3-right-align">Extra(s) Total</th>
            </tr>
            @foreach($extras as $extra)
            <tr class="">
               <td>{{{$extra->name}}}</td>
               <td >{{{$extra->description}}}</td>
               <td class="w3-right-align">{{$extra->quantity}}</td>
               <td class="w3-right-align">{{$extra->price}}</td>
               <td class="w3-right-align">${{number_format((float)$extra->price * $extra->quantity, 2, '.', '')}}</td>
            </tr>
            @endforeach
            @else
            <tr>
               <td>
                  <p>No extras were assigned to this job.</p>
               </td>
            </tr>
            @endif
         </table>
         <table  class="w3-table w3-striped w3-border w3-border-light-grey" style="align:right;">
            <tr class="">
               <td></td>
               <td></td>
               <td class="w3-right-align">
                  <div class="w3-row">
                     <div class="w3-col s6 ">
                        Total Service Charges & Extras:
                     </div>
                     <div class="w3-col s6 font-weight-bolder">
                        ${{number_format($job_payment->payable_job_price + $job_payment->payment_processing_fee ,2)}}
                     </div>
                  </div>
                  <div class="w3-row">
                     <div class="w3-col s6">
                        Credit Card Fee:
                     </div>
                     <div class="w3-col s6">
                        ${{number_format($job_payment->payment_processing_fee,2)}}
                     </div>
                  </div>
                  <div class="w3-row">
                     <div class="w3-col s6">
                        GST included in this invoice:
                     </div>
                     <div class="w3-col s6">
                        ${{number_format($job_payment->gst_fee_value,2)}}
                     </div>
                  </div>
               </td>
            </tr>
         </table>
      </div>
   </div>
</div>