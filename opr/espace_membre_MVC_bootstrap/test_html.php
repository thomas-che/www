<!DOCTYPE html> 
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../style/bootstrap-4.4.1-dist/css/bootstrap.min.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../style/fontawesome-free-5.11.2-web/css/all.min.css">

        <link rel="stylesheet" href="style_test.css"/>
        <title>TEST</title>
    </head>

    <body>
        
        <div class="modal-dialog text-center">
            <div class="col-sm-8 main-section">
                <div class="modal-content">

                    <div class="col-12 user-img">
                        <img src="img_profile.jpg">
                    </div>

                    <form class="col-12">

                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" ><i class="fas fa-user"></i></span>
                              </div>
                              <input type="text" name="pseudo" id="pseudo" placeholder="Username" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" ><i class="fas fa-lock"></i></span>
                              </div>
                              <input type="password" name="mdp" id="mdp" placeholder="Mot de pass" class="form-control"/>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-outline-success"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </form>

                    <div class="col-12 forgot">
                        <a href="#">Forgot password ?</a>
                    </div>

                </div>
            </div>
        </div>








<p>########################################################################</p>







        <div class="container">
            <div class="row"> 
                <div class="col-xl-3"></div>
                <div class="col-xl-6">
                    <h2>Connexion</h2>
                    <form method="post" action="index.php"> 
                        <fieldset> 
                            <div class="form-group">
                                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" />
                            </div>
                            <div class="form-group">
                                <input type="password" name="mdp" id="mdp" placeholder="Mot de pass" />
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="co_auto" id="co_auto" />
                                    <label class="form-check-label" for="co_auto">Connexion automatique </label>
                                    
                                </div>
                            </div>
                            <p>
                                <input class="btn btn-success" type="submit" name="connexion" value="se conncter" />
                            </p>
                            <p>
                                <input type="submit" name="goRegistration" value="Shaitez-vous vous inscrire ?" />
                            </p>
                        </fieldset>
                    </form>
                </div>
                <div class="col-xl-3"></div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>





