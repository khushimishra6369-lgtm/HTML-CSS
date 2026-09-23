<?php

/* =========================
   DATABASE CONNECTION
========================= */

$conn = mysqli_connect("localhost", "root", "", "test");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


/* =========================
   GET COURSES
========================= */

$course_result = mysqli_query(
    $conn,
    "SELECT id, course_name, instructor, status
     FROM courses
     WHERE status = 'Active'
     ORDER BY id DESC
     LIMIT 6"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>E-Learn - Online Learning Platform</title>


    <style>

        /* =========================
           GENERAL
        ========================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #f8fafc;
            color: #1f2937;
        }

        a {
            text-decoration: none;
        }


        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            background: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            color: #2563eb;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-links a {
            color: #374151;
            font-size: 15px;
        }

        .nav-links a:hover {
            color: #2563eb;
        }

        .login-btn {
            background: #2563eb;
            color: white !important;
            padding: 10px 18px;
            border-radius: 6px;
        }

        .register-btn {
            border: 1px solid #2563eb;
            color: #2563eb !important;
            padding: 9px 17px;
            border-radius: 6px;
        }


        /* =========================
           HERO
        ========================= */

        .hero {
            background: #eff6ff;
            padding: 80px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
        }

        .hero-content {
            width: 55%;
        }

        .hero-content h1 {
            font-size: 48px;
            line-height: 1.2;
            margin-bottom: 20px;
            color: #111827;
        }

        .hero-content h1 span {
            color: #2563eb;
        }

        .hero-content p {
            font-size: 18px;
            color: #6b7280;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
        }

        .primary-btn {
            background: #2563eb;
            color: white;
            padding: 13px 24px;
            border-radius: 6px;
            display: inline-block;
        }

        .secondary-btn {
            background: white;
            color: #2563eb;
            padding: 13px 24px;
            border-radius: 6px;
            border: 1px solid #2563eb;
            display: inline-block;
        }

        .hero-box {
            width: 40%;
            background: white;
            padding: 45px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .hero-box .icon {
            font-size: 70px;
            margin-bottom: 15px;
        }

        .hero-box h2 {
            margin-bottom: 10px;
        }

        .hero-box p {
            color: #6b7280;
        }


        /* =========================
           STATS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 40px 7%;
            background: white;
        }

        .stat-box {
            text-align: center;
            padding: 15px;
        }

        .stat-box h2 {
            color: #2563eb;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .stat-box p {
            color: #6b7280;
        }


        /* =========================
           COMMON SECTION
        ========================= */

        .section {
            padding: 70px 7%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #6b7280;
        }


        /* =========================
           CATEGORIES
        ========================= */

        .categories {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .category-card {
            background: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .category-card .icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .category-card h3 {
            margin-bottom: 8px;
        }

        .category-card p {
            color: #6b7280;
            font-size: 14px;
        }


        /* =========================
           COURSES
        ========================= */

        .courses {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .course-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .course-top {
            height: 130px;
            background: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 55px;
        }

        .course-content {
            padding: 20px;
        }

        .course-content h3 {
            margin-bottom: 12px;
        }

        .course-content p {
            color: #6b7280;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .course-status {
            display: inline-block;
            margin-top: 10px;
            background: #dcfce7;
            color: #166534;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .view-course {
            display: inline-block;
            margin-top: 15px;
            color: #2563eb;
            font-weight: bold;
        }

        .no-course {
            grid-column: 1 / -1;
            text-align: center;
            background: white;
            padding: 30px;
            border-radius: 8px;
            color: #6b7280;
        }


        /* =========================
           WHY CHOOSE US
        ========================= */

        .why-section {
            background: white;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .why-card {
            padding: 25px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .why-card .icon {
            font-size: 35px;
            margin-bottom: 15px;
        }

        .why-card h3 {
            margin-bottom: 10px;
        }

        .why-card p {
            color: #6b7280;
            line-height: 1.6;
        }


        /* =========================
           HOW IT WORKS
        ========================= */

        .steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .step {
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        .step-number {
            width: 50px;
            height: 50px;
            line-height: 50px;
            margin: 0 auto 15px;
            background: #2563eb;
            color: white;
            border-radius: 50%;
            font-size: 20px;
            font-weight: bold;
        }

        .step h3 {
            margin-bottom: 10px;
        }

        .step p {
            color: #6b7280;
            line-height: 1.5;
        }


        /* =========================
           INSTRUCTOR SECTION
        ========================= */

        .instructor-section {
            background: #eff6ff;
            text-align: center;
        }

        .instructor-section h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .instructor-section p {
            color: #6b7280;
            max-width: 650px;
            margin: 0 auto 25px;
            line-height: 1.6;
        }


        /* =========================
           CTA
        ========================= */

        .cta {
            background: #2563eb;
            color: white;
            text-align: center;
            padding: 65px 7%;
        }

        .cta h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .cta p {
            margin-bottom: 25px;
        }

        .cta a {
            background: white;
            color: #2563eb;
            padding: 13px 25px;
            border-radius: 6px;
            display: inline-block;
            font-weight: bold;
        }


        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #111827;
            color: white;
            padding: 50px 7% 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 35px;
        }

        .footer-box h3 {
            margin-bottom: 15px;
        }

        .footer-box p {
            color: #d1d5db;
            line-height: 1.6;
        }

        .footer-box a {
            display: block;
            color: #d1d5db;
            margin-bottom: 10px;
        }

        .footer-box a:hover {
            color: white;
        }

        .copyright {
            border-top: 1px solid #374151;
            padding-top: 20px;
            text-align: center;
            color: #9ca3af;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {

            .nav-links {
                gap: 10px;
            }

            .hero {
                flex-direction: column;
            }

            .hero-content,
            .hero-box {
                width: 100%;
            }

            .stats,
            .categories,
            .courses,
            .why-grid,
            .steps {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }


        @media (max-width: 600px) {

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero-content h1 {
                font-size: 36px;
            }

            .stats,
            .categories,
            .courses,
            .why-grid,
            .steps,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .hero-buttons {
                flex-direction: column;
            }

        }

    </style>

</head>


<body>


<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar">

    <div class="logo">
        E-Learn
    </div>

    <div class="nav-links">

        <a href="index.php">
            Home
        </a>

        <a href="#about">
            About
        </a>

        <a href="#courses">
            Courses
        </a>

        <a href="#contact">
            Contact
        </a>

        <a href="student/login.php"
           class="login-btn">
            Student Login
        </a>

        <a href="student/register.php"
           class="register-btn">
            Register
        </a>

    </div>

</nav>



<!-- =========================
     HERO
========================= -->

<section class="hero">

    <div class="hero-content">

        <h1>
            Learn Today,
            <span>Build Your Future</span>
        </h1>

        <p>
            Welcome to E-Learn, an online learning platform
            where students can learn new skills, attend courses,
            take quizzes and track their learning progress.
        </p>

        <div class="hero-buttons">

            <a href="student/courses.php"
               class="primary-btn">
                Explore Courses
            </a>

            <a href="student/register.php"
               class="secondary-btn">
                Join Now
            </a>

        </div>

    </div>


    <div class="hero-box">

        <div class="icon">
            🎓
        </div>

        <h2>
            Start Learning
        </h2>

        <p>
            Learn from anywhere and improve your skills
            with our online courses.
        </p>

    </div>

</section>



<!-- =========================
     STATS
========================= -->

<section class="stats">

    <div class="stat-box">

        <h2>100+</h2>

        <p>
            Learning Resources
        </p>

    </div>


    <div class="stat-box">

        <h2>50+</h2>

        <p>
            Courses
        </p>

    </div>


    <div class="stat-box">

        <h2>500+</h2>

        <p>
            Students
        </p>

    </div>


    <div class="stat-box">

        <h2>20+</h2>

        <p>
            Instructors
        </p>

    </div>

</section>



<!-- =========================
     ABOUT
========================= -->

<section class="section"
         id="about">

    <div class="section-title">

        <h2>
            About E-Learn
        </h2>

        <p>
            A simple and effective platform for online learning.
        </p>

    </div>


    <div style="
        max-width:850px;
        margin:auto;
        text-align:center;
        line-height:1.8;
        color:#6b7280;
    ">

        E-Learn is an online learning platform designed
        to connect students and instructors in one place.
        Students can explore courses, access learning
        materials, attempt quizzes and monitor their progress.
        Instructors can manage courses and provide learning
        resources to students.

    </div>

</section>



<!-- =========================
     CATEGORIES
========================= -->

<section class="section">

    <div class="section-title">

        <h2>
            Popular Categories
        </h2>

        <p>
            Explore different areas of learning.
        </p>

    </div>


    <div class="categories">


        <div class="category-card">

            <div class="icon">
                💻
            </div>

            <h3>
                Web Development
            </h3>

            <p>
                Learn HTML, CSS, JavaScript and PHP.
            </p>

        </div>


        <div class="category-card">

            <div class="icon">
                🗄️
            </div>

            <h3>
                Database
            </h3>

            <p>
                Learn MySQL and database management.
            </p>

        </div>


        <div class="category-card">

            <div class="icon">
                🔐
            </div>

            <h3>
                Cyber Security
            </h3>

            <p>
                Understand security and online safety.
            </p>

        </div>


        <div class="category-card">

            <div class="icon">
                🤖
            </div>

            <h3>
                Artificial Intelligence
            </h3>

            <p>
                Explore AI and modern technologies.
            </p>

        </div>


    </div>

</section>



<!-- =========================
     POPULAR COURSES
========================= -->

<section class="section"
         id="courses"
         style="background:#f1f5f9;">

    <div class="section-title">

        <h2>
            Popular Courses
        </h2>

        <p>
            Start learning from our available courses.
        </p>

    </div>


    <div class="courses">


        <?php

        if ($course_result && mysqli_num_rows($course_result) > 0) {

            while ($course = mysqli_fetch_assoc($course_result)) {

        ?>

            <div class="course-card">

                <div class="course-top">
                    📚
                </div>

                <div class="course-content">

                    <h3>
                        <?php
                        echo htmlspecialchars($course['course_name']);
                        ?>
                    </h3>

                    <p>
                        Instructor:
                        <?php
                        echo htmlspecialchars($course['instructor']);
                        ?>
                    </p>

                    <span class="course-status">
                        <?php
                        echo htmlspecialchars($course['status']);
                        ?>
                    </span>

                    <br>

                    <a href="student/course-details.php?id=<?php echo $course['id']; ?>"
                       class="view-course">

                        View Course →

                    </a>

                </div>

            </div>

        <?php

            }

        } else {

        ?>

            <div class="no-course">

                No courses available right now.

            </div>

        <?php

        }

        ?>


    </div>

</section>



<!-- =========================
     WHY CHOOSE US
========================= -->

<section class="section why-section">

    <div class="section-title">

        <h2>
            Why Choose E-Learn?
        </h2>

        <p>
            Everything you need for a better learning experience.
        </p>

    </div>


    <div class="why-grid">


        <div class="why-card">

            <div class="icon">
                📚
            </div>

            <h3>
                Quality Courses
            </h3>

            <p>
                Learn useful and practical skills through
                structured online courses.
            </p>

        </div>


        <div class="why-card">

            <div class="icon">
                👨‍🏫
            </div>

            <h3>
                Expert Instructors
            </h3>

            <p>
                Learn from instructors who provide
                useful educational content.
            </p>

        </div>


        <div class="why-card">

            <div class="icon">
                📝
            </div>

            <h3>
                Quizzes & Assessments
            </h3>

            <p>
                Test your knowledge with quizzes and
                track your learning progress.
            </p>

        </div>


        <div class="why-card">

            <div class="icon">
                📄
            </div>

            <h3>
                Learning Materials
            </h3>

            <p>
                Access useful study materials and
                resources in one place.
            </p>

        </div>


        <div class="why-card">

            <div class="icon">
                📊
            </div>

            <h3>
                Track Progress
            </h3>

            <p>
                Monitor your learning progress and
                improve your performance.
            </p>

        </div>


        <div class="why-card">

            <div class="icon">
                💻
            </div>

            <h3>
                Learn Anywhere
            </h3>

            <p>
                Access your learning platform from
                anywhere using your device.
            </p>

        </div>


    </div>

</section>



<!-- =========================
     HOW IT WORKS
========================= -->

<section class="section">

    <div class="section-title">

        <h2>
            How E-Learn Works
        </h2>

        <p>
            Start your learning journey in three simple steps.
        </p>

    </div>


    <div class="steps">


        <div class="step">

            <div class="step-number">
                1
            </div>

            <h3>
                Create Account
            </h3>

            <p>
                Register as a student and create
                your learning account.
            </p>

        </div>


        <div class="step">

            <div class="step-number">
                2
            </div>

            <h3>
                Choose a Course
            </h3>

            <p>
                Explore available courses and
                select the course you want to learn.
            </p>

        </div>


        <div class="step">

            <div class="step-number">
                3
            </div>

            <h3>
                Start Learning
            </h3>

            <p>
                Access learning materials, attempt
                quizzes and track your progress.
            </p>

        </div>


    </div>

</section>



<!-- =========================
     INSTRUCTOR
========================= -->

<section class="instructor-section section">

    <h2>
        Are You an Instructor?
    </h2>

    <p>
        Share your knowledge with students.
        Create courses, upload learning materials
        and help students improve their skills.
    </p>

    <a href="instructor/login.php"
       class="primary-btn">

        Instructor Login

    </a>

</section>



<!-- =========================
     CTA
========================= -->

<section class="cta">

    <h2>
        Ready to Start Learning?
    </h2>

    <p>
        Create your account and begin your learning journey today.
    </p>

    <a href="student/register.php">
        Create Student Account
    </a>

</section>



<!-- =========================
     FOOTER
========================= -->

<footer id="contact">

    <div class="footer-grid">


        <div class="footer-box">

            <h3>
                E-Learn
            </h3>

            <p>
                An online learning platform that helps
                students learn new skills and provides
                instructors with tools to share knowledge.
            </p>

        </div>


        <div class="footer-box">

            <h3>
                Quick Links
            </h3>

            <a href="index.php">
                Home
            </a>

            <a href="#about">
                About
            </a>

            <a href="#courses">
                Courses
            </a>

        </div>


        <div class="footer-box">

            <h3>
                Student
            </h3>

            <a href="student/login.php">Student Login</a>

           <a href="student/register.php">Register</a>

            <a href="student/courses.php">
                Courses
            </a>

        </div>


        <div class="footer-box">

            <h3>
                Admin
            </h3>

            <a href="admin/login.php">
                Admin Login
            </a>

            <a href="instructor/login.php">
                Instructor Login
            </a>

        </div>


    </div>


    <div class="copyright">

        © 2026 E-Learn. All Rights Reserved.

    </div>

</footer>


</body>

</html>