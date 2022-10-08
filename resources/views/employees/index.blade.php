@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Employees</h1>
            <div>
                <a href="{{ route('employees.create')}}" class="btn btn-primary mb-3">Add Employees</a>
            </div>
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Position</td>
                    <td>Superior ID</td>
                    <td>Start date</td>
                    <td>End date</td>
                    <td colspan=2>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->name}} </td>
                        <td>{{$employee->position}}</td>
                        <td>{{$employee->superiorId}}</td>
                        <td>{{$employee->startDate}}</td>
                        <td>{{$employee->endDate}}</td>
                        <td>
                            <a href="{{ route('employees.edit',$employee->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
            </div>
@endsection
