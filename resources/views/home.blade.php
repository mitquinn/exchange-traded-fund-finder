@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('Dashboard')}}</div>

                    <div class="card-body">
                        <h1>Backend Engineer Challenge</h1>
                        <p>
                            1. Parse ​ Top 10​ Holdings, Country Weights and Sector Weights, ETF name and fund
                            description information for all requested ​ SPDR ETFs (​ www.spdrs.com​ ) and store them in
                            a database. The information should be updated daily.
                            <br>
                            2. Create API using an authentication method of your choice. However, ​ non expirable
                            keys are not acceptable​ . Endpoints should include:
                            <br>
                                a. Login authentication for API access
                            <br>
                                b. List of available ETF symbol
                            <br>
                                c. Get data for ETF by ticker
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection
