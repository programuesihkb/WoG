<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="92519646988-f1tp6j004r1gcdi9a42857ci7hbpv96g.apps.googleusercontent.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>sign Up Wog</title>
</head>
<body>

    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <h3 class="mb-5">Sign in</h3>

                    <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
                    <label class="form-label" for="typeEmailX-2">Email</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="typePasswordX-2" class="form-control form-control-lg" />
                    <label class="form-label" for="typePasswordX-2">Password</label>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-start mb-4">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                    <label class="form-check-label" for="form1Example3"> Remember password </label>
                    </div>

                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

                    <hr class="my-4">

                    <!-- Sign in with Google-->
                    <div class="g-signin2" data-onsuccess="onSignIn"></div>
                    <a href="#" onclick="signOut();">Sign out</a>

                    <!-- <button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg btn-block btn-primary g-signin2" style="background-color: #dd4b39;"
                    type="submit" data-onsuccess="onSignIn"> Sign in with google</button>  -->

                    <!-- Sign in with Facebook-->
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg btn-block btn-primary mb-2 fb-login-button" style="background-color: #3b5998;"
                        type="submit" onclick="FB.login(function(response) {
                            if (response.authResponse) {
                                console.log('Welcome! Fetching your information.... ');
                                FB.api('/me', {fields: 'name, email'}, function(response) {
                                    document.getElementById('profile').innerHTML = 'Good to see you, ' + response.name + '. Your email address is ' + response.email;
                                });
                            } else {
                                console.log('User cancelled login or did not fully authorize.');
                            }
                        });"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook</button>
                    
                    <!-- <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0&appId=1342911753070366" nonce="veS40ESW"></script>
                    <div class="fb-login-button" data-width="" data-size="" data-button-type="" data-layout="" data-auto-logout-link="false" data-use-continue-as="false"></div>
                </div> -->
                </div>
            </div>
            </div>
        </div>
</section>


<script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }

    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
        console.log('User signed out.');
        });
    }


</script>    




<script>
        // <!-- Add the Facebook SDK for Javascript -->
  
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk')
        );


        window.fbAsyncInit = function() {
            // Initialize the SDK with your app and the Graph API version for your app
            FB.init({
                appId: '1342911753070366',
                xfbml: true,
                version: 'v19.0'
            });
            FB.AppEvents.logPageView();
        };

    

      </script>
<!-- google login -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    
</body>
</html> 