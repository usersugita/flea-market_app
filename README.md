## 環境構築  

Dockerビルド  

1.git clone https://github.com/usersugita/flea-market_app.git  
2.docker-compose up -d --build  
＊MYSQLは、OSによって起動しない場合がありますのでそれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。  

Laravel環境構築  

1.docker-compose exec php bash  
2.composer install  
3..env.example ファイルから.envを作成し、環境変数を変更  
4.php artisan key:generate  
5.php artisan migrate  
6.php artisan db:seed  
  
## 使用技術  

・PHP 7.4.9  
・Laravel 8.83.27  
・Mysql 8.0.26
## ER図  
![スクリーンショット 2025-02-23 100526](https://github.com/user-attachments/assets/f5e18373-6df7-42ee-96dd-4948d3d60918)

## URL  
・開発環境：http://localhost/  
・phpMyadmin：http://localhost:8080/  
