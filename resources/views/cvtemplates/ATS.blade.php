<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>My Awesome CV</title>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        />

        <style type="text/css">
            body {
                font-family: "Arial", sans-serif;
                background-color: #f8f9fa;
                color: #495057;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            h1 {
                padding: 10px;
                color: black;
                text-align: center;
                margin-bottom: 30px;
            }

            h2 {
                background-color: rgb(39, 73, 110);
                padding: 10px;
                color: white;
                margin-top: 30px;
            }


            .menu {
                text-align: center;
                background-color: #343a40;
                font-size: 18px;
                padding-top: 16pt;
                margin-bottom: 30px;
            }

            .button {
                background-color: #ffffff;
                padding: 8px 16px;
                border: 2px solid #9eb1c5;
                text-decoration: none;
                color: #7f9ebe;
                margin: 5px;
                border-radius: 5px;
                transition: background-color 0.3s, color 0.3s, transform 0.3s;
                display: inline-block;
            }

            .button:hover {
                background-color: #9bbadb;
                color: white;
                transform: scale(1.05);
            }

            img {
                max-width: 100%;
                height: auto;
                border-radius: 15px;
                box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            }

            footer {
                text-align: center;
                background-color: #343a40;
                color: white;
                padding: 20px;
            }

            .container {
                margin-top: 50px;
                margin-bottom: 50px;
            }

            .card {
                background-color: #ffffff;
                border: none;
                border-radius: 15px;
                box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-bottom: 30px;
            }

            .card-title {
                font-size: 24px;
                color: rgb(27, 68, 112);
            }

            .card-body ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }

            .card-body li {
                padding-bottom: 10px;
            }

            .contact-table td {
                padding: 10px 20px;
            }

        </style>
    </head>

    <body>
        <div class="menu">
            <a href="#1" class="button">About Me</a>
            <a href="#2" class="button">Education</a>
            <a href="#3" class="button">Skills</a>
            <a href="#4" class="button">Work Experience</a>
            <a href="#5" class="button">Contact</a>
            <br /><br />
        </div>
        <h1 data-aos="fade-up">Hey there! Welcome to My World</h1>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6" data-aos="fade-up">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('fotopersonal/' . $personal->foto) }}" alt=""
                            <table class="contact-table"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 id="1" data-aos="fade-up">About Me</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6" data-aos="fade-up">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">About Me</h5>
                            @if($personal)
                            <ul>
                                <li>
                                    <strong>Short Bio:</strong> {{
                                    $personal->deskripsi }}
                                </li>
                                <li>
                                    <strong>Name:</strong> {{
                                    $personal->full_name }}
                                </li>
                                <li>
                                    <strong>Location:</strong> {{
                                    $personal->address }}
                                </li>
                                <li>
                                    <strong>Location:</strong> {{
                                    $personal->city }}
                                </li>
                                <li>
                                    <strong>Phone:</strong> {{
                                    $personal->telephone_number }}
                                </li>
                                <li>
                                    <strong>Email:</strong> {{ $personal->email
                                    }}
                                </li>
                                <li>
                                    <strong>Portfolio:</strong> {{
                                    $personal->link_profile }}
                                </li>
                            </ul>
                            @else
                            <p>No personal information available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 id="2" data-aos="fade-up">Education</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6" data-aos="fade-up">
                    @foreach($personal->education as $education)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Education</h5>
                            <ul>
                                <li>
                                    <strong>Institution:</strong> {{
                                    $education->Edu_institution }}
                                </li>
                                <li>
                                    <strong>Level:</strong> {{ $education->Education_level
                                    }}
                                </li>
                                <li>
                                    <strong>Location:</strong> {{
                                    $education->Loc_edu }}
                                </li>
                                <li>
                                    <strong>Date:</strong> {{
                                    $education->Start_date_edu }} - {{
                                    $education->End_date_edu }}
                                </li>
                                <li>
                                    <strong>Achievement:</strong> {{
                                    $education->Achievment }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <h2 id="3" data-aos="fade-up">Skills</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6" data-aos="fade-up">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Skills</h5>
                            <table class="table">
                                <tr>
                                    <td width="30%">Digital Marketing</td>
                                    <td>: SEO, Content Writer, Copywriting</td>
                                </tr>
                                <tr>
                                    <td>Web Development</td>
                                    <td>
                                        : HTML, CSS, JavaScript, Bootstrap,
                                        Codeigniter, Laravel, etc.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Others</td>
                                    <td>: C#, Java, .NET, etc.</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 id="4" data-aos="fade-up">Work Experience</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6" data-aos="fade-up">
                    @foreach($personal->experience as $experience)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Work Experience</h5>
                            <ul>
                                <li>
                                    <strong>Job Title:</strong> {{
                                    $experience->Job_title }}
                                </li>
                                <li>
                                    <strong>Job Description:</strong> {{
                                    $experience->Job_desc }}
                                </li>
                                <li>
                                    <strong>Company:</strong> {{
                                    $experience->Company_name }}
                                </li>
                                <li>
                                    <strong>Location:</strong> {{
                                    $experience->Loc_org }}
                                </li>
                                <li>
                                    <strong>Date:</strong> {{
                                    $experience->Start_date_org }} - {{
                                    $experience->End_date_org }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <h2 id="5" data-aos="fade-up">Contact</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6" data-aos="fade-up">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Contact</h5>
                            <table class="table">
                                <tr>
                                    <td width="30%">Linkedin</td>
                                    <td>: {{ $personal->linkedin }}</td>
                                </tr>
                                <tr>
                                    <td>Facebook</td>
                                    <td>: {{ $personal->facebook }}</td>
                                </tr>
                                <tr>
                                    <td>Github</td>
                                    <td>: {{ $personal->github }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <p>&copy; 2023 Cravitae</p>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

        <script>
            AOS.init();
        </script>
    </body>
</html>
