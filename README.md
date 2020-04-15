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


### Filesystem

It's the system we use to handle file uploadings and it has the following characteristics:  


*   Files  can be stored in either an  AWS S3 bucket or your local filesystem.
*   It allows you to upload files and then associate it to any of the system modules you have defined in your app . This gives you the flexibility to upload once and use it in different places.
*   Files can’t be deleted unless specified. Files are rather soft deleted when marked as true on its field **_is_deleted_**

How to use it?

In your module just add the trait

```php
<?php

use Canvas\Traits\FileSystemModelTrait;

class Companies extends BaseModel
{

		use FileSystemModelTrait;

		//You will also need to add the function associcateFileSystem() to your afterSave function:

    /**
     * Upload Files.
     *
     * @todo move this to the baka class
     * @return void
     */
    public function afterSave()
    {
        $this->associateFileSystem();
    }
```

The rest should be handled by the frontend.

In order to get file from name from a specific entity just call

`$this->getFileByName(fileName);`

On the frontend side you will need to add relationship files or filesystem . With this you will get the list of files associated with the given entity

`?relationships=files`

`http://ai.app.dev/v1/route?relationships=files`


#### How to use the Filesystem via Phalcon Passthrough

To use the Filesystem feature on a model in Kanvas API, a simple POST call `/filesystem` can be made to the Kanvas API. You just need to make sure
that the content type of your body is `form-data` and add your file on said body of the request.

To retrieve the file, do a GET request call to the same endpoint.
