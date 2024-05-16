@extends('admin.master')
@section('title','Page')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Manage Pages</h4>

                </div>
                
            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        <!-- Main content -->
                        <section class="content" style="display: flex;">
                            <div class="box add_area" style="width: 70% !important; text-align:left;display:inline-block;">
                                <div class="box-body">
                                    @if(isset($page))
                                        <div class="d-flex my-xl-auto right-content" style="direction: rtl">
                                            <div class="pr-1 mb-3 mb-xl-0">
                            
                                                <a href="{{ url('admin/page/create') }}" title="Add Page">
                            
                                                    <button type="button" class="btn btn-success"><i class="mdi mdi-plus"></i></button>
                            
                                                </a>
                            
                                            </div>
                                        </div>

                                        {!!Form::open()->fill($page)->put()->multipart()->route('admin.page.update',[$page->id])!!}
                                    @else
                                        {!!Form::open()->multipart()->route('admin.page.store')!!}
                                    @endif
                                            @if(isset($page))
                                                {!!Form::select('parent_id', 'Choose Parent')->options(\App\Models\Page::where('id', '!=', $page->id)->get()->prepend('None',null))!!}
                                            @else
                                                {!!Form::select('parent_id', 'Choose Parent')->options(\App\Models\Page::all()->prepend('None',null))!!}
                                            @endif
                                            {!!Form::text('url', 'URL')->required()!!}

                                            {!!Form::text('name', 'Name')->required()!!}

                                            {!!Form::text('title', 'Title')->required()!!}

                                            {!!Form::textarea('content', 'Content')->required()!!}

                                            {!!Form::textarea('brief', 'Brief')->required()!!}

                                            {!!Form::text('president', 'President')->required()->type('number')!!}

                                            {!!Form::select('open_in_new_tab', 'Show in Top Menu',[0 => 'No' , 1 => 'Yes'])->required()!!}

                                            {!!Form::select('display_top_menu', 'Show in Menu',[0 => 'No' , 1 => 'Yes'])->required()!!}

                                            {!!Form::select('display_sidebar', 'Show in Sidebar',[0 => 'No' , 1 => 'Yes'])->required()!!}

                                            {!!Form::select('status', 'Choose Status',[1 => 'Active' , 0 => 'Not Active'])->required()!!}

                                            {!!Form::file('image', 'Photo')!!}
                                            
                                            @if(isset($page))
                                                <img src="{{asset('images/'.$page->image)}}" class="img-thumbnail w-50"/>
                                            @endif

                                            {!!Form::file('icon', 'Icon')!!}

                                            @if(isset($page))
                                                <img src="{{asset('images/'.$page->icon)}}" class="img-thumbnail w-50"/>
                                            @endif
                                        

                                        

                                        
                                        @if(!isset($show))
                                        <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                            {!!Form::submit("Save")!!}
                                        </div>
                                        @endif
                                        
                                        
                                        {!!Form::close()!!}
                                </div>
                            </div>
                            <div class="box list_area" style="width: 29% !important;text-align:left;display:inline-block;margin-left: auto;">
                                <div class="box-header with-border">
                                    <h3 class="box-title">All page </h3>
                                </div>

                                <div class="box-body">
                                    <div aria-multiselectable="true" class="accordion accordion-indigo" id="accordion" role="tablist">
                                        @foreach ($pages as $page)
                                            <div class="card mb-0">
                                                <div class="card-header" id="headingOne{{$page->id}}" role="tab">
                                                    <a aria-controls="collapseOne{{$page->id}}" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseOne{{$page->id}}">
                                                        
                                                                {{$page->name}}   
                                                                       
                                                            
                                                    </a>
                                                </div>
                                                
                                                <div aria-labelledby="headingOne{{$page->id}}" class="collapse" data-parent="#accordion" id="collapseOne{{$page->id}}" role="tabpanel">
                                                    
                                                    <div class="card-body">
                                                        <a href="{{url('admin/page/'.$page->id.'/edit')}}" class=""><i class="fas fa-edit blackiconcolor"></i></a>
                                                        <a href="#" onclick="delElement('{{$page->id}}')" class=""><i class="fas fa-trash-alt blackiconcolor"></i></a>  

                                                        
                                                        <div aria-multiselectable="true" class="accordion accordion-indigo" id="accordion{{$page->id}}" role="tablist">
                                                            @foreach ($page->childs as $pageChild)
                                                                <div class="card mb-0">
                                                                    <div class="card-header" id="headingOne{{$pageChild->id}}" role="tab">
                                                                        <a aria-controls="collapseOne{{$pageChild->id}}" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseOne{{$pageChild->id}}">{{$pageChild->name}}</a>
                                                                    </div>
                                                                    <div aria-labelledby="headingOne{{$pageChild->id}}" class="collapse" data-parent="#accordion{{$page->id}}" id="collapseOne{{$pageChild->id}}" role="tabpanel">
                                                                        <div class="card-body">
                                                                            <a href="{{url('admin/page/'.$pageChild->id.'/edit')}}" class=""><i class="fas fa-edit blackiconcolor"></i></a>
                                                                            <a href="#" onclick="delElement('{{$pageChild->id}}')" class=""><i class="fas fa-trash-alt blackiconcolor"></i></a>  

                                                                            
                                                                            <div aria-multiselectable="true" class="accordion accordion-indigo" id="accordion{{$pageChild->id}}" role="tablist">
                                                                                @foreach ($pageChild->childs as $pageSubChild)
                                                                                    <div class="card mb-0">
                                                                                        <div class="card-header" id="headingOne{{$pageSubChild->id}}" role="tab">
                                                                                            <a aria-controls="collapseOne{{$pageSubChild->id}}" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseOne{{$pageSubChild->id}}">{{$pageSubChild->name}}</a>
                                                                                        </div>
                                                                                        <div aria-labelledby="headingOne{{$pageSubChild->id}}" class="collapse" data-parent="#accordion{{$pageChild->id}}" id="collapseOne{{$pageSubChild->id}}" role="tabpanel">
                                                                                            <div class="card-body">
                                        
                                                                                                <a href="{{url('admin/page/'.$pageSubChild->id.'/edit')}}" class=""><i class="fas fa-edit blackiconcolor"></i></a>
                                                                                                <a href="#" onclick="delElement('{{$pageSubChild->id}}')" class=""><i class="fas fa-trash-alt blackiconcolor"></i></a>  
                                        
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            </div>                        
                        </section>
                        
                    </div>

                </div>

            </div><!-- COL END -->

        </div>
@endsection

@push('script')

@endpush
