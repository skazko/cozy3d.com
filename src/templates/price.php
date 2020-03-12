<?php
/*
Template Name: Страница Стоимость
*/

get_header();
?>

<main id="main" class="container">

<?php
while ( have_posts() ) {
  the_post();
  the_title( '<h1 class="title" style="text-align:center">', '</h1>' ); ?>
  <div class="cards-group">
    <div class="card">
      <div class="card__value">
        <span class="value-prefix">от</span>
        <span class="value">300</span>		
      </div>
      <p class="card__postfix">руб/м<sup>2</sup></p>
      <div class="card__description">Стоимость 3Д визуализации интерьера.</div>
    </div>
    <div class="card">
      <div class="card__value">
        <span class="value-prefix">от</span>
        <span class="value">2-5</span>		
      </div>
      <p class="card__postfix">рабочих дней</p>
      <div class="card__description">Срок исполнения (на 1 помещение)</div>
    </div>
    <div class="card">
      <div class="card__value">
        <span class="value-prefix"></span>
        <span class="value">3000</span>		
      </div>
      <p class="card__postfix">руб</p>
      <div class="card__description">Минимальная стоимость заказа на визуализацию</div>
    </div>
  </div>
  <?php 
  the_content(); 
}; // End of the loop.

$timeline = [
  [
    'title' => 'Предварительный этап',
    'color' => '#3f903f',
    'content' => '<p>Свяжитесь со мной любым удобным для Вас способом из раздела контакты.</p>
    <p>Для начала работы мне потребуется план помещения с размерами и четко сформулированное задание (виды отделочных материалов для стен, пола, потолка, названия моделей мебели и предметов интерьера, фотографии понравившейся мебели)</p>'
  ],
  [
    'title' => 'Согласование',
    'color' => '#f0ad4e',
    'content' => '<p>Мы согласовываем все вопросы (сроки, стоимость, количество необходимых ракурсов)</p>
    <p>В результате мы получаем согласованное ТЗ и условия работы</p>
    <p>Внесение 50% предоплаты.</p>'
  ],
  [
    'title' => 'Проектирование',
    'color' => '#2e6da4',
    'content' => '<p>Построение геометрии помещения.</p>
    <p>Наполнение интерьера готовыми моделями + несложное моделирование корпусной мебели (входит в стоимость).</p>
    <p>Уникальные сложные модели оплачиваются отдельно (стоимость моделлинга от 500 рублей).</p>'
  ],
  [
    'title' => 'Оформление',
    'color' => '#d9534f',
    'content' => '<p>Настройка освещения</p>
    <p>Добавление материалов на объекты</p>
    <p>Настройка камер и выбор ракурсов</p>'
  ],
  [
    'title' => 'Предварительная приемка',
    'color' => '#5bc0de',
    'content' => '<p>Согласование предварительных изображений (с моими водяными знаками) в невысоком разрешении.</p>
    <p>Внесение правок (не более двух этапов).</p>
    <p>Оплата оставшихся 50%. Работа сделана.</p> '
  ],
  [
    'title' => 'Чистовой рендер',
    'color' => '#3f903f',
    'content' => '<p>После согласования черновых рендеров и полной оплаты работы я запускаю чистовой рендер.</p>
    <p>Чистовой рендер - ресурсоемкая операция, на одно изображение уходит от 2 часов. Поэтому процесс может растянутся на несколько дней, в зависимости от загруженности</p>
    <p>Я отправляю Вам готовые изображения. Работа сдана.</p>'
  ],
];
?>
  <ul class="timeline">
<?php foreach ($timeline as $i => $item) { ?>
    <li class="timeline__item">
      <div class="timeline__badge" style="background-color: <?php echo $item['color']; ?>">
        <?php echo $i ?>
      </div>
      <div class="timeline__panel">
        <div>
          <h4 class="timeline__title"><?php echo $item['title']; ?></h4>
        </div>
        <div class="timeline__body"><?php echo $item['content'] ?></div>
      </div>
    </li>
<?php } ?>
  </ul>
</main><!-- #main -->

<?php
get_footer();
