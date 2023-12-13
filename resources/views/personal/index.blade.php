@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('message'))
                    <div class="alert alert-success">{{ 'Data successfully added!' }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>
                            Personal Information
                            <a href="{{ url('/personal/create') }}" class="btn btn-primary float-end">Add Personal
                                Information</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foto</th>
                                    <th>Desc</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>address</th>
                                    <th>PN</th>
                                    <th>city</th>
                                    <th>link</th>
                                    <th>Inst</th>
                                    <th>Loc</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Achiev</th>
                                    <th>EduLevel</th>
                                    <th>comp</th>
                                    <th>Jl</th>
                                    <th>Stdt</th>
                                    <th>Eddt</th>
                                    <th>Jdesc</th>
                                    <th>Jtit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personal as $itemP)
                                    <tr>

                                        <td>{{ $itemP->id }}</td>
                                        <td>
                                            <img src="{{ asset('fotopersonal/' . $itemP->foto) }}" alt=""
                                                style="width: 40px;">
                                        </td>
                                        <td>{{ $itemP->deskripsi }}</td>
                                        <td>{{ $itemP->full_name }}</td>
                                        <td>{{ $itemP->email }}</td>
                                        <td>{{ $itemP->address }}</td>
                                        <td>0{{ $itemP->telephone_number }}</td>
                                        <td>{{ $itemP->city }}</td>
                                        <td>{{ $itemP->link_profile }}</td>

                                        @foreach ($itemP->education as $education)
                                            <td>{{ $education->Edu_institution }}</td>
                                            <td>{{ $education->Loc_edu }}</td>
                                            <td>{{ $education->Start_date_edu }}</td>
                                            <td>{{ $education->End_date_edu }}</td>
                                            <td>{{ $education->Achievment }}</td>
                                            <td>{{ $education->Education_level }}</td>
                                        @endforeach

                                        @foreach ($itemP->experience as $experience)
                                            <td>{{ $experience->Company_name }}</td>
                                            <td>{{ $experience->Loc_org }}</td>
                                            <td>{{ $experience->Start_date_org }}</td>
                                            <td>{{ $experience->End_date_org }}</td>
                                            <td>{{ $experience->Job_desc }}</td>
                                            <td>{{ $experience->Job_title }}</td>
                                        @endforeach


                                        <td>
                                            <a href="{{ url('personaledit/' . $itemP->id . '/edit') }}"
                                                class="btn btn-success btn-sm">Edit</a>

                                             <a href="{{ url('ats/' . $itemP->id . '/lihat') }}"
                                                    class="btn btn-primary btn-sm">Cv Formal</a>
        
    

                                            <a href="{{ url('cvats/' . $itemP->id . '/lihat') }}"
                                                class="btn btn-primary btn-sm">CV Informal</a>
    

                                            <form action="{{ url('personaldelete/' . $itemP->id . '/delete') }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger delete"
                                                    data-id="{{ $itemP->id }}">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                                <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
                                    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.delete').click(function(e) {
                    e.preventDefault(); // Prevent the default form submission

                    var form = $(this).closest('form');

                    //var personalid = $(this).attr('data-id');

                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover data ",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            form.submit(); // Submit the form when user confirms deletion
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Data is not deleted.");
                        }
                    });
                });
            });
        </script>
    </div>
@endsection
