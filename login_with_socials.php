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
    <script>
        //GOOGLE
        // Credential response handler function
        function handleCredentialResponse(response){
            // Post JWT token to server-side
            fetch("login.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ request_type:'user_auth', credential: response.credential }),
            })
            .then(response => response.json())
            .catch(console.error);
        }

        // Sign out the user
        function signOut(authID) {
            document.getElementsByClassName("pro-data")[0].innerHTML = '';
            document.querySelector("#btnWrap").classList.remove("hidden");
            document.querySelector(".pro-data").classList.add("hidden");
        }    


        // <!--Facebook SDK for Javascript -->
        window.fbAsyncInit = function() {
            FB.init({
            appId      : '1342911753070366',
            xfbml      : true,
            version    : 'v19.0'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // <!-- facebook login logic -- missing
    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0&appId=1342911753070366" nonce="lCd6mLTw"></script>


    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <h3 class="mb-5">Sign in</h3>

                    <!-- Sign in with Google-->
                    <div id="g_id_onload"
                        data-client_id="92519646988-f1tp6j004r1gcdi9a42857ci7hbpv96g.apps.googleusercontent.com"
                        data-context="signin"
                        data-ux_mode="popup"
                        data-callback="handleCredentialResponse"
                        data-auto_prompt="true">
                    </div>
                    <div class="g-signin2"
                        data-type="standard"
                        data-shape="rectangular"
                        data-theme="outline"
                        data-text="signin_with"
                        data-size="large"
                        data-logo_alignment="left">
                    </div>


                <div class="fb-login-button" data-width="200" data-size="" data-button-type="" data-layout="" data-auto-logout-link="true" data-use-continue-as="false"></div>                
            </div>
            </div>
            </div>
        </div>
</section>


<!-- <script>
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
</script>     -->





<!-- google login -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    
</body>
</html> 