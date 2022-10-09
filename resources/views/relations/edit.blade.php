@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

    <style>
        .alert-success {

            background-color: #66bb6a !important;
        
        }
    </style>
@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Financial Performance</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('financial_performance') }}">Financial Performance</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
    <!-- creating  -->
    {{-- <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Create</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('financial_performance') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="propertiesTable" class="col-md-6 offset-lg-3 py-5 ">
                @if($message =  session('message'))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif
                {{-- {{ route('financial_performance.update', $investorRelation->id) 
                <form id="investorRelations" action="" method="post" >
                    @csrf
                    @method('PATCH')

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="date_of_creation"> Date </label>
                            <input  name="date_of_creation" type="date"  class="form-control @error('date_of_creation') is-invalid @enderror"
                                    id="date_of_creation"   value="{{ $investorRelation->year}}" />
                            @error('date_of_creation')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dividend">Dividend (cents per share)</label>
                            <input name="dividend" type="text"  class="form-control @error('dividend') is-invalid @enderror"
                                    id="dividend"  value="{{ $investorRelation->dividend }}" />
                            @error('dividend')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="shares_issue_ifrs">Shares in issue for IFRS </label>
                            <input name="shares_issue_ifrs" type="text"  class="form-control @error('shares_issue_ifrs') is-invalid @enderror"
                                    id="shares_issue_ifrs"  value="{{ $investorRelation->shares_issue_ifrs }}" />
                            @error('shares_issue_ifrs')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="shares_held_treasury">Shares held in treasury - Resilient Properties</label>
                            <input name="shares_held_treasury" type="text"  class="form-control @error('shares_held_treasury') is-invalid @enderror"
                                    id="shares_held_treasury"  value="{{ $investorRelation->shares_held_treasury }}" />
                            @error('shares_held_treasury')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dividend_share_calculation">Shares in issue and used for dividend per share calculation</label>
                            <input name="dividend_share_calculation" type="text"  class="form-control @error('dividend_share_calculation') is-invalid @enderror"
                                    id="dividend_share_calculation"  value="{{ $investorRelation->dividend_share_calculation }}" />
                            @error('dividend_share_calculation')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="net_per_share">Net asset value per share</label>
                            <input name="net_per_share" type="text"  class="form-control @error('net_per_share') is-invalid @enderror"
                                    id="net_per_share"  value="{{ $investorRelation->net_per_share }}" />
                            @error('net_per_share')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="loan_to_ratio">Loan-to-value ratio (%)</label>
                            <input name="loan_to_ratio" type="text"  class="form-control @error('loan_to_ratio') is-invalid @enderror"
                                    id="loan_to_ratio"  value="{{ $investorRelation->loan_to_ratio }}" />
                            @error('loan_to_ratio')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="gross_property_expense">Gross property expense ratio (%)</label>
                            <input name="gross_property_expense" type="text"  class="form-control @error('gross_property_expense') is-invalid @enderror"
                                    id="gross_property_expense"  value="{{ $investorRelation->gross_property_expense }}" />
                            @error('gross_property_expense')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="percentage_property_offshore">Percentage of direct and indirect property assets offshore (%)</label>
                            <input name="percentage_property_offshore" type="text"  class="form-control @error('percentage_property_offshore') is-invalid @enderror"
                                    id="percentage_property_offshore"  value="{{ $investorRelation->percentage_property_offshore }}" />
                            @error('percentage_property_offshore')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="value_per_share">Net asset value per share</label>
                            <input name="value_per_share" type="text"  class="form-control @error('value_per_share') is-invalid @enderror"
                                    id="value_per_share"  value="{{ $investorRelation->value_per_share }}" />
                            @error('value_per_share')
                            <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="col-lg-12">

                        <button type="submit" id="form-submit" class="btn btn-primary btn-block">Update</button>

                    </div>

                </form>

                
            </div>
            <div class="card-footer"></div>
        </div>
    </div> --}}

    <div class="col-xl-12 col-lg-12 mb-4 pl-0 mt-5">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
                <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('financial_performance') }}">Back <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div id="editTables" class="col-md-10 offset-lg-1 py-5 ">
                @if($message =  session('message'))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif
                
                <form action="{{ route('financial_performance.update', $tables->id ) }}" method="post" class="mt-5">
                    @csrf
                    @method('PATCH')

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name"> Name </label>
                            <input  name="name" type="text"  class="form-control @error('name') is-invalid @enderror"
                                    id="name"   value="{{ $tables->name }}" />
                            @error('name')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="description form-control" >{{ $tables->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tables">Table</label>
                            <textarea name="tables" id="tables" class="try form-control" cols="30" rows="10">{{ $tables->tables }}</textarea>
                            @error('tables')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">

                        <button type="submit" id="form-submit" class="btn btn-primary btn-block">Update</button>

                    </div>
                </form>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>




@endsection

@section('footer')


<script type="text/javascript">
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    CKEDITOR.replace( 'tables', {} );
    CKEDITOR.replace( 'description', {} );
</script>
    
@endsection

