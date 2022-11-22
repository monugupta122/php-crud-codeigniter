<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Edit user details</title>
    </head>
    <body>
        <div class="container" style="margin-top:30px;" id="userData">
        <p id="message" value="" style="text-align:center; margin-top:50px;">Data updates sucessfully.</p>
            <form method="post" id="updateForm">
                <input type="hidden" name="id" id="id" value="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="" class="form-control">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" value="" class="form-control" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="contact">Contact no</label>
                <input type="tel" name="contact" id="contact" value="" class="form-control" min="10" max="10">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="address" rows="2"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="update" id="update" value="Update"/>
            <button type="button" class="btn btn-danger" name="back" id="back" value="">Back</button>
            </form>
        </div>
    </body>
    <script>
     $(document).ready(function() {
        // console.log('here');
        $('#message').hide();
        $('#back').hide();
        getUser();
        $('#back').click(function(){
            window.location.replace(baseurl+'Users/view');
        });
    });
    const baseurl = "<?php echo base_url() ?>";
        
        function getUser(){
            //getting user data
            // alert(baseurl);
            var id = <?php echo $id ?>;
            // alert(id);
            $.ajax({
                type: "post",
                url: baseurl+"Users/getUserById", 
                data: {
                   id:id
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    // console.log(typeof(data));
                   console.log(data);
                    if (data["response"] == "success") {
                        $('#id').val(data["userData"]["id"]),
                        $('#name').val(data["userData"]["name"]),
                        $('#username').val(data["userData"]["username"]),
                        $('#email').val(data["userData"]["email"]),
                        $('#contact').val(data["userData"]["contact"]),
                        $('#address').val(data["userData"]["address"])
                    }
                },
                error: function(xhr){
                    console.log("error");
                }
                });
        }

        //updating user data
        $('#updateForm').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: baseurl+'Users/updatedata',
                data: {
                    id: $('#id').val(),
                    name: $("#name").val(),
                    username: $("#username").val(),
                    email: $("#email").val(),
                    contact: $("#contact").val(),
                    address: $("#address").val()
                },
                success: function(response){
                    $('#message').show();
                    $('#back').show();
                    let data = JSON.parse(response);
                    if(data['response'] == "success"){
                        console.log(data['message']);
                    }
                }
            });
        });

        function goBack(){
            $("#goBack").click(function(){
                window.location.replace(baseurl+'Users/view');
            });
        }    
</script>
</html>