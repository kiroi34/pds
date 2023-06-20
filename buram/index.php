<!DOCTYPE html>  
<html>  
    <head>  
        <title>Autocomplete Search With Ajax in PHP and MySQL Example</title>  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
        <style>  
            ul
            {  
                background-color:#eee;  
                cursor:pointer;  
            }  
            li
            {  
                padding:12px;  
            }
        </style>  
    </head>  
    <body class="bg-dark">  
        <div class="container pt-5 mt-3">
            <div class="content">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="text-center">Autocomplete Search With Ajax in PHP and MySQL Example</h2>
                    </div>
                    <div class="card-body">
                        <label>Search User Name :</label>  
                        <input type="text" name="user" id="user" class="form-control mt-2" placeholder="Enter User Name" />  
                        <div id="userList"></div>       
                    </div>
                </div>
            </div>
        </div>
    </body>  
</html>  
<script>  
    $(document).ready(function(){  
        $('#user').keyup(function(){  
            var query = $(this).val();  
            if(query != '')  
            {  
                $.ajax({  
                    url:"search.php",  
                    method:"POST",  
                    data:{query:query},  
                    success:function(data)  
                    {  
                        $('#userList').fadeIn();  
                        $('#userList').html(data);  
                    }  
                });  
            }  
        });  
        $(document).on('click', 'li', function(){  
            $('#user').val($(this).text());  
            $('#userList').fadeOut();  
        });  
    });  
</script>