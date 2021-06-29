<?php require_once 'function.php'; ?>
<?php require_once 'db.php'; ?>
<?php require_once("./assets/includes/header.php") ?>
<!DOCYTPE html>
<html>
<head>
    <title>Taches</title>
    <!-- CSS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Users</title>
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

        <script type="text/javascript">
            $(document).ready(function() {
                $.getJSON('http://localhost/managerone_test/readt.php', function(json) {
                    var tr=[];
                    for (var i = 0; i < json.length; i++) {
                        tr.push('<tr>');
                        tr.push('<td>' + json[i].IdT + '</td>');
                        tr.push('<td>' + json[i].User_id + '</td>');
                        tr.push('<td>' + json[i].Title + '</td>');
                        tr.push('<td>' + json[i].Description + '</td>');
                        tr.push('<td>' + json[i].Date + '</td>');
                        tr.push('<td>' + json[i].Status + '</td>');
                        tr.push('</tr>');
                    }
                    $('table').append($(tr.join('')));
                });

                $(document).delegate('#addNew', 'click', function(event) {
                    event.preventDefault();

                    var User_id = $('#User_id').val();
                    var Title = $('#Title').val();
                    var Description = $('#Description').val();
                    var Status = $('#Status').val();

                    if(User_id == null || User_id == "") {
                    }
                    if(Title == null || Title == "") {
                        alert("Title required");
                        return;
                    }
                    if(Description == null || Description == "") {
                        alert(" Description required");
                        return;
                    }
                    if(Status == null || Status == "") {
                        alert(" Status required");
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        contentType: "application/json; charset=utf-8",
                        url: "http://localhost/managerone_test/createt.php",
                        data: JSON.stringify({'User_id': User_id,'Title': Title,'Description': Description,'Status': Status}),
                        cache: false,
                        success: function(result) {
                            alert('Task added successfully');
                            location.reload(true);
                        },
                        error: function(err) {
                            alert(err);
                        }
                    });
                });


                $(document).delegate('.delete', 'click', function() {
                    var IdT = $(this).attr('IdT');
                    if (confirm('Do you really want to delete record? '.concat(IdT) )) {
                        var parent = $(this).parent().parent();
                        $.ajax({
                            type: "DELETE",
                            url: "http://localhost/managerone_test/deletet.php?IdT=" + IdT,
                            cache: false,
                            success: function() {

                                parent.fadeOut('slow', function() {
                                    $(this).remove();
                                });
                                location.reload(true)
                            },
                            error: function() {
                                alert('Error deleting record');
                            }
                        });
                    }
                });

                $(document).delegate('.edit', 'click', function() {
                    var parent = $(this).parent().parent();

                    var IdT = parent.children("td:nth-child(1)");
                    var Title = parent.children("td:nth-child(3)");
                    var Description = parent.children("td:nth-child(4)");
                    var Status = parent.children("td:nth-child(6)");
                    var buttons = parent.children("td:nth-child(7)");

                    Title.html("<input type='text' id='txtTitle' value='" + Title.html() + "'/>");
                    Description.html("<input type='text' id='txtDescription' value='" + Description.html() + "'/>");
                    Status.html("<input type='text' id='txtStatus' value='" + Status.html() + "'/>");
                    buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + IdT.html() + "'>Delete</button>");
                });

                $(document).delegate('#save', 'click', function() {
                    var parent = $(this).parent().parent();

                    var IdT = parent.children("td:nth-child(1)");
                    var User_id = parent.children("td:nth-child(2)");
                    var Title = parent.children("td:nth-child(3)");
                    var Description = parent.children("td:nth-child(4)");
                    var Date = parent.children("td:nth-child(5)");
                    var Status = parent.children("td:nth-child(6)");
                    var buttons = parent.children("td:nth-child(7)");

                    $.ajax({
                        type: "PUT",
                        contentType: "application/json; charset=utf-8",
                        url: "http://localhost/managerone_test/updatet.php",
                        data: JSON.stringify({'IdT' : IdT.html(),'User_id' : User_id.html(), 'Title' : Title.children("input[type=text]").val(), 'Description' : Description.children("input[type=text]").val(), 'Date' : Date.children("input[type=text]").val(), 'Status' : Status.children("input[type=text]").val()}),
                        cache: false,
                        success: function() {
                            User_id.html(User_id.children("input[type=text]").val());
                            Title.html(Title.children("input[type=text]").val());
                            Description.html(Description.children("input[type=text]").val());
                            Date.html(Date.children("input[type=text]").val());
                            Status.html(Status.children("input[type=text]").val());
                            buttons.html("<button class='edit' id='" + IdT.html() + "'>Edit</button>&nbsp;&nbsp;<button class='delete' id='" + IdT.html() + "'>Delete</button>");
                        },
                        error: function() {
                            alert('Error updating record');
                        }
                    });
                });

            });
        </script>
<html lang="en">

<body>
    <div class="container">
        <div class="top">
            <h1>Bienvenue sur la page des tâches</h1>
            <h1>ici vous pouvrrez voir toutes les tâches de tous les utilisateurs.</h1>
        </div>
        <table>
            <thead>
                <tr>
                <th scope="col">IdT</th>
                <th scope="col">User_id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
                <th scope="col">Task </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>
<?php
require_once "./assets/includes/footer.php"
?>
</html>
    