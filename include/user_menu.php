<?php
	session_start();
	if ($_SESSION['auth_user']!="user")
	{   unset($_SESSION['auth_user']);
		header("Location:../admin/input.php");
	}    
	else
	echo '
	 <!-- User Menu -->
            <div id="hornav" class="bottom-border-shadow" style="height:40px">
                <div class="container no-padding border-bottom">
                    <div class="row">
                        <div class="col-sm 10 no-padding">
                            <div class="visible-lg">
                                <ul id="hornavmenu" class="nav navbar-nav">
                                    <li>
                                        <a href="../index.php" class="fa-home active">Головна</a>
                                    </li>
                                    <li>
                                         <a href="features-typo-basic.html">
										<span class="fa-cubes ">Групи</span></a>
                                        <ul>
                                            <li>
                                                <a href="filter_group.php">Список груп</a>
                                            </li>
										</ul>
								    <li>
                                        <span class="fa-briefcase ">Студенти</span>
                                        <ul>
                                            <li>
                                                <a href="statistc.php">Зведена статистика</a>
                                            </li>
											<li>
                                                <a href="filter_student.php">Розширена фільтрація</a>
                                            </li>
											<li>
                                                <a href="abc_student.php">Алфавітний список</a>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="../index.php" class="fa-comment ">Контакти</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                      <!--   <div class="col-md-2 no-padding">
                            <ul class="social-icons pull-right">
                                <li class="social-facebook">
                                    <a href="#" target="_blank" title="Facebook"></a>
                                </li>
                                <li class="social-googleplus">
                                    <a href="#" target="_blank" title="Google+"></a>
                                </li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
            <!-- End User Menu -->
	'
?>