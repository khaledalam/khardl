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


