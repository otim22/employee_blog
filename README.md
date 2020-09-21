[![CircleCI](https://circleci.com/gh/otim22/employee_blog.svg?style=svg&circle-token=2a074ca89189a48646eb464227431b5e28d138ec)](https://app.circleci.com/pipelines/github/otim22/employee_blog/14/workflows/11b676aa-b86e-4bff-abda-0895a17a92a3/jobs/14)


# Employee Blog API with Lumen Micro Framework.

Employee blog is a simple blog application based on lumen microframe work of laravel.

## Setup
 

```sh
# Clone the project from github
git clone https://github.com/otim22/employee_blog.git

# Enter into the directory
cd employee_blog

# Ensure you have composer install on your terminal
composer install
```

```sh
# Set JWT
php artisan jwt:secret

# After then run migrations
php artisan migrate
```

Lastly, lets see the application in action by running .

```bash
php -S localhost:8000 -t public
```
 [To see the api in action](http://localhost:8000)

# Seed Test Data

```sh
# Seed test data
php artisan db:seed
```

# Run Unit Tests

```sh
# Run tests
vendor/bin/phpunit
```

# How can i test?
I recommend **post man** or **curl**

The api exposes the following endpoints.

* POST /api/register
* POST /api/login

* POST /api/posts
* GET /api/posts
* GET 'api/posts/id
* PUT /api/posts/id
* DELETE /api/posts

* POST /api/comments
* GET /api/comments
* GET /api/comments/id
* PUT /api/comments/id
* PATCH /api/comments/id
* DELETE /api/comments/id

```sh
# Endpoint POST /api/register'

Parameters.
 {
        "name": 'string', # required
        "email": 'email|unique:users', # required
        "password": 'password',  # required
        "password confirmation": 'password'  # to be entered
}

```

Returned Data.

```sh
{
    "user": {
        "name": "John Deere",
        "email": "deere@gmail.com",
        "updated_at": "2020-09-21T19:06:45.000000Z",
        "created_at": "2020-09-21T19:06:45.000000Z",
        "id": 1
    },
    "message": "Successfully registered user"
}

```

```sh
# Endpoint POST /api/login'

Parameters.
 {
        "email": 'email|unique:users', # required
        "password": 'password',  # required
}

```

Returned Data.

```sh
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYwMDcxNTQyMCwiZXhwIjoxNjAwNzE5MDIwLCJuYmYiOjE2MDA3MTU0MjAsImp0aSI6InFFZnhRVkZNYW1GTWlibjUiLCJzdWIiOjgsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.LVCrySCJDWmBZuXfmFJp6sylfXUOUi_oEaGSuFBSr8s",
    "token_type": "bearer",
    "expires_in": 3600
}

```

Copy the string of token generated and in the headers
```sh
{
'Key': Authorization
'Value': bearer token_generated
}

```

```sh
# Vist endpoint GET /api/posts'

Parameters.
[
   {
       "id": 1,
       "title": "Eveniet ut dolores omnis iure.",
       "body": "Nobis eos ad ut voluptatem voluptas. Debitis fugiat animi non blanditiis ratione nam repudiandae. Velit earum sapiente quaerat quibusdam. Sint eligendi modi ut neque ducimus.",
       "created_at": "2020-09-21T13:51:22.000000Z",
       "updated_at": "2020-09-21T13:51:22.000000Z"
   },
   {
       "id": 2,
       "title": "Ipsam nobis alias non cupiditate.",
       "body": "Rerum dolore quia ut. Ut voluptatibus rem eos autem praesentium. Omnis voluptatem voluptates sapiente voluptatibus cumque. Sequi quam dolore rerum est et dolore qui.",
       "created_at": "2020-09-21T13:51:22.000000Z",
       "updated_at": "2020-09-21T13:51:22.000000Z"
   },
   {
       "id": 3,
       "title": "Rerum cumque repellat ut esse minus quod.",
       "body": "Aliquam asperiores numquam placeat nobis a quia. Eaque vitae at est asperiores illum. Molestiae commodi in dolores sit deleniti esse. Veniam ut reprehenderit reiciendis omnis.",
       "created_at": "2020-09-21T13:51:22.000000Z",
       "updated_at": "2020-09-21T13:51:22.000000Z"
   },
   ...
   # Up to 10 posts
]

```

```sh
# Endpoint POST /api/comments

Parameters.

{
    "body": String, # Required
    "post_id": Integer # Optional but should be provided to attach comment to post
}

```

Returned Data.

```sh

{
    "body": "We guys are awesome",
    "user_id": 1,
    "post_id": 2,
    "updated_at": "2020-09-21T07:45:32.000000Z",
    "created_at": "2020-09-21T07:45:32.000000Z",
    "id": 1,
    "user": {
        "id": 1,
        "name": "John Deere",
        "email": "deere@gmail.com",
        "created_at": "2020-09-20T16:26:05.000000Z",
        "updated_at": "2020-09-20T16:26:05.000000Z"
    }
}

```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://opensource.org/licenses/MIT)
