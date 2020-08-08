<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/0c735a34da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="maincont.css">
    <link rel="stylesheet" href="../scss/main.css">
</head>
<body>

    <div id="vue-app">
        <nav>
            <div id='left'>
                <i class="fas fa-home"></i>
                <h4>Home</h4>
                <h4 @click="goToAbout">About</h4>
                <h4 v-on:click="gotoalllistings">Featured Listing</h4>
            </div>
            <div id="right">
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
        <div id="search_engine">
            <div id="searchBox">
                    <div id="description">
                        <h2>Property Searching Just Got So Easy</h2>
                        <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt blanditiis doloribus voluptatum eligendi earum, excepturi fugit saepe. Modi.</h6>
                    </div>
                    <div id="search-fields">
                        
                        <div id="inputs">
                            <select  v-model="bathrooms" class="col-5" name="Bathrooms">
                                <option value="1">Bathrooms</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="30000000000">More...</option>
                            </select>
                            <input class="col-3" type="text" placeholder="State" v-model="state">
                            <input class="col-3" type="text" placeholder="City" v-model="city">
                        </div>
                        <div id="inputs">
                            <select class="col-5" name="Bedrooms" v-model="bedrooms">
                                <option value="1">Bedrooms</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="30000000000">More...</option>
                            </select>
                            <select class="col-5" name="price" v-model="propertie_price">
                                <option value="100000">100000$</option>
                                <option value="200000">200000$</option>
                                <option value="300000">300000$</option>
                                <option value="400000">400000$</option>
                                <option value="500000">500000$</option>
                                <option value="600000">600000$</option>
                                <option value="700000">700000$</option>
                                <option value="800000">800000$</option>
                                <option value="30000000000">More...</option>
                            </select>
                        </div>
                        <div id="submit-form">
                            <button @click.prevent="filterProperties" class="btn btn-success col-10">Submit Form</button>
                        </div>
            </div>
                
            <h2 id="contentHeader" class="text-center">Latest Listings</h2>
            
            
            <div id="container">
                <div style="top: 800px; min-height: 800px" id="listings">
                        <?php include 'latestThree.php' ?>
                </div>
                <div id="sub-footer">
                    <div id="underlay">
                        <div id='services'>
                            <i class="fas fa-comment"></i>
                            <div>
                                <h4>Consulting Services</h4>
                                <div id="line"></div>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe esse obcaecati neque debitis tenetur iste libero veniam quibusdam tempora ex.</p>
                            </div>
                        </div>
                        <div id='services'>
                            <i class="fas fa-home"></i>
                            <div>
                                <h4>Property Management</h4>
                                <div id="line"></div>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe esse obcaecati neque debitis tenetur iste libero veniam quibusdam tempora ex.</p>
                            </div>
                        </div>
                        <div id='services'>
                            <i class="fas fa-suitcase"></i>
                            <div>
                                <h4>Renting and Selling</h4>
                                <div id="line"></div>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe esse obcaecati neque debitis tenetur iste libero veniam quibusdam tempora ex.</p>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div id="footer">
                    <p>Copyright &copy; StevenInc</p>
                </div>
            </div>

            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="main.js"></script>
</body>
</html>