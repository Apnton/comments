Як розвернути проект
1) Потрібно встановити php 8.0+, composer та node.js 18.0+
2) Клонувати проект git clone https://github.com/Apnton/comments.git
3) Після клонування в папці з проекту запустити наступні команди команди:
- composer install;
- npm install
- npm run build
- php artisan key:generate;
- php artisan migrate;
- php artisan storage:link;
- php artisan serve;
4) Перейти за посиланням http://127.0.0.1:8000
