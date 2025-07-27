<!--
  File: navbar.php
  Author: Shane John
  Date: 2025-05-10
  Course: CPSC 3750 – Web Application Development
  Purpose: Common Navigation Bar 
  Notes: Meant to be be portable to every page in the site.
-->
<?php $BASE_PATH = '/'; ?>
  
<nav style="top:0px; width:100%;">
    <input type="checkbox" id="show-menu">
    <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
    <div class="content">
    <div class="logo"><a href="<?= $BASE_PATH ?>index.php">ShaneJohn.com</a></div>
        <ul class="links">
            <li><a href="<?= $BASE_PATH ?>index.php">Home</a></li>
            <li><a href="<?= $BASE_PATH ?>about/about.php">About</a></li>
            <li><a href="#" class="desktop-link">Assignments</a>
                <input type="checkbox" id="show-assignments">
                <label for="show-assignments">Assignments</label>
                    <ul>
                        <li>
                            <a href="#" class="desktop-link">Week 2</a>
                            <input type="checkbox" id="show-week2">
                            <label for="show-week2">Week 2</label>
                            <ul><li><a href="<?= $BASE_PATH ?>assignments/week2/group_CSS/GroupCSS1.php">Group: CSS</a></li>
                                <li><a href="<?= $BASE_PATH ?>assignments/week2/critic_corner/page1.php">Demo HTML & CSS</a></li>
                                <li><a href="<?= $BASE_PATH ?>assignments/week2/hybrid_layout/layout.php">Hybrid Layout</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="desktop-link">Week 3</a>
                            <input type="checkbox" id="show-week3">
                            <label for="show-week3">Week 3</label>
                            <ul>
                                <li><a href="#">Javascript Events</a></li>
                                <li><a href="#">PHP Helloworld</a></li>
                                <li><a href="#">Group: More CSS</a></li>
                            </ul>                
                        </li>
                        <li><a href="#" class="desktop-link">Week 4</a>
                            <input type="checkbox" id="show-week4">
                            <label for="show-week4">Week 4</label>
                            <ul>
                                <li><a href="#">Moving Buttons</a></li>
                                <li><a href="#">Javascript Sort</a></li>
                                <li><a href="<?= $BASE_PATH ?>index.php">Main Page</a></li>
                            </ul>                
                        </li>
                        <li><a href="#" class="desktop-link">Week 5</a>
                            <input type="checkbox" id="show-week5">
                            <label for="show-week5">Week 5</label>
                            <ul>
                                <li><a href="<?= $BASE_PATH ?>assignments/week5/card_object/cards.php">Card Object</a></li>
                                <li><a href="<?= $BASE_PATH ?>assignments/week5/group_events/events.php">Group: Events</a></li>
                            </ul>                
                        </li>
                        <li><a href="#" class="desktop-link">Week 7</a>
                            <input type="checkbox" id="show-week7">
                            <label for="show-week7">Week 7</label>
                            <ul>
                                <li><a href="<?= $BASE_PATH ?>assignments/week7/key_press/KeyPress.php">Key Press</a></li>
                                <li><a href="<?= $BASE_PATH ?>assignments/week7/j_query/jQuery.php">jQuery</a></li>
                                <li><a href="<?= $BASE_PATH ?>assignments/week7/group_audio/GroupAudio.php">Group: Audio</a></li>
                            </ul>                
                        </li>
                        <li><a href="#" class="desktop-link">Week 8</a>
                            <input type="checkbox" id="show-week8">
                            <label for="show-week8">Week 8</label>
                            <ul>
                                <li><a href="<?= $BASE_PATH ?>assignments/week8/ajax_php/livesearch.php">Ajax PHP</a></li>
                                <li><a href="<?= $BASE_PATH ?>assignments/week8/group_hangman/hangman.php">Group: Hangman</a></li>
                            </ul>                
                        </li>
                        <li><a href="#" class="desktop-link">Week 9</a>
                            <input type="checkbox" id="show-week9">
                            <label for="show-week9">Week 9</label>
                            <ul>
                                <li><a href="<?= $BASE_PATH ?>assignments/week9/ajax_handlebars/ajaxHandlebars.php">AJAX-Handlebars</a></li>
                                <li><a href="<?= $BASE_PATH ?>assignments/week9/php_file_app/fileApp.php">PHP File I/O App</a></li>
                                <li><a href="<?= $BASE_PATH ?>assignments/week9/group_forms/forms.php">Group: Forms</a></li>
                                <li><a href="<?= $BASE_PATH ?>assignments/week9/group_sessions/carSelection.php">Group: Sessions</a></li>
                            </ul>                
                        </li>
                        <li><a href="#" class="desktop-link">Week 10</a>
                            <input type="checkbox" id="show-week10">
                            <label for="show-week10">Week 10</label>
                            <ul>
                                <li><a href="<?= $BASE_PATH ?>assignments/week10/group_zipcodes/zipcodes_viewControl.php">Group: Zipcode Distance</a></li>
                            </ul>                
                        </li>
                        <li><a href="#" class="desktop-link">Week 11</a>
                            <input type="checkbox" id="show-week11">
                            <label for="show-week10">Week 11</label>
                            <ul>
                                <li><a href="<?= $BASE_PATH ?>assignments/week11/db_integrate/insert_form.php">CREATE DB</a></li>
                            </ul>                
                        </li>
                    </ul>
            </li>
            <li><a href="<?= $BASE_PATH ?>program_exams/exam_one/prime.html">Exam #1</a></li>
            <li><a href="<?= $BASE_PATH ?>program_exams/exam_two/vowels.php">Exam #2</a></li>
            <li><a href="<?= $BASE_PATH ?>audio_demo/AudioDemo.php">Audio Demo</a></li>
            <li><a href="https://github.com/NeilsBored/CPSC3750">Github Repo</a></li>
            <li><a href="mailto:shanej@clemson.edu">Email Shane</a></li>
        </ul>
    </div>
    </div>
</nav>