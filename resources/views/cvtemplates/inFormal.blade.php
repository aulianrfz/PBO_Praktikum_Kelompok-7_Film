<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
    <link
        rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <title>Web | Portofolio</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background-color: #eff1f2;
        font-family: sans-serif;
    }

    .content {
        grid-area: content;
    }

    .sidebar {
        grid-area: sidebar;
        background: linear-gradient(
                to right,
                rgb(162, 170, 236),
                rgb(59, 83, 151),
                rgb(75, 48, 150)
        );
        justify-content: center;
    }

    .footer {
        grid-area: footer;
        background: white;
    }

    .container {
        font-size: 1.5em;
        width: 100%;
        height: 100;
        height: 100vh;
        display: grid;
        grid-template-areas: 'sidebar' 'content' 'footer';
        grid-template-columns: 1fr;
        grid-template-rows: 130px 800px 250px;
    }

    .content,
    .sidebar,
    .footer {
        padding: 1em;
    }

    nav ul {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: space-between;
        text-align: center;
    }

    nav li {
        list-style: none;
        padding: 1em 0;
    }

    nav li a {
        color: white;
        font-weight: 700;
        opacity: 0.6;
        text-decoration: none;
        transition: 0.3s;
    }

    nav li a:hover {
        opacity: 1;
    }

    .hero {
        max-width: 90 px;
        margin: 0 auto;
        text-align: center;
    }

    .hero img {
        width: 400px;
    }

    .hero h1 {
        font-size: 2em;
        font-weight: 300;
        color: #373046;
    }

    .hero p {
        font-weight: 300;
        line-height: 1.3em;
        color: #98abad;
    }

    .action-btn {
        display: inline-block;
        text-decoration: none;
        color: white;
        font-weight: 700;
        background: #567bfb;
        padding: 0.5em 2em;
        border-radius: 60px;
        margin: 1em 0;
        transition: 0.3s;
    }

    footer ul {
        max-width: 640px;
        margin: 2em auto;
        padding: 0;
        text-align: center;
        display: flex;
        flex-direction: row;
    }

    footer ul li {
        list-style: none;
        align-self: flex-end;
    }

    footer ul li a {
        text-decoration: none;
        color: #c1c6ce;
    }

    footer ul li img {
        width: 30%;
    }

    footer p {
        font-size: 0.8em;
    }

    @media (min-width: 1040px) {
        .container {
            grid-template-areas: 'sidebar content' 'sidebar footer';
            grid-template-rows: 1fr auto;
            grid-template-columns: 300px 1f;
        }

        nav ul {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
        }

        .sidebar {
            background: linear-gradient(
                    rgba(200, 107, 142, 1),
                    rgba(218, 105, 250, 1),
                    rgba(110, 125, 253, 1)
            );
            padding-bottom: 10em;
        }

        .hero {
            text-align: left;
            margin: 7em 0;
        }

        .hero img {
            width: 400px;
            float: right;
        }

        .hero h1 {
            font-size: 3em;
        }

        .hero p {
            width: 60%;
        }

        footer ul {
            max-width: 900px;
            margin: 0 auto;
            padding: 1em 0;
        }

        footer ul li a img {
            width: 20%;
        }
        
    }
</style>
<body>
    <div class="container">
        <div class="sidebar">
            <nav>
                <ul>
                    <li><a href="#1" >Personal Profile</a></li>
                    <li><a href="#1" >Education</a></li>
                    <li><a href="#1" >Skill</a></li>
                    <li><a href="#1" >Experience</a></li>
                    <li><a href="#1" >Contact</a></li>
                </ul>
            </nav>
        </div>
        <main class="content">
            <section class="hero">
                <img src="{{ asset('fotopersonal/' . $personal->foto) }}" alt=""
                <div class="hero-content">
                    <h1>
                        {{$personal->full_name }}
                    </h1>
                    <br />
                    <br /><br />
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, aperiam dolore
                        assumenda velit repellendus recusandae magni consectetur mollitia facere incidunt
                        inventore perspiciatis debitis doloribus ullam minima culpa voluptatem. Repellendus,
                        option.
                    </p>
                    <a href="" class="action-btn">Profile Saya</a>
                </div>
            </section>
        </main>
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
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
           AOS.init();
        });
    </script>
</body>
