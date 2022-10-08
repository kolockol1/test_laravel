@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editing employee</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br/>
            @endif
            <form method="post" action="{{ route('employees.update', $employee->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">

                    <div class="form-group">
                        <label for="name">Name:*</label>
                        <input type="text" class="form-control" name="name" value="{{ $employee->name }}"/>
                    </div>
                    <div class="form-group">
                        <label for="position">Position:*</label>
                        <input type="text" class="form-control" name="position" value="{{ $employee->position }}"/>
                    </div>
                    <div class="form-group">
                        <label for="superior_id">Superior ID:*</label>
                        <input type="text" class="form-control" name="superior_id" value="{{ $employee->superiorId }}"/>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date:*</label>
                        <input type="text" class="form-control" name="start_date" value="{{ $employee->startDate }}"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
