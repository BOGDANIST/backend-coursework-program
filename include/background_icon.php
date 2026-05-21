<?php

	echo '
    
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
         <style>
    body {

      overflow-x: hidden;
      position: relative;
    }
    /* Контейнер для фонового оформлення іконок */
    .icon-container {
      padding: 500px;
      position: absolute;
      width: 90%;
      height: 90%;
      top: 0;
      left: 0;
      z-index: -1;
    }
    /* Стиль для кожної іконки */
    .edu-icon {
      position: absolute;
      opacity: 0.15;
      pointer-events: none; /* Іконки не перешкоджають клікам */
    }
  </style>

  <!-- Контейнер з фоновими іконками. Цей блок можна підключити на будь-якій сторінці -->
  <div class="icon-container">
    <!-- Додаємо декілька іконок з Bootstrap Icons -->
    <i class="bi bi-book edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-pencil-square edu-icon" style="font-size: 5rem;"></i>
    <i class="bi bi-mortarboard edu-icon" style="font-size: 4.5rem;"></i>
    <i class="bi bi-laptop edu-icon" style="font-size: 6rem;"></i>
    <i class="bi bi-journal-text edu-icon" style="font-size: 4.5rem;"></i>
    <i class="bi bi-calculator edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-lightbulb edu-icon" style="font-size: 5rem;"></i>
        <i class="bi bi-book edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-pencil-square edu-icon" style="font-size: 5rem;"></i>
    <i class="bi bi-mortarboard edu-icon" style="font-size: 3.5rem;"></i>
    <i class="bi bi-laptop edu-icon" style="font-size: 5rem;"></i>
    <i class="bi bi-journal-text edu-icon" style="font-size: 3.5rem;"></i>
    <i class="bi bi-calculator edu-icon" style="font-size: 5rem;"></i>
    <i class="bi bi-lightbulb edu-icon" style="font-size: 5rem;"></i>
        <i class="bi bi-book edu-icon" style="font-size: 2rem;"></i>
    <i class="bi bi-pencil-square edu-icon" style="font-size: 5rem;"></i>
    <i class="bi bi-mortarboard edu-icon" style="font-size: 3.5rem;"></i>
    <i class="bi bi-laptop edu-icon" style="font-size: 6rem;"></i>
    <i class="bi bi-journal-text edu-icon" style="font-size: 4.5rem;"></i>
    <i class="bi bi-calculator edu-icon" style="font-size: 3rem;"></i>
    <i class="bi bi-lightbulb edu-icon" style="font-size: 5rem;"></i>
        <i class="bi bi-book edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-pencil-square edu-icon" style="font-size: 5rem;"></i>
    <i class="bi bi-mortarboard edu-icon" style="font-size: 3.5rem;"></i>
    <i class="bi bi-laptop edu-icon" style="font-size: 2rem;"></i>
    <i class="bi bi-journal-text edu-icon" style="font-size: 2.5rem;"></i>
    <i class="bi bi-calculator edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-lightbulb edu-icon" style="font-size: 5rem;"></i>
        <i class="bi bi-book edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-pencil-square edu-icon" style="font-size: 2rem;"></i>
    <i class="bi bi-mortarboard edu-icon" style="font-size: 3.5rem;"></i>
    <i class="bi bi-laptop edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-journal-text edu-icon" style="font-size: 4.5rem;"></i>
    <i class="bi bi-calculator edu-icon" style="font-size: 3rem;"></i>
    <i class="bi bi-lightbulb edu-icon" style="font-size: 6rem;"></i>
            <i class="bi bi-book edu-icon" style="font-size: 2rem;"></i>
    <i class="bi bi-pencil-square edu-icon" style="font-size: 5rem;"></i>
    <i class="bi bi-mortarboard edu-icon" style="font-size: 3.5rem;"></i>
    <i class="bi bi-laptop edu-icon" style="font-size: 6rem;"></i>
    <i class="bi bi-journal-text edu-icon" style="font-size: 4.5rem;"></i>
    <i class="bi bi-calculator edu-icon" style="font-size: 3rem;"></i>
    <i class="bi bi-lightbulb edu-icon" style="font-size: 5rem;"></i>
        <i class="bi bi-book edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-pencil-square edu-icon" style="font-size: 5rem;"></i>
    <i class="bi bi-mortarboard edu-icon" style="font-size: 3.5rem;"></i>
    <i class="bi bi-laptop edu-icon" style="font-size: 2rem;"></i>
    <i class="bi bi-journal-text edu-icon" style="font-size: 2.5rem;"></i>
    <i class="bi bi-calculator edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-lightbulb edu-icon" style="font-size: 5rem;"></i>
        <i class="bi bi-book edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-pencil-square edu-icon" style="font-size: 2rem;"></i>
    <i class="bi bi-mortarboard edu-icon" style="font-size: 3.5rem;"></i>
    <i class="bi bi-laptop edu-icon" style="font-size: 4rem;"></i>
    <i class="bi bi-journal-text edu-icon" style="font-size: 4.5rem;"></i>
    <i class="bi bi-calculator edu-icon" style="font-size: 3rem;"></i>
    <i class="bi bi-lightbulb edu-icon" style="font-size: 6rem;"></i>
    
  </div>

    <!-- Скрипт для рандомного розміщення іконок -->
  <script>
    // Функція для встановлення рандомної позиції (у відсотках)
    function setRandomPosition(el) {
      const randomTop = Math.floor(Math.random() * 100);
      const randomLeft = Math.floor(Math.random() * 100);
      el.style.top = randomTop + "%";
      el.style.left = randomLeft + "%";
    }
    
    // Отримуємо всі іконки з класом .edu-icon та встановлюємо для кожної рандомну позицію
    const icons = document.querySelectorAll(".edu-icon");
    icons.forEach(setRandomPosition);
  </script>
  
      <!-- Bootstrap JS та залежності -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	'
?>			 	
<!-- === Повідомленя про помилку входу === -->
				<?php if (!empty($error)): ?>
				<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
				<div id="errorToast" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="d-flex">
					<div class="toast-body fs-2">
						<?= htmlspecialchars($error) ?>
					</div>
					<button type="button" class="btn-close btn-close-white me-2 m-auto " data-bs-dismiss="toast" aria-label="Закрити"></button>
					</div>
				</div>
				</div>
				<?php endif; ?>

        					<?php if (!empty($success)): ?>
					<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
					<div id="errorToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
						<div class="d-flex">
						<div class="toast-body fs-3">
							<?= htmlspecialchars($success) ?>
						</div>
						<button type="button" class="btn-close btn-close-white me-2 m-auto " data-bs-dismiss="toast" aria-label="Закрити"></button>
						</div>
					</div>
					</div>
					<?php endif; ?>