<?php 
    include_once '../includes/autoload.inc.php';
    $userView = new Userview();
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <script src='https://kit.fontawesome.com/0c735a34da.js' crossorigin='anonymous'></script>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>
    <link rel='stylesheet' href='../scss/main.css'>
    <link rel='stylesheet' href='about.css'>
</head>
<body>

    <div id='vue-app'>
        <nav>
            <div id='left'>
                <i class='fas fa-home'></i>
                <h4 v-on:click='goHome'>Home</h4>
                <h4>About</h4>
                <h4 @click="goToFeaturedListings">Featured Listing</h4>
            </div>
            <div id='right'>
                <?php
                    session_start();
                    if(isset($_SESSION['username'])){
                        echo '<useregistered></useregistered>';
                        echo '<logout></logout>';
                    }else{
                        echo '<register></register>';
                        echo '<login></login>';
                    }
                ?>
            </div>
        </nav>
        <div id='welcomer'>
            <div id='underlay'>
                <h2 class='text-center'>About Bt Real Estate</h2>
                <p class='text-center'>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi, aspernatur.</p>
            </div>
        </div>
        <div id='information'>
            <div id='about_us'>
                <h2>We Search For The Perfect Home</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, quis.</p>
                <img src='../img/image1.jpg' alt='about us image'>
                <p id='details_about_us'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi at et quasi autem incidunt, enim animi, corrupti necessitatibus consequatur recusandae sit repudiandae repellendus ratione, vero in. Enim, sunt. Ea aliquid dolor nemo corrupti nam rerum? Consequatur ipsa officia ullam excepturi, eos deleniti molestiae tempora laboriosam accusamus, quae, alias nobis nemo?</p>
            </div>
            <div id='saler_of_month'>

                <?php 
                    //select the mvp from the db
                    $realtor_mvp = $userView->get_mvp_realtor();     
                    print_r($realtor_mvp);           
                ?>
            </div>
        </div>
        <div id='we_work_for_you'>
            <h2>We Work For You</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora laudantium, assumenda consequatur quasi eveniet quia.</p>
            <button class='btn btn-success'>View Our Featured Listings</button>
        </div>
        <!--Display All Realtors-->
        <div id="team">
            <h2 class='text-center' id='our_team'>Our Team</h2>
            <div id='realtors'>
                <?php 
                    //load all realtors
                    $realtors = $userView->getRealtors();
                    for($i = 0;$i<sizeof($realtors); $i++){
                        //get the email img and name of the realtor
                        $name = $realtors[$i]['username'];
                        $email = $realtors[$i]['email'];
                        $img = $realtors[$i]['image_profile'];
                        echo "
                        <div id='realtor'>
                            <img id='realtors_img' src='../img/$img' alt='Realtors image'>
                            <h6>$name</h6>
                            <div>
                                <i id='i_reward' class='fas fa-award'></i>
                                <p>Realtor</p>
                            </div>
                            <div>
                                <i id='i_envelope' class='fas fa-envelope-open'></i>
                                <p>$email</p>
                            </div>
                        </div>
                        ";

                    }
                ?>

            </div>
        </div>
        <div id="footer">
            <p>Copyright &copy; StevenInc</p>
        </div>

    </div>



    <script src='https://cdn.jsdelivr.net/npm/vue@2.6.11'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js' integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='aboutUs.js'></script>
</body>
</html>