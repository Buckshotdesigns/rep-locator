<?php
/*
Plugin Name: Rep Locator
Plugin URI: https://www.fsm.agency
Description: This plugin provides a Rep Locator interface for Lauren Illumination
Version: 1.0
Author: Bryan Buckus, Andrew Husted
License: GPLv2
*/


// create the shortcode [li-rep-locator]

function wpse_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style', $plugin_url . '/my-style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin_css' );

add_shortcode( 'li_rep_locator', 'li_rep_locator_function' );
function li_rep_locator_function( ) {
    ?>
 
    ​<div id="form-div-input">
    <form action=""  method="post">
        
    <p id= "state-tag">State:</p><select name=state_side>
        <option disabled selected value> -- select an option -- </option>
        <option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">Dispict Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
        </select>
    <br>
    <br>

    County:<input type="text" name=county><br>
    <p class="invalid"></p>
    <input id="submit-button" type="submit" value="submit" name="submit">

    </form>
    </div>

<?php
        
    global $wpdb;

    $state_side = $_POST["state_side"];
    $county = $_POST["county"];
    $submit = $_POST["submit"];
  
    if ((!$state_side) &&(!$county) && ($submit) ){
    echo "<p class='invalid'> please enter both fields </p>";
    } if (($state_side) && (!$county) && ($submit)) {
        echo "<p class='invalid'> Please enter the county</p>";
    } if ((!$state_side) && ($county) && ($submit)) {
        echo $countyError = "Please enter the state";
    }if (($state_side) && ($county) && ($submit)){

        $reps = $wpdb->get_results("SELECT * FROM rep WHERE state_side = '$state_side' AND county = '$county' limit 10");
        if (empty($reps)) {
            echo "<p class='invalid'>contact for reps</p>";
        } else {
            echo "<div id='results-container'>";
            foreach($reps as $reps){
            echo "<p>";
            echo "<p>".$reps->Contact."</p>";
            echo "<p>".$reps->Rep_Name."</p>";
            echo "<p>".$reps->Location."</p>";
            echo "<p>".$reps->Email."</p>";
            echo "<p>".$reps->Phone."</p>";
            echo "<p>".$reps->Website."</p>";
            echo "<p>".$reps->State_side."</p>";
            echo "<p>".$reps->County."</p>";
            echo "</p>";
            }
            echo "</div>";
        }
    }  
    
}


