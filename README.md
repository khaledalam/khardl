# Khardl

## Initial Setup:
First, navigate to your project directory and run the following shell scripts:

- Run the back-end (Laravel) application:

    ```$ ./run-backend.sh```

- Run the front-end (React) application:

    ```$ ./run-frontend.sh```

Make sure that both the back-end and front-end applications are running successfully.


## Creating Migrations for your Laravel Application

   - Run migrations and seed the database inside your **backend** folder:
     ```bash
     php artisan migrate:fresh --seed
     ```

## Creating a New Tenant 


   - To create a new tenant, you can use the following command:

        ```bash
        php artisan create:tenant
        ```
   - If you want to specify a tenant name, use the following format:

        ```bash
        php artisan create:tenant {name}
        ```


## Add Subdomain to Hosts File:
To access the new tenant via a subdomain, add this line to your system's hosts file:

```127.0.0.1   test.khardl ```

Additional Resources: [How to Edit Hosts File](https://www.hostinger.com/tutorials/how-to-edit-hosts-file).


