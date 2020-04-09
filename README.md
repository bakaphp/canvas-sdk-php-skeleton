# Phalcon API using Kanvas SDK

Our SDK is the quickest way to work with our API , allowing your app to use the kanvas layer to reduce the general logic of a SaaS normal app , providing the following functions

- User Management
- Company / Branch Management
- Subscription
- ACL
- FileSystem
- Webhooks

### Installation
- Download the project
- Go to Kanvas.dev and get your App Key
- Copy `storage/ci/.env.prod` and paste it in the root of the project and rename it `.env`
- On `.env` set your App Key in KANVAS_SDK_API_KEY
- On `.env` in `MYSQL_ROOT_PASSWORD` and `DATA_API_MYSQL_PASS` assign the root password for MySQL.
- On `.env`, update MySQL credentials (`DATA_API_MYSQL_NAME,DATA_API_MYSQL_USER,DATA_API_MYSQL_PASS`)
- On `.env`, change `DATA_API_MYSQL_HOST =  localhost` to `DATA_API_MYSQL_HOST =  mysql`
- Run Docker containers with the `docker-compose up --build` command

**NOTE** : This requires [docker](https://www.docker.com/) to be present in your system. Visit their site for installation instructions.
