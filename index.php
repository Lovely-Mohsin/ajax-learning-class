<!DOCTYPE html>
<html lang="en">

<head>
    <title>AJAX CRUD</title>
    <!-- bootstrp links -->
    <link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container w-75 shadow mx-auto mt-5 p-5">

        <h3 class=" p-1 mb-2">Add <span class="text-success"> User</span> Information</h3>
        <hr>

        <!-- form to get data from user -->
        <div class="row ">
            <div class="col-md-4 px-3 mt-2">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control  mb-3" id="fname" placeholder="Enter here..." />
            </div>

            <div class="col-md-4 px-3 mt-2">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control mb-3" id='lname' placeholder="Enter here..." />
            </div>

            <div class="col-md-4 mt-3 mx-auto">
                <label class="form-label"></label>
                <input type="submit" id="send" class="btn btn-success w-100" name="submit" value="Submit" />
            </div>
        </div>

        <!-- Show Data in table -->
        <div class="row my-3">
            <div class="col-md-6">
                <h3 class=" p-1 mb-2">View All <span class="text-success"> User</span></h3>
                <hr>
            </div>
            <div class="col-md-6">
            <input type="text" id="searchInput" placeholder="Type to search" class="form-control w-100"/>
            <hr>
            </div>
            <div class="col-md-12" id="table-data">

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <input type="hidden" id="item_id" value="" />
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editfname" placeholder="Enter Here" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editlname" placeholder="Enter Here" required autocomplete="off">
                        </div>
                        <div class="alert alert-success" style="display: none" ; id="messages"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete modal -->
        <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <h5>Are You Sure! You Want to Delete?</h5>
                        </div>
                        <div class="alert alert-success" style="display: none" ; id="messages"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" id="deleteBtn">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- js links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./jquery/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {

                // insert data function 
                function loadData(query = null) {
                    // send data on insert qry page
                    $.ajax({
                        url: "./show-data-query.php",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(response) {
                            $('#table-data').html(response)
                        }
                    })


                }

                    loadData();

                    var btn = $("#send");

                    // insert data function 
                    btn.click(function() {
                        var fname = $("#fname").val();
                        var lname = $("#lname").val();

                        // send data on insert qry page
                        $.ajax({
                            url: "./insert-qry.php",
                            type: "POST",
                            data: {
                                firstName: fname,
                                lastName: lname
                            },
                            success: function(response) {
                                alert(response);
                                $("#fname").val("");
                                $("#lname").val("");
                                loadData();
                            }
                        })
                    })


                    // edit data function 
                    $(document).on("click", '.editBtn', function() {
                        let id = $(this).data('id');
                        $.ajax({
                            url: "./edit.php",
                            type: "GET",
                            data: {
                                id: id
                            },
                            success: function(response) {
                                console.log(response);
                                let data = JSON.parse(response);
                                $("#editfname").val(data.fname);
                                $("#editlname").val(data.lname);
                                $("#item_id").val(data.id);
                                $("#modal").modal("show");

                                }
                            })

                        })

                        //update item
                        $("#updateBtn").on("click",  function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: "./update.php",
                                type: "POST",
                                data: {
                                    fname: $("#editfname").val(),
                                    lname: $("#editlname").val(),
                                    id: $("#item_id").val()
                                },
                                success: function(res) {

                                    $("#messages").html(res).show();
                                    setTimeout(() => {
                                        $("#messages").hide();
                                        $("#modal").modal("hide");
                                    }, 2000)
                                    loadData();
                                }
                            })
                        })


                        //Search section
                    $("#searchInput").on("keyup" , function() {
                         var value = $(this).val().toLowerCase();
                         if(value.length > 2){
                            loadData(value);
                         }
                         else{
                            loadData();
                         }


                         
                         // Delete data function 
                    $(document).on("click", '.deletebtn', function() {
                        let del_id = $(this).data('id');
                        $.ajax({
                            url: "./delete.php",
                            type: "POST",
                            data: {
                                id: del_id
                            },
                            success: function() {
                                $("#deletemodal").modal("show");
                                loadData();
                                }
                            })

                        })

                    });
            // hide modal event
            // const myModalEl = document.getElementById('#modal')
            // myModalEl.addEventListener('hidden.bs.modal', event => {
            //     loadData();
            // })

         })
    </script>

</body>

</html>