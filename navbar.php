<!-- navbar.php -->
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
                                <li><a href="#">Common NavBar</a></li>
                            </ul>                
                        </li>
                        <li><a href="#">Week 4</a></li>
                    </ul>
            </li>
            <li><a href="https://github.com/NeilsBored/CPSC3750">Github Link</a></li>
            <li><a href="mailto:shanej@clemson.edu">Send Feedback</a></li>
        </ul>
    </div>
    </div>
</nav>