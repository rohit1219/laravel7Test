@extends('layout')

    <meta name="_token" content="{{csrf_token()}}" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Form</title>
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
</style>
<body>

<div class="container" style="padding-top: 50px;">
<div class="form-group">
    <h1>Welcome {{ Session::get('data')[0]['name'] }}
</div>
<div class="form-group">
<table id="myTable" style="width: 80%;">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email Id</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
    </thead>
@foreach($data as $user)
    <tbody>
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary" data-user_id="{{$user->userId}}" data-toggle="modal" data-target="#myModal">
                    Edit
                </button>
                <!-- <a href="edit/{{$user->userId}}">Edit</a>&nbsp -->
                <a type="button" class="btn btn-danger" href="delete/{{$user->userId}}">Delete</a>
            </td>
        </tr>
    </tbody>
@endforeach
</table>
<br>

<div class="form-group row">
    <div>
        <a type="button" class="btn btn-primary" href="logout">Logout</a>
    </div>&nbsp&nbsp&nbsp
    <di>
        {!! $data->links() !!}
    </div>
</div>
</div>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h1 class="modal-title">Edit Form</h1>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                <form id="myForm">
                    <input class="form-control" type="hidden" name="userId" value="" id="userId">
                    Name: <input class="form-control" type="text" name="name" value="" id="name">
                    @error('name')
                        <span style="color:red">{{$message}}</span>
                    @enderror<br><br>
                    Email: <input class="form-control" type="text" name="email" value="" id="email" >
                    @error('email')
                        <span style="color:red">{{$message}}</span>
                    @enderror<br><br>
                    Password: <input class="form-control" type="text" name="password" value="" id="password">
                    @error('password')
                        <span style="color:red">{{$message}}</span>
                    @enderror<br><br>
                    Phone: <input class="form-control" type="text" name="phone" value="" id="phone">
                    @error('phone')
                        <span style="color:red">{{$message}}</span>
                    @enderror<br><br>
               
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <!-- <input class="form-control" type="submit" name="submit" > -->
                <button class="btn btn-primary" type="submit" id="ajaxSubmit" value="submit">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </form>
        </div>
        
      </div>
    </div>
  </div>
  
</div>

 </div>
</body>
</html>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>
<script>
// For editting data in modal popup with Dynamic ID passing start-------
 
$(document).ready(function()
{    
 $('#myModal').on('show.bs.modal', function (e) 
 {        
 var user_id = $(e.relatedTarget).data('user_id');
    // alert(user_id);
    $.ajax(
    {            
        type    : 'get',            
        url     : 'edit/'+user_id, //Here you will fetch records      
        data    : 'user_id='+ user_id, //Pass $user_id        
        success : function(result)
    {   
        //Show fetched data from database
        $('#userId').val(result.result[0].userId);
        $('#name').val(result.result[0].name);
        $('#email').val(result.result[0].email);
        $('#password').val(result.password);
        $('#phone').val(result.result[0].phone);
    },
        error   : function(result) 
    { 
        alert('error'+result); 
    }
    });   
 });

$('#ajaxSubmit').click(function(e){
    e.preventDefault();
    var form = $('#myForm');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
  
    $.ajax({
        url: "{{ url('/edit_update') }}",
        method: 'post',
        dateType: 'json',
        data: {
            userId: $('#userId').val(),
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            phone: $('#phone').val()
        },
        success: function(result){
            if(result['res'] == true){
                $('#myModal').modal('hide');
                $('.modal-backdrop').remove();  
                return false;
            }
        },
            error   : function(result) 
        { 
            alert('error'+result); 
        }
     
        });
    });

});
 // For editting data in modal popup with Dynamic ID passing close----------->
</script>