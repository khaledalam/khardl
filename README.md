# Khardl
### A Digital Ecosystem Solution For Restaurants

---

#### Synonyms
R-: Restaurant<br />
RO: Restaurant Owner

#### Links
Production: https://khardl.com/ <br />
Development: https://khardl4test.xyz/


### Setup:

#### prerequisites
- install [docker](https://docs.docker.com/engine/install/) and [docker-compose](https://docs.docker.com/compose/install/)
- copy backend/.env.example to backend/.env

First, navigate to your project directory and run the following shell scripts:

- Run the back-end (Laravel) application:

  ```$ ./run-backend.sh```

- Run the front-end (React) applications:
  - Central landing page for `Admins`, `RO` and `R-'s Workers`
  - Restaurant Tenant for ROs, R-'s Customers, and R-'s Workers

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

```
127.0.0.1   khardl
127.0.0.1   test.khardl 
127.0.0.1   first.khardl
127.0.0.1   second.khardl
127.0.0.1   third.khardl
```
Where `test` is the name of Tenant(Restaurant name - subdomain)

note: if after setup and navigate to first.khardl:8000 not work try to use different browser.

Additional Resources: [How to Edit Hosts File](https://www.hostinger.com/tutorials/how-to-edit-hosts-file).


- Run laravel queue worker in the background:

Note: 
- <b>`khardl5`</b> cpanel username on khardl.com
- <b>`khardl4test`</b> cpanel username on khardl.com

via nohup
```shell 
nohup php /home/khardl5/public_html/backend/artisan queue:work --daemon &
```

via supervisord:
```shell
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


### Database
- db_backup.sh file is used to export the database and save the sql files in db_backups folder



### Useful commands and tools:
- SQL quest to delete all databases that start with `restaurant_` prefix
```sql
SELECT CONCAT('DROP DATABASE `', SCHEMA_NAME, '`;')
FROM `information_schema`.`SCHEMATA`
WHERE SCHEMA_NAME LIKE 'restaurant_%';
``` 

- Add dummy branch slots and sub:
```sql

USE khardl;

SET @tenant_database := (SELECT CONCAT('restaurant_', id) FROM tenants WHERE restaurant_name = 'first');
SELECT @tenant_database;

SET @query := CONCAT('USE `', @tenant_database, '`');
PREPARE stmt FROM @query;
EXECUTE stmt;

INSERT INTO `r_o_subscriptions` (`id`, `start_at`, `end_at`, `amount`, `number_of_branches`, `subscription_id`, `user_id`, `status`, `created_at`, `updated_at`, `type`, `reminder_email_sent`, `reminder_suspend_email_sent`)
VALUES (NULL, '2024-01-31', '2025-02-28', '10', '2', 'test_sub_id', '1', 'active', NULL, NULL, 'new', '0', '0');

DEALLOCATE PREPARE stmt;

```
or use command: `tenant:add-dummy-branch-slot {name=first}` 
e.g. php artisan tenant:add-dummy-branch-slot first