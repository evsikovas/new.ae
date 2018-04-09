
<html>
<head>
<link rel="stylesheet" href="/css/panel.css">
<link rel="stylesheet" href="/css/left-nav-style.css">

</head>
<body>
  <?php
    echo "Главная страница";
  ?>
  <input type="checkbox" id="nav-toggle" hidden>
  <!--
  Выдвижную панель размещаете ниже
  флажка (checkbox), но не обязательно
  непосредственно после него, например
  можно и в конце страницы
  -->
  <nav class="nav">
      <!--
  Метка с именем `id` чекбокса в `for` атрибуте
  Символ Unicode 'TRIGRAM FOR HEAVEN' (U+2630)
  Пустой атрибут `onclick` используем для исправления бага в iOS < 6.0
  См: http://timpietrusky.com/advanced-checkbox-hack
  -->
      <label for="nav-toggle" class="nav-toggle" onclick></label>
      <!--
  Здесь размещаете любую разметку,
  если это меню, то скорее всего неупорядоченный список <ul>
  -->
      <h2 class="logo">
          <a>Portal</a>
      </h2>
      <ul>
          <li><a href="#1">Один</a>
          <li><a href="#2">Два</a>
          <li><a href="#3">Три</a>
          <li><a href="#4">Четыре</a>
          <li><a href="#5">Пять</a>
          <li><a href="#6">Шесть</a>
          <li><a href="#7">Семь</a>
      </ul>
  </nav>
</body>
</html>
