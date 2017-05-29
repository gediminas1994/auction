@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Price</th>
                    <th>Bid Increment</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>0.01 - 0.99€</td>
                    <td>0.05€</td>
                </tr>
                <tr>
                    <td>1.00 - 4.99€</td>
                    <td>0.25€</td>
                </tr>
                <tr>
                    <td>5.00 - 24.99€</td>
                    <td>0.50€</td>
                </tr>
                <tr>
                    <td>25.00 - 99.99€</td>
                    <td>1.00€</td>
                </tr>
                <tr>
                    <td>100.00 - 249.99€</td>
                    <td>2.50€</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            Made By Gediminas Zinkevičius IT2 2017
        </div>
    </div>

@endsection
