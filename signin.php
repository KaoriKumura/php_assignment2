<?php require('./includes/header.php'); ?>

<body class="index_body">
  <main class="signinindex">
    <div class="myForm">
    <form class="signin" action="./validate.php" method="post">
      <section>
        <h3>Log in</h3>
        <div class="info">
          <label for="id"></label>
          <input type="id" name="id" id="id" placeholder="User ID" required/>
        </div>
        <div class="info">
          <label for="password"></label>
          <input type="password" name="password" id="password" placeholder="password" required/>
        </div>
      </section>
      <button class="signin" type="submit">Submit</button>
      <h4>Not a student? <a href="index.php">Sign up Now!</a></h4>
    </form>
  </div>
    <div class="comment2">
      <h1>Build your future in Canada with KUFS</h1>
    </div>
  </main>
  </section>
  <?php require('./includes/footer.php'); ?>