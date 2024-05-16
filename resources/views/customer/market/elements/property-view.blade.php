
    <div class="card-body">
        <div id="root">
            <div id="application">
                <div class="custom-page-width">
                    <div id="application">
                        <div id="property-details">
                            <div class="asset-top">
                                <div class="container">
                                    <div class="asset-info">
                                        <div class="asset-title">
                                            <div class="title">{{ $property->title }}</div>
                                            <div class="location">{{ $property->address->city->name }}, {{ $property->address->country->name }}</div>
                                            <div class="descr">
                                                {!! $property->description !!}
                                            </div>
                                        </div>
                                        <div class="asset-info-main">
                                            <div class="left">
                                                <div class="display">
                                                    <div class="prop-status"><div class="live">LIVE</div></div>
                                                    <img src="{{asset('images/'.$property->image)}}" />
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="asset-top-right-wrapper ">
                                                    <div class="asset-top-right asset-property-detail">
                                                        <div class="raised">@money($property->price)</div>
                                                        <div class="percentage">Total raise for the first in a series of acquisitions</div>
                                                        
                                                        <div class="info-field">
                                                            <div class="value">@money($property->min_investment) - @money($property->max_investment)</div>
                                                            <div class="field">Minimum - Maximum Investment</div>
                                                        </div>
                                                        <div class="info-field">
                                                            <div class="value">@money($property->remaining_shares)</div>
                                                            <div class="field">Remaining Shares</div>
                                                        </div>
                                                        <div class="info-field last">
                                                            <div class="value">{{ $property->remaining_days }}</div>
                                                            <div class="field">
                                                                Days Left to Invest
                                                                <img
                                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAALCAYAAABGbhwYAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAEeSURBVHgBjZDPSsNAEManm24PlSbrIXeRSKx/YvsCJT5J1FvxIapvIJTSa3uU2neIB0GlgqA1vdS0glQEcVewh2RL7aSkUUFwYNnl+37sfDMA/6xU/KjWq/aaYVaYygqTiWSBlG6ve9cslw8bC7rVblceB0/Tl9e3Hwc19JBRavXaXqm0e5LNLoHg7+D7fRiNniGXUwE1Xddtw1w9Jxub2w4KcZB8fgssqwjew30koWfOIhGapnYcQdOWo3s8/gSaySyiqRorkLSi8N8T3nSuop/jklIywoW4/Q6FYQjWThEopQkYBC7x+71jbJWAAXCeNEHP87rN+Xpap0d/rmfmReuZg2fuumkMUzBlXPCVDyH4YOhfdq4v9h3noIHMF36xk8S/n0OHAAAAAElFTkSuQmCC"
                                                                    alt=""
                                                                    class="question"
                                                                />
                                                                <div class="tooltip-wrapper"><div class="days-left-tooltip">174 days left to invest in current round. Round ends July 1, 2022</div></div>
                                                            </div>
                                                        </div>
                                                        @if (!isset($hidden_buy))
                                                            <div class="buy">Buy Digital Shares</div>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                                <div class="asset-checkout-wrapper ">
                                                    <div class="asset-checkout" style="display: none;">
                                                        <div class="top">
                                                            {!!Form::open()->multipart()->route('customer.market.store')!!}
                                                            {!!Form::hidden('property_id',$property->id)!!}
                                                            {!!Form::hidden('price',$property->price)!!}
                                                            {!!Form::hidden('commission',
                                                            $property->partner->commission->shares_buying +
                                                            $property->broker->commission->shares_buying +
                                                            $commissionSystem->shares_buying
                                                             )!!}
                                                            <div class="title">How many shares are you buying?</div>
                                                            <div class="tokens">
                                                                <input class="amount " name="amount" id="money-input" value="{{$property->min_investment}}">
                                                                <div class="type">$</div>
                                                            </div>
                                                            <input id="range-shares" type="range" value="{{$property->min_investment}}" min="{{$property->min_investment}}" max="{{$property->available_investment}}">
                                                            <div class="remain">@money($property->max_investment) remaining</div>
                                                    </div>
                                                    <div class="bottom">
                                                            <div class="total">Shares:<span class="amount" id="percentage" >{{number_format($property->min_investment/$property->price * 100, 3,'.','')}}</span> </div>
                                                            <div class="total">Total:<span class="amount" id="money-total" >@money($property->min_investment)</span></div>
                                                            <div class="checkout">
                                                                <div class="back">&lt;  Back</div>
                                                                <button type="submit" class="begin">Begin Checkout</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <section id="property-info" >
                                            <div class="container">
                                            <div class="wrapper">
                                                <div class="mobile">
                                                    <div class="header">
                                                        <h3>Property Info<span class="info"></span></h3>
                                                    </div>
                                                </div>
                                                <div class="block-group">
                                                    <div class="block-50">
                                                        <div class="desktop">
                                                        <div class="header">
                                                            <h3>Property Info<span class="info"></span></h3>
                                                        </div>
                                                        </div>
                                                        <div class="about">
                                                        <h4>About the property</h4>
                                                        <div>
                                                            {!! $property->brief !!}
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="block-50 overflow-hidden">
                                                        <div class="thumb-lg" id="slideshow"><img src="https://sc-file-storage.my.smartcrowd.ae/files/6771167.jpeg" style="width: 100%;" /></div>
                                                        <div class="thumb-row">
                                                            <div class="block-group slideshow_thumbs">
                                                                @foreach ($property->photos as $photo)
                                                                    <div class="block-25">
                                                                        <div class="thumb-sm">
                                                                            <a href="{{asset('images/'.$photo->url)}}">
                                                                                <img src="{{asset('images/'.$photo->url)}}" alt="{{$photo->name}}" style="width: 100%;" />
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            </div>
                                        </section>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="wrapper">
                                    <div class="row pt-3">
                                        <div class="col-md-7">
                                                
                                            <div class="redfrog-content">
                                                <div class="title">Rental Breakdown</div>
                                                <div class="text">
                                                    {!! $property->rental_breakdown !!}
                                                </div>
                                            </div>
                                                
                                        </div>
                                        <div class="col-md-5">
                                            <div class="investment-details">
                                                <div class="title">Shares offered for sale</div>
                                                <table class="table w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Wallet Code</th>
                                                            <th>Shares</th>
                                                            <th>Price</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($property->sells as $sell)
                                                            
                                                                <tr>
                                                                    <td>
                                                                        @if ($sell->customer_id  !=  \Auth::guard('customer')->user()->id)
                                                                        {{base64_encode($sell->customer_id)}}
                                                                        @else
                                                                        you
                                                                        @endif
                                                                        
                                                                    </td>
                                                                    <td>{{$sell->percentage}}</td>
                                                                    <td>@money($sell->amount)</td>
                                                                    <td>
                                                                        @if ($sell->customer_id  !=  \Auth::guard('customer')->user()->id)
                                                                        <button type="button" class="btn btn-success float-left w-100" onclick="pay({{$sell->id}},'sell')">Buy Now</button>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                
                                                
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section id="document" class="section-doc-bg">
                                <div class="container">
                                    <div class="wrapper">
                                        <div class="header">
                                        <h2>Documents</h2>
                                        <h6>Confidential property documents</h6>
                                        </div>
                                        <div class="block-group">
                                            @foreach ($property->documents as $document)
                                                <div>
                                                    <div class="block-25">
                                                        <div class="box-xs">
                                                            <div class="info">
                                                            <div class="text">
                                                                <p>Download</p>
                                                                <p class="brand-highlight"><a href="{{asset('images/'.$document->url)}}" download>{{$document->title}}<span>(Restricted)</span></a></p>
                                                            </div>
                                                            <a href="{{asset('images/'.$document->url)}}" download><img src="https://my.smartcrowd.ae/img/ico-download.png"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                    </div>
                                </div>
                            </section>
                            <section id="location" class="section-brand-bg-light">
                                <div class="container">
                                    <div class="wrapper">
                                        <div class="header">
                                        <h6>"Helping Micro-Investors Build Wealth, Brick By Brick"</h6>
                                        <h2>Location on map</h2>
                                        </div>
                                        <div class="map"><iframe src="https://www.google.com/maps?q={{$property->address->gps}}&hl=es&z=14&amp;output=embed" width="100%" height="350px" allowfullscreen="" loading="lazy" style="border: 0px;"></iframe></div>
                                    </div>
                                </div>
                            </section>


                            <section id="seller-manager" class="">
                                <div class="container">
                                   <div class="wrapper">
                                      <div class="header">
                                         <h2>Broker &amp; property partner</h2>
                                      </div>
                                      <div class="block-group">
                                         <div class="block-50">
                                            <div class="logo"><img src="{{asset('images/'.$property->broker->image)}}"></div>
                                            <div class="info">
                                               <h4>Broker: {{$property->broker->name}}</h4>
                                               <div class="read-more-wrap">
                                                  <p>
                                                  <div>
                                                     <span class="short-text">
                                                        <p class="ql-align-justify">
                                                            {!!$property->broker->brief!!} <br><br>
                                                            Email: {{$property->broker->email}} <br>
                                                            Phone: {{$property->broker->phone}} <br>
                                                            Mobile: {{$property->broker->mobile}} 
                                                        </p>
                                                     </span>
                                                  </div>
                                                  </p>
                                               </div>
                                            </div>
                                         </div>
                                         <div class="block-50">
                                            <div class="logo"><img src="{{asset('images/'.$property->partner->image)}}"></div>
                                            <div class="info">
                                               <h4>Partner: {{$property->partner->name}}</h4>
                                               <div class="read-more-wrap">
                                                  <p>
                                                  <div>
                                                     <span class="short-text">
                                                        <p class="ql-align-justify">
                                                            {!!$property->partner->brief!!} <br><br>
                                                            Email: {{$property->partner->email}} <br>
                                                            Phone: {{$property->partner->phone}} <br>
                                                            Mobile: {{$property->partner->mobile}} 
                                                        </p>
                                                     </span>
                                                  </div>
                                                  </p>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </section>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

@push('script')
<script>
    $(document).ready(function(){
        $('#slideshow').desoSlide({
            thumbs: $('div.slideshow_thumbs .thumb-sm > a'),
            auto: {
                start: true
            },
            first: 1,
            interval: 6000,
            effect: {
                provider: 'animate',
                name: 'slide'
            }
        });

        $('.buy').click(function (){
            $('.asset-property-detail').hide();
            $('.asset-checkout').show();
        });

        $('.back').click(function (){
            $('.asset-checkout').hide();
            $('.asset-property-detail').show();
        });

        
    });

    function pay(id,route) {
            data = {};
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            type:'PUT',
                            url: '../'+route+'/'+id+'/pay?_token=' + '{{ csrf_token() }}',
                            data: data,
                            success:function(data) {
                                Swal.fire(
                                    'Done!',
                                    data.msg,
                                    'success'
                                );
                                location.reload();
                            }
                    });
                    
                }
            })
            
        }    
</script>
@endpush