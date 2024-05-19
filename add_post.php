<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoG</title>
    <style>
        body {
            background-color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
        }

        .square {
            position: relative;
            min-height: 50px;
            border-radius: 20px;
            border: 5px solid white;
            background-color: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 48px;
            color: white;
            text-decoration: none;
        }

        .image_holder {
            width: calc(40% - 20px);
            height: 700px;
        }
        .description_holder {
            width: 100%;
            height: 500px;
            margin-bottom: 10px;
        }

        .title_holder {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }

        .image_holder img {
            max-width: 100%;
            max-height: 100%;
            display: block;
        }

        .postButton {
            width: calc(60% - 20px);
            display: flex;
            flex-flow: column wrap;
        }

        .postButton #postBtn {
            width: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 6px 14px;
            font-family: -apple-system, BlinkMacSystemFont, 'Roboto', sans-serif;
            border-radius: 6px;
            border: none;

            background: #6E6D70;
            box-shadow: 0px 0.5px 1px rgba(0, 0, 0, 0.1), inset 0px 0.5px 0.5px rgba(255, 255, 255, 0.5), 0px 0px 0px 0.5px rgba(0, 0, 0, 0.12);
            color: #DFDEDF;
        }

        .transparent_text_field {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            height: 90%;
            background: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 18px;
            text-align: center;
            resize: none;
        }

        .image_holder::before,
        .description_holder::before,
        .title_holder::before {
            content: attr(data-text);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .plus_button {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            color: black;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 2;
        }

        .title_holder .plus_button {
            left: 90%;
        }

        .plus_button::before {
            content: '+';
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="square image_holder" data-text="Image">
            <input type="file" id="fileInput" style="display:none;" accept="image/*">
            <button class="plus_button" onclick="addPostImage()"></button>
        </div>
        <div class="postButton">
            <div class="square title_holder" data-text="Title">
                <button class="plus_button" onclick="addPostTitle()"></button>
            </div>
            <div class="square description_holder" data-text="Description">
                <button class="plus_button" onclick="addPostDescription()"></button>
            </div>
            <button id="postBtn" onclick="addPost()">Posto!</button>
        </div>
    </div>
    <script>
        function addPostImage() {
            var fileInput = document.getElementById('fileInput');
            var imageHolder = document.querySelector('.image_holder');
            
            fileInput.click();

            fileInput.addEventListener('change', function() {
                var file = fileInput.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var img = new Image();
                        img.src = event.target.result;
                        img.onload = function() {
                            if (img.width > img.height) {
                                img.style.height = '100%';
                                img.style.width = 'auto';
                            } else {
                                img.style.width = '100%';
                                img.style.height = 'auto';
                            }
                        };
                        imageHolder.setAttribute('data-text', '');
                        imageHolder.innerHTML = '';
                        imageHolder.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
        function addPostTitle() {
            var descriptionHolder = document.querySelector('.title_holder');
            descriptionHolder.setAttribute('data-text', '');

            var textField = document.createElement('textarea');
            textField.className = 'transparent_text_field';
            descriptionHolder.innerHTML = '';
            descriptionHolder.appendChild(textField);
        }
        function addPostDescription() {
            var descriptionHolder = document.querySelector('.description_holder');
            descriptionHolder.setAttribute('data-text', '');

            var textField = document.createElement('textarea');
            textField.className = 'transparent_text_field';
            descriptionHolder.innerHTML = '';
            descriptionHolder.appendChild(textField);
        }
        function addPost() {
            try {
                console.log('posting');
                var imageHolder = document.querySelector('.image_holder');
                var imageUrl = "";
                if (imageHolder.children.length > 0 && imageHolder.children[0].tagName === "IMG") {
                    imageUrl = imageHolder.children[0].src;
                }
    
                var descriptionHolder = document.querySelector('.description_holder');
                var text = "";
                if (descriptionHolder.children.length > 0 && descriptionHolder.children[0].tagName === "TEXTAREA") {
                    text = descriptionHolder.children[0].value;
                }
    
                var titleHolder = document.querySelector('.title_holder');
                var title = "";
                if (titleHolder.children.length > 0 && titleHolder.children[0].tagName === "TEXTAREA") {
                    title = titleHolder.children[0].value;
                }
                console.log('image  path: ', imageUrl, ' post title: ', title, ' post text: ', text);
                const user_string = localStorage.getItem("user");
                const user_obj = JSON.parse(user_string);
                if(user_obj?.user_role === 'creator' && user_obj?.user_name) {
                    var data = new URLSearchParams();
                    data.append('imageUrl', imageUrl);
                    data.append('description', text);
                    data.append('title', title);
                    data.append('userName', user_obj.user_name);
                    axios.post('add_post_functions.php', data)
                    .then(function (response) {
                        if (response.status) {
                            window.location.href = 'index.php';
                        } else {
                            console.log('error: 'response.message);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
                }
            } catch (error) {
                console.log(error);
            }
        }
    </script>
</body>
</html>
