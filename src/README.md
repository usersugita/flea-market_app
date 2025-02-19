## 環境構築  

Dockerビルド  

1.git clone https://github.com/usersugita/test-contactform.git  
2.docker-composer up -d --build  
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
![スクリーンショット 2024-09-18 130737](https://github.com/user-attachments/assets/82477d32-369e-4e7c-8eac-ec6d486ea3b7)  

## URL  
・開発環境：http://localhost/  
・phpMyadmin：http://localhost:8080/  

  ### 分からなかった所  
  "/" radioボタンのバリデーション設定    
  "/admin" エクスポート機能  
  "/admin" 詳細（モーダルウィンドウ）機能  
  category_id　モデルリレーション  
  Fortify 設定
