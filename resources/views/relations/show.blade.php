@extends('backend.app')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
          integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    
@endsection


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Financial Performances</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Financial Performances</li>
        </ol>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-12 mb-4 pl-0">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Show</h6>
                <div>
                    <a class="m-0 float-right btn btn-primary btn-sm" href="{{ url('financial_performance') }}">Back <i
                            class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            
            <div class="table-responsive p-3">
                {{-- <table class="table align-items-center table-flush">
                    <tbody>
                    <tr>
                    <td class="p-10 gray">&nbsp;</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->year }}</strong></td>
                    </tr>
                    <tr>
                    <td class="p-10 gray">Dividend (cents per share)</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->dividend }}</strong></td>
                    </tr>
                    <tr>
                    <td class="p-10 gray">Shares in issue for IFRS</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->shares_issue_ifrs }}</strong></td>
                    </tr>
                    <tr>
                    <td class="p-10 gray">Shares held in treasury - Resilient Properties</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->shares_held_treasury }}</strong></td>
                    </tr>
                    <tr>
                    <td class="p-10 gray">Shares in issue and used for dividend per share calculation</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->dividend_share_calculation }}</strong></td>
                    </tr>
                    <tr>
                    <td class="p-10 gray">&nbsp;</td>
                    <td class="p-10 gray">&nbsp;</td>
                    <td class="p-10 gray">&nbsp;</td>
                    <td class="p-10 gray">&nbsp;</td>
                    <td class="p-10 gray">&nbsp;</td>
                    </tr>
                    <tr>
                    <td class="p-10 gray-dark" colspan="5"><strong>Management account&nbsp;information</strong></td>
                    </tr>
                    <tr>
                    <td class="p-10 gray">Net asset value per share</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->net_per_share }}</strong></td>
                    </tr>
                    <tr>
                    <td class="p-10 gray">Loan-to-value&nbsp;ratio (%)</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->loan_to_ratio }}</strong></td>
                    
                    </tr>
                    <tr>
                    <td class="p-10 gray">Gross property expense ratio&nbsp;(%)</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->gross_property_expense }}</strong></td>
                  
                    </tr>
                    <tr>
                    <td class="p-10 gray">Percentage of direct and indirect property assets offshore (%)</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->percentage_property_offshore }}</strong></td>
                    </tr>
                    <tr>
                    <td class="p-10 gray">&nbsp;</td>
                    <td class="p-10 gray">&nbsp;</td>
                    </tr>
                    <tr>
                    <td class="p-10 gray"><strong>IFRS accounting</strong></td>
                    <td class="p-10 gray">&nbsp;</td>
                    <td class="p-10 gray">&nbsp;</td>
                    <td class="p-10 gray">&nbsp;</td>
                    <td class="p-10 gray">&nbsp;</td>
                    </tr>
                    <tr>
                    <td class="p-10 gray">Net asset value per share</td>
                    <td class="p-10 gray"><strong>{{ $investorRelation->value_per_share }}</strong></td>
                    </tr>
                    <tr>
                    <td class="p-10 gray-dark" colspan="5"><strong>&nbsp;</strong></td>
                    </tr>
                    </tbody>
                </table> --}}

                <div class="my-5">
                    
                    <div class="col-md-10 offset-lg-1 py-2">
                        <h3>Table</h3>
                    </div>
                    <div class="my-5">
                        {!! $tables->tables !!}
                    </div>
                    <hr>
                    <div class="col-md-10 offset-lg-1 py-2">
                        <h3>Description</h3>
                        <p>{!! $tables->description !!}</p>
                    </div>
                        
                    
                </div>
                
            </div>
            
            <div class="card-footer"></div>
        </div>
    </div>

   


@endsection

