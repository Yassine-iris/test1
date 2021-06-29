<?php require_once 'function.php'; ?>
<?php require_once 'db.php'; ?>
<?php require_once("./assets/includes/header.php") ?>
<!DOCYTPE html>
<html>
<head>
    <title>Utilisateurs</title>
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
                $.getJSON('http://localhost/managerone_test/read.php', function(json) {
                    var tr=[];
                    for (var i = 0; i < json.length; i++) {
                        tr.push('<tr>');
                        tr.push('<td>' + json[i].id + '</td>');
                        tr.push('<td>' + json[i].name + '</td>');
                        tr.push('<td>' + json[i].email + '</td>');
                        tr.push('<td><button class=\'edit\'>Edit</button>&nbsp;&nbsp;<button class=\'delete\' id=' + json[i].id + '>Delete</button></td>');
                        tr.push('<td><a href="tache.php?id=' + json[i].id + '">Afficher les taches</a></td>');
                        tr.push('</tr>');

                    }
                    $('table').append($(tr.join('')));
                });

                $(document).delegate('#addNew', 'click', function(event) {
                    event.preventDefault();

                    var name = $('#name').val();
                    var email = $('#email').val();

                    if(name == null || name == "") {
                        alert("Name required");
                        return;
                    }
                    if(email == null || email == "") {
                        alert(" email required");
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        contentType: "application/json; charset=utf-8",
                        url: "http://localhost/managerone_test/create.php",
                        data: JSON.stringify({'name': name,'email': email}),
                        cache: false,
                        success: function(result) {
                            alert('User added successfully');
                            location.reload(true);
                        },
                        error: function(err) {
                            alert(err);
                        }
                    });
                });


                $(document).delegate('.delete', 'click', function() {
                    var id = $(this).attr('id');
                    if (confirm('Do you really want to delete user '.concat(id))) {
                        var parent = $(this).parent().parent();
                        $.ajax({
                            type: "DELETE",
                            url: "http://localhost/managerone_test/delete.php?id=" + id,
                            cache: false,
                            success: function() {
                                parent.fadeOut('slow', function() {
                                    $(this).remove();
                                });
                                location.reload(true)
                            },
                            error: function() {
                                alert('Error deleting user');
                            }
                        });
                    }
                });

                $(document).delegate('.edit', 'click', function() {
                    var parent = $(this).parent().parent();

                    var id = parent.children("td:nth-child(1)");
                    var name = parent.children("td:nth-child(2)");
                    var email = parent.children("td:nth-child(3)");
                    var buttons = parent.children("td:nth-child(4)");

                    name.html("<input type='text' id='txtName' value=' " + name.html() + "'/>");
                    email.html("<input type='text' id='txtEmail' value='" + email.html() + "'/>");
                    buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
                });

                $(document).delegate('#save', 'click', function() {
                    var parent = $(this).parent().parent();

                    var id = parent.children("td:nth-child(1)");
                    var name = parent.children("td:nth-child(2)");
                    var email = parent.children("td:nth-child(3)");
                    var buttons = parent.children("td:nth-child(4)");


                    $.ajax({
                        type: "PUT",
                        contentType: "application/json; charset=utf-8",
                        url: "http://localhost/managerone_test/update.php",
                        data: JSON.stringify({'id' : id.html(), 'name' : name.children("input[type=text]").val(),'id' : id.html(), 'email' : email.children("input[type=text]").val()}),
                        cache: false,
                        success: function() {
                            name.html(name.children("input[type=text]").val());
                            email.html(email.children("input[type=text]").val());
                            buttons.html("<button class='edit' id='" + id.html() + "'>Edit</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
                        },
                        error: function() {
                            alert('Error updating user');
                        }
                    });
                });

            });
        </script>

<html lang="en">

<body>
    <div class="container">
        <div class="top">
            <h1>Bienvenue sur la page des utilisateurs</h1>
            <h1>ici vous pouvrrez ajouter, modifier ou supprimer un utilisateur.</h1>
            <h1>Ajouter un utilisateur</h1>
        </div>
        <div class="formulaire">
            <form action="" method="post">
                <input type="text" id="name" name="name" value="">
                <input type="email" id="email" name="email" value="">
                <button class="btn" type="button" id="addNew">Save</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                <th scope="col">Id</th>
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
    