@extends('layouts.app')

@section('content')
<style>
    .card{
        width: 115%;
        margin-left:
    }
    .col-md-8{
        right: 6%;
    }
</style>
<?php
if(session('status')){
    echo "<script>alert('".session('status')."');</script>";
}

?>
<?php $base_url = 'http://'.$_SERVER['HTTP_HOST'].'/storage'; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button class="btn btn-success" data-toggle="modal" data-target="#CreateEmployeeModal">Create Employees</button>
            <div class="modal fade" id="CreateEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="CreateEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="CreateEmployeeModalLabel">Add Employee</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('employees.store')}}" method="POST" >
                            @csrf

                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Company</label>
                                <select name="company" class="form-control">
                                    <option value="">Select an option</option>
                                    @foreach ($company as $com)
                                        <option value="{{$com->id}}">{{$com->name}}  </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="number" name="phone" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Add"/>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>

                  </div>
                </div>
              </div>


            <br><br>
            <div class="card">
                <div class="card-header">{{ __('Employee Details') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>


                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>

                            <th>Company</th>
                            <th>Email</th>
                            <th>Phone</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($employee as $em)

                            <tr>
                                <td>{{$em->id}}</td>
                                <td>{{$em->first_name}}</td>
                                <td>{{$em->last_name}}</td>
                                <td>{{$em->companies->name}}</td>
                                <td>{{$em->email}}</td>
                                <td>{{$em->phone}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#EditEmployeeModal{{$em->id}}" class="btn btn-secondary" href="">Edit</a>
                                    <a href="{{route('employees.destroy', $em->id)}}" onclick="event.preventDefault();
                                        document.getElementById('delete-employees-form{{$em->id}}').submit();" class="btn btn-danger" href="">Delete</a>
                                    <form id="delete-employees-form{{$em->id}}" action="{{ route('employees.destroy', $em->id) }}" method="POST" class="d-none">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE" />

                                    </form>
                                </td>

                            </tr>
                            <div class="modal fade" id="EditEmployeeModal{{$em->id}}" tabindex="-1" role="dialog" aria-labelledby="EditEmployeeModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="EditEmployeeModalLabel">Edit Employee</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('employees.update', $em->id)}}" method="POST" >
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" name="first_name" value="{{$em->first_name}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <input type="text" name="last_name"  value="{{$em->last_name}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Company</label>
                                                <select name="company" class="form-control">
                                                    <option value="{{$em->company}}">{{$em->companies->name}}</option>
                                                    @foreach ($company as $com)
                                                        @if ($com->name != $em->companies->name)

                                                        <option value="{{$com->id}}">{{$com->name}}  </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" name="email"  value="{{$em->email}}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="number" name="phone"  value="{{$em->phone}}" class="form-control">
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Update"/>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>

                                  </div>
                                </div>
                              </div>

                            @endforeach
                        </tbody>
                    </table>

                    {{$employee->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
