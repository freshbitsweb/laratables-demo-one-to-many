@extends('layouts.master')

@section('content')

    <div class="container">
        <table id="one-to-many" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Start Date</th>
                    <th>Salary</th>
                    <th>User Comments</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

@endsection
