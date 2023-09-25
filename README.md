Як розвернути проект
1) Потрібно встановити php 8.0+ та composer
2) Клонувати проект git clone https://github.com/Apnton/comments.git
3) Після установки проекту в папці з проектом запустити команди:
   composer:install;
   php artisan key:generate;
   php artisan migrate;
   php artisan storage:link;
   php artisan serve;
4) Перейти за посиланням http://127.0.0.1:8000
   
