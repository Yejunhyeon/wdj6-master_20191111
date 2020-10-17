# > WDJ6 Laravel Project <
![yju ac kr](https://user-images.githubusercontent.com/48374069/70375447-36bac580-1941-11ea-9cb3-1b2505947fa7.jpg)

## 1. git bash
- $ git clone https://github.com/JunHyeok95/wdj6.git
- $ cd wdj6
- $ cp .env.example .env

- $ composer update
- $ composer install
- $ npm install

## 2. mysql
- mysql> drop database wdj6;
- mysql> create database wdj6;

## 3. .env 파일 수정 [ 다운받은 wdj6 폴더 ]
- DB_DATABASE= [ wdj6 ]
- DB_USERNAME= [ root ]
- DB_PASSWORD= [ password ]

- MAIL_DRIVER=smtp
- MAIL_HOST=smtp.gmail.com
- MAIL_PORT=587
- MAIL_USERNAME= [ gmail ]
- MAIL_PASSWORD= [ password ]
- MAIL_ENCRYPTION=tls

## 4. php.ini 파일 수정 [ php 설치한 경로 ]
- ; extension=fileinfo [ 주석풀기 ]

## 5. 실행 
- composer dump-autoload

- php artisan key:generate
- php artisan migrate
- php artisan db:seed

- php artisan serve [ --host=domain --port=8000 ]




### + [ img 경로 확인 ]
- wdj6\resources\views\members\index.blade.php 의 img
- wdj6\resources\views\home\index.blade.php 의 img
- wdj6\resources\views\users\partialindex.blade.php 의 img

- ex) php artisan serve --host 192.168.0.2 --port 8000


### + [ program 경로 확인 ]
- wdj6\resources\views\programs\index.blade.php 의 img
- wdj6\resources\views\programs\partials\program.blade.php 의 img
- wdj6\resources\views\programs\carousel.blade.php 의 img