@extends('admin.master')
@section('title','Projects')
@section('content')

<div class="breadcrumb-header justify-content-between">

    <div class="my-auto">

        <div class="d-flex">

            <h4 class="content-title mb-0 my-auto">Accepted Account Data</h4>

        </div>

    </div>
</div>

<!--Row-->

<div class="row row-sm">

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

        <div class="card">

            <div class="card-body">

                <div class="panel panel-primary tabs-style-2">
                    <div class=" tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav panel-tabs main-nav-line" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">Main Details</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body main-content-body-right border">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
{{--@dd($account)--}}
                                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!! Form::text('type_replay', 'Type Reply')->value
                                    ($account->typeReplyStatus() )
                                    !!}
                                </div>
                                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!! Form::text('c_first_name', 'Customer First Name')->value($account->c_first_name)!!}
                                </div>
                                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!! Form::text('c_last_name', 'Customer Last Name')->value($account->c_last_name)!!}
                                </div>
                                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!! Form::text('c_email', 'Customer Email')->value($account->c_email)!!}
                                </div>
                                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!! Form::text('c_position', 'Customer Position')->value($account->c_position)!!}
                                </div>
                                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!! Form::text('comment', 'Comment')->value
                                    ($account->comment)!!}
                                </div>

                                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    <div><label>Attachements</label></div>
                                    @if($account->attachement)
                                    @foreach($account->attachement as $attch)
                                        <div>
                                            <a href="{{asset('images/'.$attch)}}" onclick="window.open(this.href,'_blank');
    return false;">Review Document </a>
                                        </div>

                                    @endforeach
                                        @endif
                                </div>

                            </div>

                        </div>

                    </div>
                </div>


            </div>

        </div>

    </div><!-- COL END -->

</div>

@endsection
<script>
    var users = {!! isset($project)?json_encode($project->users->toArray()): json_encode([]) !!};
    users = users.map(a => a.id);

</script>
@push('script')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>

    const excel_file = document.getElementById('excel_file');

    excel_file.addEventListener('change', (event) => {

        // if(!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type))
        // {
        //     document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only .xlsx or .xls file format are allowed</div>';

        //     excel_file.value = '';

        //     return false;
        // }

        var reader = new FileReader();

        reader.readAsArrayBuffer(event.target.files[0]);

        reader.onload = function(event){

            var data = new Uint8Array(reader.result);

            var work_book = XLSX.read(data, {type:'array'});

            var sheet_name = work_book.SheetNames;

            var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});



            if(sheet_data.length > 0)
            {
                var table_output = '<table class="table table-striped table-bordered">';
                    table_output += '<tr>';
                    for(var cell = 0; cell < sheet_data[0].length; cell++)
                    {
                        table_output += '<th class="data_'+ cell +'"> #'+cell+'</th>';
                        $('#account_name,#account_number,#currency,#debit,#credit,#balance').append(`<option value="${cell}">
                                    # ${cell}
                                </option>`);
                    }
                    table_output += '</tr>';
                for(var row = 0; row < sheet_data.length; row++)
                {
                    table_output += '<tr>';
                    for(var cell = 0; cell < sheet_data[row].length; cell++)
                    {
                            table_output += `<input type="hidden" name="data[${cell}][]" value="${sheet_data[row][cell]}" class="col_${cell}">`;

                            table_output += '<td class="data_'+ cell +'">'+sheet_data[row][cell]+'</td>';
                    }

                    table_output += '</tr>';

                }

                table_output += '</table>';

                document.getElementById('excel_data').innerHTML = table_output;


            }

            excel_file.value = '';

        }

    });

    </script>
<script>

   $('#inp-user-ids').val(users);
    $('#inp-user-ids').select2();

</script>

<script>
    $('#inp-customer-id').select2();
</script>
<script>
    $(document).ready(function(){
        var $submitButton =  $('#submit_form');

        $("#main-tab,#document-tab,#import_setting-tab").click(function(){
            $submitButton.show();
        });

        $("#accounts-tab").click(function(){
            $('#submit_form').hide();
        });
});
</script>
@endpush
