<?php
	session_start();
	if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer']))
	{   unset($_SESSION['auth_user']);
		header("Location:../admin/input.php");
	}    
	else
    $current_page = basename($_SERVER['PHP_SELF'], ".php");
    $arr = get_defined_vars();
      //  echo '<p>👤 Вітаємо, <strong>' . htmlspecialchars($_SESSION['login']) . '</strong>!</p>';

	echo '
	 <!-- Admin Menu -->
      
        <nav class="navbar navbar-expand-md border-1 border-info justify-content-center shadow" style="background-color: #256279;">
            <div class="nav nav-underline d-flex  fw-bolder fs-3 ">
                <a class=" fs-1 d-flex align-items-center "   href="../admin/admin_panel.php" style=" color: #e3e9ed">єСтудент</a>
                
                <button class="navbar-toggler  justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse text-light" id="navbarNavDropdown" >
                <ul class="navbar-nav" >

                    <li class="nav-item p-2" >
                    <a style="color: #92e2f5" class="text-center nav-link ' . ($current_page == 'admin_panel' ? 'active' : '') . '"  aria-current="page" href="../admin/admin_panel.php">Головна</a>
                    </li>

<!------------------------------------------------------------->
                    <li class="nav-item dropdown p-2 ">
                    <a class="text-center nav-link ' . (in_array($current_page, ['filter_group', 'add_group']) ? 'active' : '') . '"  style="color: #92e2f5" class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Групи
                    </a>
                        <ul class="dropdown-menu border-2 shadow-lg" style="background-color: #C8D8E7; border-color:#256279 ;">
                            <li>
                                <a href="filter_group.php">Список груп</a>
                            </li>


                            ';

                            if (in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
                                echo '
                            <li><hr class="dropdown-divider border-1 border-info"></li>
                            <li>
                                <a href="add_group.php">Додати групу</a>
                            </li>
                                ';
                            }
                            
                            echo '
                            

                        </ul>
                    </li>
<!------------------------------------------------------------->
                    <li class="nav-item dropdown p-2">
                    <a class="text-center nav-link ' . (in_array($current_page, ['filter_student', 'abc_student','add_student' ]) ? 'active' : '') . '"  style="color: #92e2f5" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Студенти
                    </a>
                    <ul class="dropdown-menu border-2 shadow-lg" style="background-color: #C8D8E7; border-color:#256279 ;">

                                        
                          	<li>
                               <a href="filter_student.php">Розширена фільтрація</a>
                           </li>
                                                <li><hr class="dropdown-divider border-1 border-info"></li>
        					<li>
                               <a href="abc_student.php">Алфавітний список</a>
                           </li>
                             <li><hr class="dropdown-divider border-1 border-info"></li>
                           <li>
                               <a href="student_statistc.php    ">Статистика</a>
                           </li>

                            ';

                            if (in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
                                echo '
                                <li><hr class="dropdown-divider border-1 border-info "></li>

                                <li>
                                    <a href="add_student.php">Додати студентів</a>
                                </li>
                                ';
                            }
                            
                            echo '

                                        
                    </ul>
                    </li>
<!------------------------------------------------------------->



                            ';

                            if (in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
                                echo '
              <li class="nav-item dropdown p-2">
                    <a class="text-center nav-link ' . (in_array($current_page, ['filter_spec', 'edit_spec','add_spec' ]) ? 'active' : '') . '"  style="color: #92e2f5" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Спеціальності
                    </a>
                    <ul class="dropdown-menu border-2 shadow-lg" style="background-color: #C8D8E7; border-color:#256279 ;">

                                        
                          	<li>
                               <a href="filter_spec.php">Список спеціальностей</a>
                           </li>
                            <li><hr class="dropdown-divider border-1 border-info"></li>
        					<li>



                                <li>
                                    <a href="add_spec.php">Додати спеціальність</a>
                                </li>
                                                            
                    </ul>
                    </li>
                                ';
                            }
                            
                            echo '
<!------------------------------------------------------------->

                             ';
                            if (in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
                                echo '
              <li class="nav-item dropdown p-2">
                    <a class="text-center nav-link ' . (in_array($current_page, ['filter_old_student', 'filter_old_group','' ]) ? 'active' : '') . '"  style="color: #92e2f5" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Історія
                    </a>
                    <ul class="dropdown-menu border-2 shadow-lg" style="background-color: #C8D8E7; border-color:#256279 ;">

                                        
                          	<li>
                               <a href="filter_old_student.php">Список студентів</a>
                           </li>
                                                <li><hr class="dropdown-divider border-1 border-info"></li>
        					

                                    

                                <li>
                                    <a href="filter_old_group.php">Список груп</a>
                                </li>
                                                            
                    </ul>
                    </li>
                                ';
                            }
                            
                            echo '
                            
<!------------------------------------------------------------->
                    ';

                    if ($_SESSION["auth_user"] == "admin") {
                        echo '
                        <li class="nav-item dropdown p-2">
                        <a class="text-center nav-link ' . (in_array($current_page, ["list_users", "add_user"]) ? "active" : "") . '" 
                            style="color: #92e2f5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Користувачі
                        </a>
                        <ul class="dropdown-menu border-2 shadow-lg" style="background-color: #C8D8E7; border-color:#256279;">
                            <li><a href="list_users.php">Користувачі</a></li>
                            <li><hr class="dropdown-divider border-1 border-info"></li>
                            <li><a href="add_user.php">Додати користувача</a></li>
                        </ul>
                        </li>';
                    }
                    

                    echo '
                    <li class="nav-item p-2 d-flex justify-content-center" >
                    <a style="color: #e6633b" class="nav-link" aria-current="page" href="logout.php">Вихід 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                    </a>
   
                    </li>
                    
                    
                </ul>

                
                </div>
            </div>
        </nav>
        


        <!-- 
            <div id="hornav" class="bottom-border-shadow" style="height:40px">
                <div class="container no-padding border-bottom">
                    <div class="row">
                        <div class="col-sm 10 no-padding">
                            <div class="visible-lg">
                                <ul id="hornavmenu" class="nav navbar-nav">
                                     <li>
                                        <a href="../admin/admin_panel.php" class="fa-home active">Головна</a>
                                    </li>
                                    <li>
										<span class="fa-cubes ">Групи</span></a>
                                        <ul>
                                            <li>
                                                <a href="filter_group.php">Список груп</a>
                                            </li>
											<li>
                                                <a href="add_group.php">Додати групу</a>
                                            </li>
										</ul>
								    <li>
                                        <span class="fa-briefcase ">Студенти</span>
                                        <ul>
                                           	<li>
                                                <a href="filter_student.php">Розширена фільтрація</a>
                                            </li>
											<li>
                                                <a href="abc_student.php">Алфавітний список</a>
                                            </li>
                                            <li>
                                                <a href="add_student.php">Додати студентів</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
									<span class="fa fa-user">Користувачі</span>
                                        <ul>
                                            <li>
                                                <a href="list_users.php">Список користувачів</a>
                                            </li>
											<li>
                                                <a href="add_user.php">Додати користувача</a>
                                            </li>
											
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
     
                    </div>
                </div>
            </div>
            -->
            <!-- End Admin Menu -->
	'
?>