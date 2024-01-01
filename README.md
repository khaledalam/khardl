# Khardl

### Initial Setup:
First, navigate to your project directory and run the following shell scripts:

- Run the back-end (Laravel) application:

  ```$ ./run-backend.sh```

- Run the front-end (React) applications:
  - Central landing page for Admin, Restaurant Owner
  - Restaurant Tenant for Restaurant's Owner, Customers, and Workers

  ```$ ./run-frontend.sh```


### Creating Migrations for your Laravel Application

   - Run migrations and seed the database inside your **backend** folder:
     ```bash
     php artisan migrate:fresh --seed
     ```

### Creating a new Tenant(Restaurant domain)


   - To create a new tenant, you can use the following command:

        ```bash
        php artisan create:tenant
        ```
   - If you want to specify a tenant name, use the following format:

        ```bash
        php artisan create:tenant {name}
        ```

### Add Subdomain (Tenant or Restaurant domain) to Hosts File:
To access the new tenant via a subdomain, add this line to your system's hosts file:

```127.0.0.1   test.khardl ```

Where `test` is the name of Tenant(Restaurant name)

Additional Resources: [How to Edit Hosts File](https://www.hostinger.com/tutorials/how-to-edit-hosts-file).


### Useful commands and tools:
- SQL quest to delete all databases that start with `restaurant_` prefix 
```sql
SELECT CONCAT('DROP DATABASE `', SCHEMA_NAME, '`;')
FROM `information_schema`.`SCHEMATA`
WHERE SCHEMA_NAME LIKE 'restaurant_%';
``` 
- Run laravel queue worker in the background:
```shell 
nohup php /home/khardl5/public_html/backend/artisan queue:work --daemon &


[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /home/khardl5/public_html/backend/artisan queue:work --daemon --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
;user=root
numprocs=8
redirect_stderr=true
stdout_logfile=/home/khardl5/public_html/backend/queue_worker.log
stopwaitsecs=3600

```

