<?php
/*
Auther: Shivanesh Lal 
Copy Right USP 2022
Date: 20 Aug 2022
*/

require_once('config.php');
require_once($CFG->libdir .'/filelib.php');
GLOBAL $USER, $DB;

echo $OUTPUT->header();
require_login();
$acc = array(60439,46718); //Add moodle user ID here to give access to this page! (TODO! this will be moved to capability section later.)
$u = $USER->id;

if(!in_array($u, $acc)) //check if user ID in array.
{
    redirect($CFG->wwwroot . '/?redirect=0'); //redirect to home page
}

//check if user is loggedin
if ((isloggedin()) && (in_array($u, $acc))){
    //echo "You are logged in as: ". $USER->firstname ." ". $USER->lastname;
    echo "This page returns user's enrolled courses.";
    echo '<br />';
    ?>
    
    <form class="form-group" name="getuser" method="post" action="get_user.php">
        <input type="text"  class="form-control" name="username" placeholder="Enter username:" required><br>
        <input type="submit" class="btn btn-info" name="submit" value="submit">
    </form> 
    <?php

    if(isset($_POST["submit"])){
        $uname = $_REQUEST[username];

        $sql = "SELECT u.id, u.firstname, u.lastname, u.email
                FROM {user} u
                        where u.username = '$uname'";

        $results = $DB->get_records_sql($sql);
        //echo var_dump($results);

        $obj = new stdClass(); //convert array response to array
        foreach ($results as $res => $usr){
            $obj->$res = $usr;
            echo "Checking for user: ". $usr->firstname . " ". $usr->lastname . " ". $usr->email . "<br><br>";
        }
        $n = $usr->id;

        //echo $n;
        //get users courses
        if($student_course_arry = enrol_get_users_courses($n, true, Null, 'visible ,sortorder DESC')){
            echo "<table>
            <tr>
            <th>Course Nane</th>
            <th>ShortCode</th>
            <th>user Role</th>
            </tr>";
            foreach($student_course_arry as $value){
                $context = context_course::instance($COURSE->id = $value->id);
                $roles = get_user_roles($context, $n, true);
                $role = key($roles);
                echo "<tr>";
                echo "<td>" . $value->fullname . "</td>";
                echo "<td>" . $value->shortname . "</td>";
                //echo "<td>" . $rolename . "</td>";
                echo "<td>" . $roles[$role]->name . "</td>"; // Get useres role
                echo "</tr>";
            }
	echo "</table>";
	echo "<br>";
       } else
       echo "No courses found for User:" . $usr->firstname . " ". $usr->lastname . " ". $usr->email;
    }
    echo $OUTPUT->footer();
   
} else 
echo "You Do Not have acces to this page. Please contact the site Admin!!";
header('Location: https://elearn.usp.ac.fj');
exit();
