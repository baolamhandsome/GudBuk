<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
        <link rel="stylesheet" href="/GudBuk/public/css/profile.css">
        <title>Gudbuk | Profile</title>
    </head>
    <body>
    <div class="profile-container">
        <h2 class="title">Account Information</h2>
        <div class="icon-wrapper">
            <i id="profile-icon" class="fa-regular fa-circle-user"></i>
        </div>
        <div class="user-info">
            <div class="info-field">
                <label>Name</label>
                <p><?php echo $data['name'];?></p>
            </div>
            <div class="info-field">
                <label>Email</label>
                <p>1234@gmail.com</p>
            </div>
            <div class="info-field">
                <label>Phone Number</label>
                <p>0123456789</p>
            </div>
            <div class="info-field">
                <label>Address</label>
                <p>Montreal, Québec, Canada</p>
            </div>
            <button class="edit-profile">
                <span class="btn-text">Edit Profile</span>
                <span class="btn-loader"></span>
            </button>
        </div>
    </div>
    </body>
</html>


