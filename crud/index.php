<?php
//connection with database
// INSERT INTO `app` (`srno`, `title`, `description`, `time`) VALUES (NULL, 'this is title_1', 'i love to do coding', current_timestamp());
$servername="localhost";
$username="root";
$password="";
$database="crud";

$conn=mysqli_connect($servername,$username,$password,$database);

if($conn)
{
  // echo "the connection is established";
}
else
{
die(mysqli_connect_error());
}



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
   

    <title>Hello, world!</title>
  </head>
  <body>






<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
         
      <form action=/crud/index.php method="post">
        <div class="mb-3">
            <input type="hidden" id="hidden" name="hidden">
          <label for="title" class="form-label">Note Title</label>
          <input type="text" class="form-control title_edit" id="title" name="title" aria-describedby="emailHelp">
          </div>
         
          <div class="mb-3">
            <label for="area" class="form-label">Note Description</label>
            <textarea class="form-control desc_edit" id="area" rows="8" name="description"></textarea>
          </div>
 
          <button type="submit" class="btn btn-primary">Update Note</button>

      
      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>








    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">INotes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" onclick="fun(1)"  href="#">Home</a>
                  </li>
              <li class="nav-item">
                <a class="nav-link" onclick="fun(2)"  href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" onclick="fun(3)" >Contact Us</a>
              </li>
             
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>


      <?php
      $afc=1;

if($_SERVER['REQUEST_METHOD']=='POST')

{
    if(isset($_POST['hidden']))
    {
        $resu=$_POST['hidden'];
        $titles=$_POST['title']; 
        $descr=$_POST['description'];
        
        $upd="update app
          set title='$titles',description='$descr' where srno ='2'";
          $ex_up=mysqli_query($conn,$upd);

          if($ex_up)
          {
            echo "data updated";
          }
          else
          {
            echo mysqli_error($conn);
          }
    }
    else
    {
       
 $title=$_POST['title']; 
 $desc=$_POST['description'];

 $inser="insert into app(srno,title,description)
 VALUES
 ('$afc','$title','$desc')";

 $ins_res=mysqli_query($conn,$inser);
 $afc++;
 if(!$ins_res)
 {
    echo mysqli_error($conn);
 }
 else
 {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your data has been submitted sucessfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
 }
    }

}



?> 
   
   <div class="container" class="mt-5">
    <h2 class="my-4">Add a Note</h2>
    <form action="/crud/index.php" method="post">
        <div class="mb-3">
          <label for="title" class="form-label">Note Title</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
          </div>
         
          <div class="mb-3">
            <label for="area" class="form-label">Note Description</label>
            <textarea class="form-control" id="area" rows="8" name="description"></textarea>
          </div>

        <button type="submit" class="btn btn-primary">ADD NOTE</button>
      </form>
   </div>
   
   

   
   
<div class="container mt-5">



<table class="table"id="myTable">
  <thead>
    <tr>
      <th scope="col">Sr.no</th>
      <th scope="col">Title</th>
      <th scope="col">Ttile description</th>
      <th scope="col">timer</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>

  <?php

$dis="select * from app";
$dis_qu=mysqli_query($conn,$dis);

$rec=mysqli_num_rows($dis_qu);
$num=0;
$srno=1;
while($num<$rec)
{
    $fet=mysqli_fetch_assoc($dis_qu);

    echo "<tr>
    <th scope='row'>".$srno."</th>
    <td>". $fet['title']."</td>
    <td>" .$fet['description']."</td>
    <td>".$fet['time']."</td>
    <td><button type='button' class='btn btn-primary edit'id=".$srno." data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button> <button type='button' class='btn btn-primary dele'>Delete</button></td>
      </tr>";
    
    $num++;
    $srno++;
    
}


?>
    
    
  </tbody>
</table>
   
</div>
   
   
   
   

   














   
   
   
   
   
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
      <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

   <script>
    let a=document.getElementsByClassName('nav-link')[0];
    let b=document.getElementsByClassName('nav-link')[1];
    let c=document.getElementsByClassName('nav-link')[2];
    a.classList.add('active');
    b.classList.remove('active');
    c.classList.remove('active');
    let table = new DataTable('#myTable');

function fun(n)
{
    let a=document.getElementsByClassName('nav-link')[0];
    let b=document.getElementsByClassName('nav-link')[1];
    let c=document.getElementsByClassName('nav-link')[2];
if(n==1)
{
    a.classList.add('active');
    b.classList.remove('active');
    c.classList.remove('active');
}
if(n==2)
{
    a.classList.remove('active');
    b.classList.add('active');
    c.classList.remove('active');
}
if(n==3)
{
    a.classList.remove('active');
    b.classList.remove('active');
    c.classList.add('active');
}



}



//edit button 
let edt=document.getElementsByClassName('edit');
Array.from(edt).forEach((efg)=>{
    efg.addEventListener('click',function(e){
        let parent=e.target.parentNode.parentNode;
        let title=parent.getElementsByTagName('td')[0].innerHTML;
        let description=parent.getElementsByTagName('td')[1].innerHTML;


    document.getElementsByClassName('title_edit')[0].value=title;
    document.getElementsByClassName('desc_edit')[0].value=description;

    let value_of_btn=document.getElementById('hidden').value;
    value_of_btn=e.target.id;
    console.log(e.target.id);
   
        

 
})});
let del=document.getElementsByClassName('dele');
Array.from(del).forEach((efg)=>{
    efg.addEventListener('click',function(e){
        let parent=e.target.parentNode.parentNode;
        let title=parent.getElementsByTagName('td')[0].innerHTML;
        let description=parent.getElementsByTagName('td')[1].innerHTML;


    document.getElementsByClassName('title_edit')[0].value=title;
    document.getElementsByClassName('desc_edit')[0].value=description;

    let value_of_btn=document.getElementById('hidden').value;
    value_of_btn=e.target.id;
    console.log(e.target.id);
   
        

 
})});









   </script>
  
  </body>
</html>