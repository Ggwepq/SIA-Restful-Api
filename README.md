## ⚡ API Endpoints

### Watchlists
METHOD       | ENDPOINT                      | DESCRIPTION
-------------| -------------                 | -------------------
`GET`        | <b>api/v1/watchlists</b>      | List all user's watchlists
`POST`       | <b>api/v1/watchlists</b>      | Create new watchlist for user
`GET`        | <b>api/v1/watchlists/{id}</b> | Show a specific watchlist
`PUT`        | <b>api/v1/watchlists/{id}</b> | Update a watchlist
`DELETE`     | <b>api/v1/watchlists/{id}</b> | Delete a watchlist

### Movies
METHOD       | ENDPOINT                      | DESCRIPTION
-------------| -------------                 | -------------------
`GET`        | <b>api/v1/movies</b>          | List all user's movie from their watchlists
`POST`       | <b>api/v1/movies</b>          | Add new movie
`GET`        | <b>api/v1/movies/{id}</b>     | Show a specific movie
`DELETE`     | <b>api/v1/movies/{id}</b>     | Delete a movie

### User
METHOD       | ENDPOINT                      | DESCRIPTION
-------------| -------------                 | -------------------
`GET`        | <b>api/users</b>              | Show current user
`POST`       | <b>api/v1/login</b>           | Create a new token for registered user
`POST`       | <b>api/v1/register</b>        | Create new user with access token
`GET`        | <b>api/v1/logout</b>          | Remove user's token

##  <span id="usage"> ⚡ API Usage</span>

### `GET` User's Watchlists

#### Endpoint

```url
http://localhost:{port_number}/api/v1/watchlists
```
#### Response Schema

```json
{
  "status": "success",
  "message": "User watchlists retrieved successfully.",
  "data": [
    {
      "id": int,
      "title": string,
      "description": string,
      "image_url": string,
      "movies": [
        {
          "id": int,
          "tmdb_id": int,
          "added_at": string
        },
        {...},
      ]
    },
    {...},
  ]
```



## API Made with
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
