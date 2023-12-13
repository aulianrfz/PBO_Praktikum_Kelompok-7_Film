@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Personal Information
                            <a href="{{ url('personal') }}" class="btn btn-primary float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('/personalstore') }} " method="POST" enctype="multipart/form-data">
                            @csrf
                            <h4>Personal Information</h4>

                            <div class="mb3">
                                <label>Masukkan Foto</label>
                                <input type="file" name="foto" class="form control">
                            </div>

                            <div class="mb3">
                                <label>Deskripsi</label>
                                <input type="text" name="deskripsi" class="form control">
                            </div>

                            <div class="mb3">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form control">
                            </div>

                            <div class="mb3">
                                <label>Email</label>
                                <input type="email" name="email" class="form control">
                            </div>

                            <div class="mb3">
                                <label>Phone Number</label>
                                <input type="tel" name="telephone_number" class="form control">
                            </div>

                            <div class="mb3">
                                <label>City</label>
                                <input type="text" name="city" class="form control">
                            </div>

                            <div class="mb3">
                                <label>Address</label>
                                <input type="text" name="address" class="form control">
                            </div>

                            <div class="mb3">
                                <label>Link Profile</label>
                                <input type="text" name="link_profile" class="form control">
                            </div>

                            <h4>Education</h4>
                            <div id="education-container">
                                <div class="education-form mb-3">
                                    <div class="mb3">
                                        <label>Education Institution</label>
                                        <input type="text" name="education[0][Edu_institution]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>Education Location</label>
                                        <input type="text" name="education[0][Loc_edu]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>Start Date</label>
                                        <input type="date" name="education[0][Start_date_edu]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>End Date</label>
                                        <input type="date" name="education[0][End_date_edu]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>Achievement</label>
                                        <input type="text" name="education[0][Achievment]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>Education Level</label>
                                        <input type="text" name="education[0][Education_level]" class="form control">
                                    </div>
                                    <button type="button" class="btn btn-danger remove-education"
                                        style="display:none;">Hapus</button>
                                </div>
                            </div>
                            <button type="button" id="add-education" class="btn btn-success">Tambah Pendidikan</button>

                            <h4>Experience</h4>
                            <div id="experience-container">
                                <div class="experience-form mb-3">
                                    <div class="mb3">
                                        <label>Company Name</label>
                                        <input type="text" name="experience[0][Company_name]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>Company Location</label>
                                        <input type="text" name="experience[0][Loc_org]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>Start Date Company</label>
                                        <input type="date" name="experience[0][Start_date_org]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>End Date Company</label>
                                        <input type="date" name="experience[0][End_date_org]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>Job Title</label>
                                        <input type="text" name="experience[0][Job_title]" class="form control">
                                    </div>

                                    <div class="mb3">
                                        <label>Job Description</label>
                                        <input type="text" name="experience[0][Job_desc]" class="form control">
                                    </div>
                                    <button type="button" class="btn btn-danger remove-experience"
                                        style="display:none;">Hapus</button>
                                </div>
                            </div>
                            <button type="button" id="add-experience" class="btn btn-success">Tambah Experience</button>
                            <div class="mb-3">
                                <button type="submit" class ="btn btn-primary"> Submit </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const educationContainer = document.getElementById('education-container');
            const addEducationButton = document.getElementById('add-education');
            const experienceContainer = document.getElementById('experience-container');
            const addExperienceButton = document.getElementById('add-experience');

            let educationCount = 0; // Mulai dari 0 karena kita akan menyesuaikan indeks saat menambahkan formulir
            let experienceCount = 0; // Mulai dari 0 karena kita akan menyesuaikan indeks saat menambahkan formulir

            addEducationButton.addEventListener('click', function() {
                const newEducationForm = document.querySelector('.education-form').cloneNode(true);

                // Reset nilai untuk setiap elemen input
                newEducationForm.querySelectorAll('input, select').forEach((input) => {
                    input.value = '';
                });

                // Tambahkan indeks dinamis ke dalam nama elemen dan tambahkan data-index
                educationCount++;
                newEducationForm.querySelectorAll('[name]').forEach((input) => {
                    input.name = input.name.replace('education[0]', `education[${educationCount}]`);
                });

                newEducationForm.querySelector('.remove-education').style.display =
                'inline-block'; // Tampilkan tombol hapus
                educationContainer.appendChild(newEducationForm);
            });

            addExperienceButton.addEventListener('click', function() {
                const newExperienceForm = document.querySelector('.experience-form').cloneNode(true);

                // Reset nilai untuk setiap elemen input
                newExperienceForm.querySelectorAll('input, select').forEach((input) => {
                    input.value = '';
                });

                // Tambahkan indeks dinamis ke dalam nama elemen dan tambahkan data-index
                experienceCount++;
                newExperienceForm.querySelectorAll('[name]').forEach((input) => {
                    input.name = input.name.replace('experience[0]',
                        `experience[${experienceCount}]`);
                });

                newExperienceForm.querySelector('.remove-experience').style.display =
                'inline-block'; // Tampilkan tombol hapus
                experienceContainer.appendChild(newExperienceForm);
            });

            educationContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-education')) {
                    const removedIndex = event.target.closest('.education-form').getAttribute('data-index');
                    const educationId = event.target.getAttribute('data-education-id');

                    event.target.closest('.education-form').remove();

                    // Menyesuaikan indeks formulir setelah menghapus formulir
                    document.querySelectorAll('.education-form').forEach((form, index) => {
                        const currentIndex = parseInt(form.getAttribute('data-index'), 10);
                        if (currentIndex > removedIndex) {
                            const newIndex = currentIndex - 1;
                            form.querySelectorAll('[name]').forEach((input) => {
                                input.name = input.name.replace(
                                    `education[${currentIndex}]`,
                                    `education[${newIndex}]`);
                            });
                        }
                    });

                    educationCount--; // Kurangi jumlah formulir pendidikan setelah menghapus formulir
                }
            });

            experienceContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-experience')) {
                    const removedIndex = event.target.closest('.experience-form').getAttribute(
                    'data-index');
                    const experienceId = event.target.getAttribute('data-experience-id');

                    event.target.closest('.experience-form').remove();

                    // Menyesuaikan indeks formulir setelah menghapus formulir
                    document.querySelectorAll('.experience-form').forEach((form, index) => {
                        const currentIndex = parseInt(form.getAttribute('data-index'), 10);
                        if (currentIndex > removedIndex) {
                            const newIndex = currentIndex - 1;
                            form.querySelectorAll('[name]').forEach((input) => {
                                input.name = input.name.replace(
                                    `experience[${currentIndex}]`,
                                    `experience[${newIndex}]`);
                            });
                        }
                    });

                    experienceCount--; // Kurangi jumlah formulir pendidikan setelah menghapus formulir
                }
            });

        });
    </script>
@endsection
