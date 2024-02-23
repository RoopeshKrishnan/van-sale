<style>
    .profile-pic-wrapper {
        /* hei ght: 100vh;
  w idth: 100%; */
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .pic-holder {
        text-align: center;
        position: relative;
        border-radius: 50%;
        width: 90px;
        height: 90px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 0 0 10px;
    }

    .pic-holder .pic {
        height: 100%;
        width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: center;
        object-position: center;
    }

    .pic-holder .upload-file-block,
    .pic-holder .upload-loader {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(90, 92, 105, 0.7);
        color: #f8f9fc;
        font-size: 12px;
        font-weight: 600;
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .pic-holder .upload-file-block {
        cursor: pointer;
    }

    .pic-holder:hover .upload-file-block,
    .uploadProfileInput:focus~.upload-file-block {
        opacity: 1;
    }

    .pic-holder.uploadInProgress .upload-file-block {
        display: none;
    }

    .pic-holder.uploadInProgress .upload-loader {
        opacity: 1;
    }

    /* Snackbar css */
    .snackbar {
        visibility: hidden;
        min-width: 250px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 14px;
        transform: translateX(-50%);
    }

    .snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }
</style>

<!-- <div class="container-fluid mt-4">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-8">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active  active " data-bs-toggle="tab"
                                    href=" " role="tab"
                                    aria-selected="true">
                                    Messages
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab"
                                    href=" " role="tab"
                                    aria-selected="false">
                                    Social
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab"
                                    href=" " role="tab"
                                    aria-selected="false">
                                    Notifications
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab"
                                    href=" " role="tab"
                                    aria-selected="false">
                                    Backup
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->

<div class="container-fluid my-3 py-3">
    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll href="#profile">
                            <i class="material-icons text-lg me-2">person</i>
                            <span class="text-sm">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll href="#basic-info">
                            <i class="material-icons text-lg me-2">receipt_long</i>
                            <span class="text-sm">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll href="#password">
                            <i class="material-icons text-lg me-2">lock</i>
                            <span class="text-sm">Change Password</span>
                        </a>
                    </li> 
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll href="#delete">
                            <i class="material-icons text-lg me-2">delete</i>
                            <span class="text-sm">Delete Account</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4">

            <div class="card card-body" id="profile">
                <div class="row    align-items-center">
                    <div class="col-sm-auto col-4">
                        <!-- <div class="avatar avatar-xl position-relative"> -->
                        <div class="profile-pic-wrapper">
                            <div class="pic-holder">
                                <!-- uploaded pic shown here -->
                                <img id="profilePic" class="pic" src="<?= base_url() ?>assets/img/avatar/user.png">

                                <Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
                                <label for="newProfilePhoto" class="upload-file-block m-0">
                                    <div class="text-center text-xxs">
                                        <div class="mb-2">
                                            <i class="fa fa-camera fa-2x"></i>
                                        </div>
                                        <div class="text-uppercase">
                                            Update <br /> Profile Photo
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                Richard Davis
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                               update your profile photo
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Basic Info</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="Alec">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="Thompson">
                            </div>
                        </div>
                    </div> 
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="example@email.com">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>Confirm Email</label>
                                <input type="email" class="form-control" placeholder="example@email.com">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>Your location</label>
                                <input type="text" class="form-control" placeholder="Sydney, A">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>Phone Number</label>
                                <input type="number" class="form-control" placeholder="+40 735 631 620">
                            </div>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="card mt-4" id="password">
                <div class="card-header">
                    <h5>Change Password</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Current password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="input-group input-group-outline my-4">
                        <label class="form-label">New password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="input-group input-group-outline">
                        <label class="form-label">Confirm New password</label>
                        <input type="password" class="form-control">
                    </div>
                    <h5 class="mt-5">Password requirements</h5>
                    <p class="text-muted mb-2">
                        Please follow this guide for a strong password:
                    </p>
                    <ul class="text-muted ps-4 mb-0 float-start">
                        <li>
                            <span class="text-sm">One special characters</span>
                        </li>
                        <li>
                            <span class="text-sm">Min 6 characters</span>
                        </li>
                        <li>
                            <span class="text-sm">One number (2 are recommended)</span>
                        </li>
                        <li>
                            <span class="text-sm">Change it often</span>
                        </li>
                    </ul>
                    <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update password</button>
                </div>
            </div> 

            <div class="card mt-4" id="delete">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-sm-0 mb-4">
                        <div class="w-50">
                            <h5>Delete Account</h5>
                            <p class="text-sm mb-0">Once you delete your account, there is no going back. Please
                                be certain.</p>
                        </div>
                        <div class="w-50 text-end">
                            <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button" name="button">Deactivate</button>
                            <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Delete
                                Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src="assets/js/plugins/choices.min.js"></script>


<script>
            $(document).on("change", ".uploadProfileInput", function () {
                var triggerInput = this;
                var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
                var holder = $(this).closest(".pic-holder");
                var wrapper = $(this).closest(".profile-pic-wrapper");
                $(wrapper).find('[role="alert"]').remove();
                triggerInput.blur();
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) {
                    return;
                }
                if (/^image/.test(files[0].type)) {
                    // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function () {
                        $(holder).addClass("uploadInProgress");
                        $(holder).find(".pic").attr("src", this.result);
                        $(holder).append(
                            '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
                        );

                        // Dummy timeout; call API or AJAX below
                        setTimeout(() => {
                            $(holder).removeClass("uploadInProgress");
                            $(holder).find(".upload-loader").remove();
                            // If upload successful
                            if (Math.random() < 0.9) {
                                $(wrapper).append(
                                    '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
                                );

                                // Clear input after upload
                                $(triggerInput).val("");

                                setTimeout(() => {
                                    $(wrapper).find('[role="alert"]').remove();
                                }, 3000);
                            } else {
                                $(holder).find(".pic").attr("src", currentImg);
                                $(wrapper).append(
                                    '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
                                );

                                // Clear input after upload
                                $(triggerInput).val("");
                                setTimeout(() => {
                                    $(wrapper).find('[role="alert"]').remove();
                                }, 3000);
                            }
                        }, 1500);
                    };
                } else {
                    $(wrapper).append(
                        '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
                    );
                    setTimeout(() => {
                        $(wrapper).find('role="alert"').remove();
                    }, 3000);
                }
            });
        </script>