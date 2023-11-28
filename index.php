<?php require('./includes/header.php'); ?>

<body class="index_body">
    <main class="index">
        <div class="myForm">
            <form method="post" action="save-std.php" enctype="multipart/form-data">
                <section>
                    <h3>Sign up</h3>
                    <div class="info">
                        <label for="fname"></label>
                        <input type="text" name="fname" id="fname" placeholder="First Name" />
                    </div>
                    <div class="info">
                        <label for="lname"></label>
                        <input type="text" name="lname" id="lname" placeholder="Last Name" />
                    </div>
                    <div class="info">
                        <label for="phone"></label>
                        <input type="tel" name="phone" id="phone" placeholder="Phone" />
                    </div>
                    <div class="info">
                        <label for="email"></label>
                        <input type="email" name="email" id="email" placeholder="email" />
                    </div>
                    <div class="info">
                        <label for="password"></label>
                        <input type="password" name="password" id="password" placeholder="Password" />
                    </div>
                    <div class="info">
                        <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" />
                    </div>
                    <div class="info">
                        <select name="role">
                            <option value="user"></option>
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <div class="info">
                        <input class="file" type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
                    </div>
                </section>
                <button class="signin" type="submit">Submit</button>
                <h4>Already have an account?<a href="signin.php"> Log in!</a></h3>
            </form>
            <div class="comment">
                <h1>Build your future in Canada with KUFS</h1>
            </div>
        </div>
    </main>
    <?php
    require('./includes/footer.php');
    ?>