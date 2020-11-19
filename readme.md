# Docker base for Symfony project with Nginx, Php and Mariadb
If you already have a Symfony project, just copy the docker folder and the docker-compose at the root of your application, and go to "4. Configure .env".

### 1. Clone this project
`git clone project && cd symfony-docker-base-nginx-php-mariadb`

### 2. Create Symfony project with composer
Run this if if you are building a traditional web application <br>
`composer create-project symfony/website-skeleton projectName`

Run this if your are buliding a microservice, console application or API <br>
`composer create-project symfony/skeleton`

### 3.Move the contents of the symfony project folder <br>
Run this if if you are building a traditional web application <br>
`mv projectName/* ./ && mv projectName/.* ./`

### 4. Configure .env
In the .env file created by composer, configure the `DATABASE_URL` <br>
`DATABASE_URL=mysql://db_user:db_password@mariadb:3306/db_name?serverVersion=mariadb-10.5.5` <br>

And add 4 more variables at the end of the file : <br>

```
MYSQL_DATABASE=db_name
MYSQL_USER=db_user
MYSQL_PASSWORD=db_password
MYSQL_ROOT_PASSWORD=root_password
```
