<?php
// Initialize variables to avoid potential undefined variable errors
$id = $roll = $firstname = $middlename = $lastname = $gender = $dob = $contact = $present_address = $permanent_address = $voter_registrations = '';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM `student_list` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $roll = $row['roll'];
        $firstname = $row['firstname'];
        $middlename = $row['middlename'];
        $lastname = $row['lastname'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $contact = $row['contact'];
        $present_address = $row['present_address'];
        $permanent_address = $row['permanent_address'];
        $voter_registration = $row['voter_registration'];
    }
    $stmt->close();
}
?>

<div class="content py-3">
    <div class="card card-outline card-primary shadow rounded-0">
        <div class="card-header">
            <h3 class="card-title"><b><?= isset($id) ? "Update Student Details - ". htmlspecialchars($roll) : "New Student" ?></b></h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="classes/Master.php?f=save_student" id="student_form" method="POST">
                    <input type="hidden" name="id" value="<?= isset($id) ? htmlspecialchars($id) : '' ?>">
                    <fieldset class="border-bottom">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="roll" class="control-label">Birth Place</label>
                                <input type="text" name="roll" id="roll" autofocus value="<?= isset($roll) ? htmlspecialchars($roll) : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="firstname" class="control-label">First Name</label>
                                <input type="text" name="firstname" id="firstname" value="<?= isset($firstname) ? htmlspecialchars($firstname) : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middlename" class="control-label">Middle Name</label>
                                <input type="text" name="middlename" id="middlename" value="<?= isset($middlename) ? htmlspecialchars($middlename) : "" ?>" class="form-control form-control-sm rounded-0" placeholder='optional'>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastname" class="control-label">Last Name</label>
                                <input type="text" name="lastname" id="lastname" autofocus value="<?= isset($lastname) ? htmlspecialchars($lastname) : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="gender" class="control-label">Gender</label>
                                <select name="gender" id="gender" class="form-control form-control-sm rounded-0" required>
                                    <option value="Male" <?= isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dob" class="control-label">Date of Birth</label>
                                <input type="date" name="dob" id="dob" value="<?= isset($dob) ? $dob : "" ?>" class="form-control form-control-sm rounded-0" required>
                          </div>
                            <div class="form-group col-md-4">
                                <label for="contact" class="control-label">Contact #</label>
                                <input type="text" name="contact" id="contact" value="<?= isset($contact) ? $contact : "" ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="present_address" class="control-label">Present Address</label>
                                <textarea rows="3" name="present_address" id="present_address" class="form-control form-control-sm rounded-0" required><?= isset($present_address) ? htmlspecialchars($present_address) : "" ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="permanent_address" class="control-label">Permanent Address</label>
                                <textarea rows="3" name="permanent_address" id="permanent_address" class="form-control form-control-sm rounded-0" required><?= isset($permanent_address) ? htmlspecialchars($permanent_address) : "" ?></textarea>
                            </div>
                   <div class="row">
    <div class="form-group col-md-4">
        <label for="voter_registration" class="control-label">Voter Registration</label>
        <div>
            <input type="checkbox" name="voter_registration" id="voter_registration" <?= isset($voter_registration) && $voter_registration == 'yes' ? 'Registered as Voter' : 'Not Registered' ?>
    
        </div>
    </div>
</div>

                    </fieldset>
                </form>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-flat btn-primary btn-sm" type="submit" form="student_form">Save Student Details</button>
            <a href="./?page=students" class="btn btn-flat btn-default border btn-sm">Cancel</a>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#student_form').submit(function(e){
            e.preventDefault();
            var _this = $(this);
            $('.pop-msg').remove();
            var el = $('<div>').addClass("pop-msg alert").hide();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_student",
                data: new FormData(_this[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                dataType: 'json',
                error: function(err) {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if(resp.status == 'success') {
                        location.href = "./?page=students/view_student&id=" + resp.sid;
                    } else if(resp.msg) {
                        el.addClass("alert-danger").text(resp.msg);
                        _this.prepend(el);
                    } else {
                        el.addClass("alert-danger").text("An error occurred due to an unknown reason.");
                        _this.prepend(el);
                    }
                    el.show('slow');
                    $('html,body,.modal').animate({scrollTop: 0}, 'fast');
                    end_loader();
                }
            });
        });
    });
</script>
