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
            <button class="btn btn-success" data-toggle="modal" data-target="#CreateCompanyModal">Create Company</button>

            <div class="modal fade" id="CreateCompanyModal" tabindex="-1" role="dialog" aria-labelledby="CreateCompanyModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="CreateCompanyModalLabel">Add Company</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('companies.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Website</label>
                                <input type="text" name="website" class="form-control">
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
                <div class="card-header">{{ __('Company Details') }}</div>

                <div class="card-body">
                    <table class="table">

                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>logo</th>
                            <th>Website</th>
                            <th>Action</th>
                        <tbody>
                            @foreach ($company as $com)

                            <tr>
                                <td>{{$com->id}}</td>
                                <td>{{$com->name}}</td>
                                <td>{{$com->email}}</td>
                                <td><img src="<?php echo $base_url.'/'.$com->logo;?> " width="100" /></td>
                                <td>{{$com->website}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#EditCompanyModal{{$com->id}}" class="btn btn-secondary" href="">Edit</a>
                                    <a class="btn btn-danger" onclick="event.preventDefault();
                                    document.getElementById('delete-company-form{{$com->id}}').submit();"
                                    href="{{route('companies.destroy',$com->id)}}">Delete</a>
                                    <form id="delete-company-form{{$com->id}}" action="{{ route('companies.destroy', $com->id) }}" method="POST" class="d-none">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE" />

                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="EditCompanyModal{{$com->id}}" tabindex="-1" role="dialog" aria-labelledby="EditCompanyModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="EditCompanyModalLabel">Edit Company</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('companies.update',$com->id)}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT" />


                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="{{$com->name}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" name="email" value="{{$com->email}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Logo</label>
                                                <input type="file" name="logo" value="{{$com->logo}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Website</label>
                                                <input type="text" name="website" value="{{$com->website}}" class="form-control">
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

                    {{$company->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
