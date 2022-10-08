@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add Employee</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <form method="post" action="{{ route('employees.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:*</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>
                    <div class="form-group">
                        <label for="position">Position:*</label>
                        <input type="text" class="form-control" name="position"/>
                    </div>
                    <div class="form-group">
                        <label for="superior_id">Superior ID:*</label>
                        <input type="text" class="form-control" name="superior_id"/>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date:*</label>
                        <input type="date" name="start_date" id="date" class="form-control" style="width: 100%; display: inline;" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Employee</button>
                </form>
            </div>
        </div>
    </div>
@endsection
