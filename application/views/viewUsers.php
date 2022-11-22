<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>View user</title>
    </head>
    <body>
        <div class="container" style="margin-top:30px;"  id="userData">
        <?php 
            if($user == null){
                echo "<div style='text-align:center; margin-top:50px;'>No user data available.</div>";
                exit;
            }
        ?>
            <table class="table table-dark">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($user as $row){
                    ?>
                        <tr>
                            <th scope="row"><?php echo $row->id ?></th>
                            <td><?php echo $row->name ?></td>
                            <td><?php echo $row->username ?></td>
                            <td><?php echo $row->email ?></td>
                            <td><?php echo $row->contact ?></td>
                            <td><?php echo $row->address ?></td>
                            <td><button type="button" class="btn btn-danger" name="delete" id="delete" value="<?php echo $row->id ?>">Delete</button></a></td>
                            <td><a href='update/<?php echo $row->id ?>'><button type="button" class="btn btn-warning">Edit</button></a></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();

        var id = $(this).attr("value");
        // console.log(del_id);
        $.ajax({
            url: "delete", 
            type: "get",
            data: {
                id: id
            },
            success: function(response) {
                // console.log(response);
                getUsers();
            }});
    });
        
        function getUsers(){
        $.post( "<?php echo base_url('users/view'); ?>", function( response ){
            // console.log(reponse);
            $('#userData').html(response);
        });
}
</script>
</html>