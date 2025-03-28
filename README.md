# nginx conf
```bash
server {
    listen 8877 ssl;
    server_name domain;

    root /var/www/vebinar/public;
    ssl_certificate /etc/letsencrypt/new/new_certificate.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/new/new_certificate.key; # managed by Certbot

    client_max_body_size 100M;    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php; 

    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_prefer_server_ciphers on;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location /storage/ {
        add_header 'Access-Control-Allow-Origin' '*';
        add_header 'Access-Control-Allow-Methods' 'GET, OPTIONS';
        add_header 'Access-Control-Allow-Headers' 'Content-Type, Authorization';
    }

    location /hls/ {
        alias /var/www/hls/;  # Путь к HLS-файлам
        types {
            application/vnd.apple.mpegurl m3u8;
            video/mp2t ts;
        }
        add_header Cache-Control no-cache;
        add_header 'Access-Control-Allow-Origin' '*';
        add_header 'Access-Control-Allow-Methods' 'GET, OPTIONS';
        add_header 'Access-Control-Allow-Headers' 'Content-Type, Authorization';
    }
}
```
# cron
```bash
crontab -e
* * * * * php /var/www/webinar/artisan schedule:run >> /dev/null 2>&1
```

# install rtmp

```bash
sudo apt install libnginx-mod-rtmp -y
nginx -V 2>&1 | grep --color=auto rtmp
```

# команда запуска стрима

```bash
ffmpeg -re -i /path/to/sample.mp4 -c:v libx264 -preset veryfast -b:v 3000k -maxrate 3000k -bufsize 6000k -vf "scale=1280:720" -g 60 -c:a aac -b:a 128k -ac 2 -f flv rtmp://localhost/live/stream
```