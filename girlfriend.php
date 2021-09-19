<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Girlfriend
 * Plugin URI:        https://github.com/dasithsv/girlfriend-wp
 * Description:       Now you can add girlfriend to your website :) also easily configure by editing the json file 
 * Version:           1.0.1
 * Author:            dasith
 * Author URI:        https://dasith.works
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       add a girlfriend for your site :) 
**/

// shortcode to create the girlfriend addmygirl 
//define( 'myplugindir', add_the_girl_friend_for_the_website_shortcode( __FILE__ ));

function add_the_girl_friend_for_the_website_shortcode()
{

    $content = '<link rel="stylesheet" href="/wp-content/plugins/girlfriend/live2d/css/live2d.css"/>';
    $content .= ' <div id="landlord">
    <div class="message" style="opacity:0"></div>
    <canvas id="live2d" width="280" height="250" class="live2d"></canvas>
    <div class="hide-button">Hide</div>
  </div>';

    $content .= ' <script src="https://cdn.jsdelivr.net/npm/jquery@3.5/dist/jquery.min.js"></script>';
    $content .= '<script type="text/javascript">';

    $content .= 'var message_Path ="/wp-content/plugins/girlfriend/live2d/"';

    $content .= 'var home_Path = "https://dasith.works/"
        </script>';
    $content .= '<script type="text/javascript" src="/wp-content/plugins/girlfriend/live2d/js/live2d.js"></script>';

    $content .=' <script type="text/javascript" src="/wp-content/plugins/girlfriend/live2d/js/message.js"></script>
        <script type="text/javascript">
        loadlive2d("live2d", "/wp-content/plugins/girlfriend/live2d/model/tia/model.json");
        </script>';

    return $content;
}

//add_action('the_content', 'add_the_girl_friend_for_the_website');
//add_shortcode('addmygirl','display_my_girlfriend_on_the_pages');
//add_filter( 'the_content', 'add-the-girl-friend-for-the-website', 1 );

function display_my_girlfriend_on_the_pages( $content ) {
        $content .= '<link rel="stylesheet" href="/wp-content/plugins/girlfriend/live2d/css/live2d.css"/>';
        $content .= '   <div id="landlord">
        <div class="message" style="opacity: 1; z-index: 9999;">welcome!</div>
        <canvas id="live2d" width="280" height="250" class="live2d"></canvas>
        <div class="hide-button">Hide</div>
      </div>';
    
        $content .= '<script src="https://cdn.jsdelivr.net/npm/jquery@3.5/dist/jquery.min.js"></script>';
        $content .= '<script type="text/javascript">';
        $content .= 'var message_Path ="/wp-content/plugins/girlfriend/live2d/"';
        $content .= 'var home_Path = "https://dasith.works/" 
        </script>';
        $content .= '<script type="text/javascript" src="/wp-content/plugins/girlfriend/live2d/js/live2d.js"></script>';
    
        $content .='<script type="text/javascript" src="/wp-content/plugins/girlfriend/live2d/js/message.js"></script>
            <script type="text/javascript">
             loadlive2d("live2d", "/wp-content/plugins/girlfriend/live2d/model/tia/model.json");
            </script>';
  
      return $content;
}

add_filter( 'the_content', 'display_my_girlfriend_on_the_pages' );
add_shortcode('addmygirl','add_the_girl_friend_for_the_website_shortcode');



function girlfriend_admin_menu()
{
    add_menu_page('Girlfriend Dashboard Stuff','Girlfriend','manage_options','girlfriend-admin-menu','girlfriend_modeljson_page','',200);
}

add_action('admin_menu', 'girlfriend_admin_menu');

// the admin funtion 
function girlfriend_modeljson_page()
{
    ?>

    <style>
        #myModal{
            z-index: 999999999999;
        }
        /* The Modal (background) */
        .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        }

        /* The Close Button */
        .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }

    </style>
    <div class="wrap">
      <link rel="stylesheet" href="/wp-content/plugins/girlfriend/panel/style.css">
            <!-- partial:index.partial.html -->
            <div class="card-for-girl" >
            <div class="card-body-for-girlfirend">
                <h1>Play with Your Girlfriend :) </h1>
                <button id="myBtn">Read More Info</button>
                <p class="lead">You can update the message.json file to add more cute things to your girlfriend (please click on load file and first load the file contents before you start editing) 
                <br>if you have no idea how to configure this please have a look at out readme/ docs its pretty easy dont worry :) <a href="#"> docs</a></p>

                <div class="form-group">
                <div id="editorWrapper">
                    <div id="editor"></div>
                </div>
                </div>


                <div class="row">
                <div class="col-md-6"><a class="btn" id="minify">update</a></div>
                <div class="col-md-6"><a class="btn" id="beautify">Beautify</a></div>
                <div class="col-md-6"><a class="btn" id="loadfile">Load the File </a></div>
                
     
                </div>
            </div>

            <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close">&times;</span>
  <h3> Some information about How to configure </h3> 
  
<ul>
  <li> You can Add the css class name to the selector and whenever that class is hoverd the content in that class will sayid by the girlfriend ( you can add more text to 'text' object and those text will also append by the girl friend </li>
  
  <li> before you modify please remember to load the file or else you might overwrite your message.json file </li>
  
  <li> if you are facing any bugs please contact us <a href="https://github.com/dasithsv/girlfriend-wp/"> repo </a> </li> 
  
  <li> if you like to contribute the project please feel free to do so. I'm thinking about adding more cool stuff to the model :) if you can help me with that I highly appriciate. </li>
  
  <li> if you are facing any bugs Please feel free to reach to us :) </li> 
  
  <li> the model might not support to some pages. in a situation like that we have provided something really cool! we added a shortcode so you can add the short code to those pages so that it will show up :) generally model will work in lot of pages but if you want to add the short code use <code> addmygirl </code> 
  
  <li> <a href="https://github.com/dasithsv/girlfriend-wp/"> our git repo </a> </li>
  
  
  </ul>
  
</div>

</div>

            </div>

            <script>
                // Get the modal
                var modal = document.getElementById("myModal");

                // Get the button that opens the modal
                var btn = document.getElementById("myBtn");

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks the button, open the modal 
                btn.onclick = function() {
                modal.style.display = "block";
                }

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                modal.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                }
                </script>

                
            <!-- partial -->
            <script src='https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js'></script><script  src="/wp-content/plugins/girlfriend/panel/script.js"></script>

           
    </div>	
    <?php
}

?>