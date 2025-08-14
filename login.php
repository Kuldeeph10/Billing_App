<?php include("includes/header.php"); ?>

<div class="py-5 bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-4">
                    <?php alertmessage(); ?>
                    <div class="p-5">
                        <h4 class="text-dark mb-3">Sign into your Billing Application</h4>
                        <form action="login-code.php" method="post">

                            <div class="mb-3">
                                <label>Enter Email Id:</label>
                                <input type="email" name="email" required class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label>Enter Password:</label>
                                <input type="password" name="password" required class="form-control" />
                            </div>

                            <div class="my-3">
                                <button class="btn btn-primary w-100 mt-2" name="loginbtn" type="submit">Sign
                                    In</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h1></h1>
<?php include("includes/footer.php"); ?>