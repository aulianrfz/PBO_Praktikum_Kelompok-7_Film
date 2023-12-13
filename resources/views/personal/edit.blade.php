@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Personal Information
                            <a href="{{ url('/personal') }}" class="btn btn-primary float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('personalupdate/' . $personal->id) }} " method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h4>Personal Information</h4>
                            <div class="mb3">
                                <label>Deskripsi</label>
                                <input type="text" name="deskripsi"
                                    value = "{{ $personal->deskripsi }}"class="form control">
                            </div>

                            <div class="mb3">
                                <label>Full Name</label>
                                <input type="text" name="full_name"
                                    value = "{{ $personal->full_name }}"class="form control">
                            </div>

                            <div class="mb3">
                                <label>Email</label>
                                <input type="email" name="email" value = "{{ $personal->email }}"class="form control">
                            </div>

                            <div class="mb3">
                                <label>Phone Number</label>
                                <input type="tel" name="telephone_number" value = "{{ $personal->telephone_number }}"
                                    class="form control">
                            </div>

                            <div class="mb3">
                                <label>City</label>
                                <input type="text" name="city" value = "{{ $personal->city }}" class="form control">
                            </div>

                            <div class="mb3">
                                <label>Address</label>
                                <input type="text" name="address" value = "{{ $personal->address }}"
                                    class="form control">
                            </div>

                            <div class="mb3">
                                <label>Link Profile</label>
                                <input type="text" name="link_profile" value = "{{ $personal->link_profile }}"
                                    class="form control">
                            </div>

                            <h4>Education</h4>
                            @foreach ($personal->education as $key => $education)
                                <div class="mb3">
                                    <label>Education Institution</label>
                                    <input type="text" name="education[{{ $key }}][Edu_institution]"
                                        value = "{{ $education->Edu_institution }} "class="form control">
                                </div>

                                <div class="mb3">
                                    <label>Education Location</label>
                                    <input type="text" name="education[{{ $key }}][Loc_edu]"
                                        value = "{{ $education->Loc_edu }} "class="form control">
                                </div>

                                <div class="mb3">
                                    <label>Start Date</label>
                                    <input type="date" name="education[{{ $key }}][Start_date_edu]"
                                        value = "{{ $education->Start_date_edu }}" class="form control">
                                </div>

                                <div class="mb3">
                                    <label>End Date</label>
                                    <input type="date" name="education[{{ $key }}][End_date_edu]"
                                        value = "{{ $education->End_date_edu }}" class="form control">
                                </div>

                                <div class="mb3">
                                    <label>Achievment</label>
                                    <input type="text" name="education[{{ $key }}][Achievment]"
                                        value = "{{ $education->Achievment }}" class="form control">
                                </div>

                                <div class="mb3">
                                    <label>Education Level</label>
                                    <input type="text" name="education[{{ $key }}][Education_level]"
                                        value = "{{ $education->Education_level }}" class="form control">
                                </div>
                            @endforeach

                            <h4>Experience</h4>

                            @foreach ($personal->experience as $key => $experience)
                                <div class="mb3">
                                    <label>Company Name</label>
                                    <input type="text" name="experience[{{ $key }}][Company_name]"
                                        value = "{{ $experience->Company_name }} "class="form control">
                                </div>

                                <div class="mb3">
                                    <label>Company Location</label>
                                    <input type="text" name="experience[{{ $key }}][Loc_org]"
                                        value = "{{ $experience->Loc_org }} "class="form control">
                                </div>

                                <div class="mb3">
                                    <label>Start Date Company</label>
                                    <input type="date" name="experience[{{ $key }}][Start_date_org]"
                                        value = "{{ $experience->Start_date_org }}" class="form control">
                                </div>

                                <div class="mb3">
                                    <label>End Date Company</label>
                                    <input type="date" name="experience[{{ $key }}][End_date_org]"
                                        value = "{{ $experience->End_date_org }}" class="form control">
                                </div>

                                <div class="mb3">
                                    <label>Job Title</label>
                                    <input type="text" name="experience[{{ $key }}][Job_title]"
                                        value = "{{ $experience->Job_title }}" class="form control">
                                </div>

                                <div class="mb3">
                                    <label>Job Description</label>
                                    <input type="text" name="experience[{{ $key }}][Job_desc]"
                                        value = "{{ $experience->Education_level }}" class="form control">
                                </div>
                            @endforeach

                            <div class="mb-3">
                                <button type ="submit" class = "btn btn-primary">Update</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
