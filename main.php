<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(#b52bff, #ffdc2b);
            color: white;
        }
        h1 {
            margin-top: 100px;
        }
        form {
            margin: 30px 0;
        }
        p {
            font-size: 24px;
        }
        #space {
            width: 5px;
        }
        #deleteText {
            background-color: #ffffff;
            border: 1px solid #ced4da;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 col-md-offset-3">
                <h1 class="text-center">Create short link!</h1>
                <form>
                    <div class="form-input">
                        <div class="input-group mb-4">
                            <input placeholder="http://exemple.com" class="form-control col-sm-8" id='fullLink' type="text" >
                            <div class="input-group-append">
                                <button id="deleteText" class="btn" type="button">X</button>
                            </div>
                            <div id="space"><p></p></div>
                            <input type="button" class="btn btn-primary col-sm-3" id="btn" value="short link!">
                        </div>
                    </div>
                </form>
                <div class="col-sm-12">
                    <p class="text-center">Ваша ссылка доступна по адресу <?=$serverName?>/<span id="shortLink"></span></p>
                </div>
            </div>
        </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#btn').click(function () {
            $.ajax({
                url:'/makeShortLink.php',
                type: 'post',
                data: {'full': $('#fullLink').val()},
                success: function (res) {
                    // console.log('все ок');
                    // console.log(res);
                    console.log(res);
                    $('#shortLink').html(res.replace(/"/g, ''));

                },
                error: function () {
                    console.log('не все ок')
                }
            })
        })
    });
</script>
</body>
</html>