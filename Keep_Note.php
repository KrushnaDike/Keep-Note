<?php
    // Connecting to a database      
    $insert = false; 
    $update = false; 
    $delete = false;            
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "knotes";

    // create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Die if connection was not succesfful
    if(!$conn) {
        echo "Database Connection Unsuccessful! because of error --> " . mysqli_connect_error();
    }

    // to delete record
    if(isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        // sql query to be executed
        $sql = "DELETE FROM `notes` WHERE `notes`.`srno.` = '$sno'";
        $result = mysqli_query($conn, $sql);

        // check for the database deleted successful
        if(!$result) {
            echo "The data was not deleted successfully because of the error --> ". mysqli_connect($conn);
        }
        else {
            $delete = true;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['snoEdit'])) {
            // update the record
            $title = $_POST['titleEdit'];
            $desc = $_POST['descriptionEdit'];
            $sno = $_POST['snoEdit'];

            // submit this to database
            $sql = "UPDATE `notes` SET `title` = '$title',`description` = '$desc' WHERE `srno.` = '$sno'";
            $result = mysqli_query($conn, $sql);

            // check for the database updation successful
            if(!$result) {
                echo "The data was not updated successfully because of the error --> ". mysqli_connect($conn);
            }
            else {
                $update = true;
            }
        }
        else {
            // insert the record
            $title = $_POST['title'];
            $desc = $_POST['description'];

            // submit this to database
            $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$desc')";
            $result = mysqli_query($conn, $sql);

            // check for the database creation successful
            if(!$result) {
                echo "The data was not inserted successfully because of the error --> ". mysqli_connect($conn);
            }
            else {
                $insert = true;
            }
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- include datatables css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <title>Keep Note</title>
  </head>
  <body>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="/krushna/32_Keep_Note.php" method="post">
                    <input type="hidden" name="snoEdit" id="snoEdit">

                    <div class="form-group">
                        <label for="title">Note Title</label>
                        <input type="text" class="form-control" id="titleEdit" aria-describedby="title" name="titleEdit">
                    </div>

                    <div class="form-group">
                        <label for="description">Note Description</label>
                        <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Note</button>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Knotes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        </nav>

        <?php
            if($insert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Note has been Inserted successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        ?>

        <?php
            if($update) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Note has been Updated successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        ?>

        <?php
            if($delete) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Note has been Deleted successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        ?>

        <div class="container my-4">
            <h2>Add a Note</h2>
            <form action="/krushna/32_Keep_Note.php" method="post">

                <div class="form-group">
                    <label for="title">Note Title</label>
                    <input type="text" class="form-control" id="title" aria-describedby="title" name="title">
                </div>

                <div class="form-group">
                    <label for="description">Note Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add Note</button>

            </form>
        </div>

        <div class="container my-4">
            <table class="table" id="myTable">
            <thead>
                <tr>
                <th scope="col">Sr.No</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `notes`";
                    $result = mysqli_query($conn, $sql);
                    $srno = 1;

                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <th scope='row'> ". $srno."</th>
                        <td>". $row['title'] ."</td>
                        <td>". $row['description'] ."</td>
                        <td> <button class='edit btn btn-sm btn-primary' id=". $row['srno.'] .">Edit</button> <button class='delete btn btn-sm btn-primary' id=d". $row['srno.'] .">Delete</button> </td>
                        </tr>";

                        $srno++;
                    }
                ?>
            </tbody>
            </table>
        </div>

        <hr>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- inlude datatables js -->
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>

    <!-- To edit and delete -->
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener('click', (e)=>{
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                $('#editModal').modal('toggle');
                console.log(e.target.id);
            });
        });

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element)=>{
            element.addEventListener('click', (e)=>{
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                
                sno = e.target.id.substr(1,);

                if(confirm("Press to delete!")) {
                    console.log("Yes");
                    window.location = `/krushna/32_Keep_Note.php?delete=${sno}`;
                }
                else {
                    console.log("No");
                }
            });
        });

    </script>
  </body>
</html>