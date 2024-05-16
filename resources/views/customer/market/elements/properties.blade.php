
@foreach ($properties as $property)
<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 card-col mb-3">
   <a href="{{ url('customer/market/'.$property->id) }}">
      <div class="card-v3">
         <div class="card-container" data-testid="property_card" style="cursor: pointer;">
            <div class="card-thumb">
               <img src="{{asset('images/'.$property->image)}}">
               <div class="thumb-overlay">
                  <div class="thumb-content">
                     <div class="property-status">
                        <div class="live">{{ $property->propertyType->name }}</div>
                     </div>
                     <div class="days-remaining">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="background: transparent; height: 16px; margin-right: 5px;">
                           <defs>
                              <style>.cls-1{fill:white;}</style>
                           </defs>
                           <title></title>
                           <g>
                              <path class="cls-1" d="M16,5A11,11,0,1,0,27,16,11,11,0,0,0,16,5Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,16,25Z"></path>
                              <polygon class="cls-1" points="15 15 9.33 15 9.33 17 17 17 17 8.83 15 8.83 15 15"></polygon>
                           </g>
                        </svg>
                        {{ $property->remaining_days }} days remaining
                     </div>
                     <div class="property-spec">
                        <div class="block-group">
                           <div class="block-65">
                              <div class="title-address">
                                 <h4 data-testid="property_name">{{ $property->title }}</h4>
                                 <p>{{ $property->address->city->name }}, {{ $property->address->country->name }}</p>
                              </div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-info">
               <div class="calculation">
                  <div class="group">
                     <div class="group-item">
                           <p>Size</p>
                           <p class="brand-highlight">@size($property->size)</p>
                     </div>
                     <div class="group-item">
                        <p>Min-Max Investment</p>
                        <p class="brand-highlight">@money($property->min_investment) - @money($property->max_investment)</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="funding-action">
               <div class="funding">
                  <p>Funding target</p>
                  <h4>@money($property->price)</h4>
               </div>
               <div class="action">
                  <a href="{{ url('customer/market/'.$property->id) }}"><button data-testid="invest_now_btn" class="btn-leaf invest-now-btn">Invest now</button></a>
               </div>
            </div>
         </div>
      </div>
   </a>
</div>
@endforeach