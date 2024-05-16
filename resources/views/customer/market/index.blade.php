@extends('customer.master')
@section('title','Marketplace')
@section('content')
             <div id="application">
                <div id="property-browse">
                   <main id="main">
                      <div>
                         <div class="mt-4">
                            <section id="properties" class="">
                               <div class="container-properties">
                                  <div class="infinite-scroll-component__outerdiv">
                                     <div class="infinite-scroll-component " style="height: auto; overflow: auto;">
                                        <section class="properties-section" data-testid="live_and_coming_soon_properties">
                                           <h2 class="section-header">Live Properties</h2>
                                           <div class="divider"></div>
                                           <div class="row" id="properties-outoload">
                                              
                                           </div>
                                           <div class="ajax-loading"><img src="{{ asset('images/loading.gif') }}" /></div>
                                        </section>
                                     </div>
                                  </div>
                               </div>
                            </section>
                         </div>
                      </div>
                   </main>
                </div>
             </div>



             
@endsection
<script>
    
</script>
@push('script')
<script>
    var page = 1; 
    var number_of_pages = {{ $properties->lastPage() }} ;
    
    load_more(page); 

    $(window).scroll(function() { 
       if($(window).scrollTop() + $(window).height() >= $(document).height()) {
           if(number_of_pages != page){
                page++; 
                load_more(page); 
           } 
             
       }
     });     
     function load_more(page){
         $.ajax({
            url: base_url + "customer/load-properties?page=" + page,
            type: "GET",
            datatype: "html",
            beforeSend: function()
            {
               $('.ajax-loading').show();
            }
         })
         .done(function(data)
         {
             if(data.length == 0){                
                return;
           }
           $('.ajax-loading').hide(); //hide loading animation once data is received
           $("#properties-outoload").append(data); //append data into #properties-outoload element          
            console.log('data.length');
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
           alert('No response from server');
        });
     }

     @if(session()->has('message'))
         Swal.fire(
               'Success!',
               ' {{session()->get('message')}} ',
               'success'
            );
      @elseif(session()->has('error'))
            Swal.fire(
                     'Failed!',
                     ' {{session()->get('error')}} ',
                     'error'
                  );
      @endif
     
 </script>
@endpush
