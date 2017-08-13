# ES 开发博客案例

## 安装配置

1 . 导入跟目录 db_beego.sql 到数据库文件

2 . 配置 config 数据库连接

3 . cd 到当前根目录 执行 composer install （composer 自补） 


.hitaccess(Apache):

    RewriteEngine On
    RewriteBase /
    
    # Allow any files or directories that exist to be displayed directly
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    
    RewriteRule ^(.*)$ index.php?$1 [QSA,L]
    
.htaccess(Nginx):

    rewrite ^/(.*)/$ /$1 redirect;
    
    if (!-e $request_filename){
        rewrite ^(.*)$ /index.php break;
    }

