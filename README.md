## Endpoints

> [!NOTE]
> Customers and invoices requires bearer token to be accessed

### Customer

| METHOD  | ENDPOINT                     | DESCRIPTION                          |
| ------- | ---------------------------- | ------------------------------------ |
| `GET`   | <b>api/v1/customers</b>      | List all customers                   |
| `POST`  | <b>api/v1/customers</b>      | Create new customer                  |
| `GET`   | <b>api/v1/customers/{id}</b> | Show a customer                      |
| `PUT`   | <b>api/v1/customers/{id}</b> | Update a customer                    |
| `PATCH` | <b>api/v1/customers/{id}</b> | Update a specific field for customer |

### Invoice

| METHOD | ENDPOINT                    | DESCRIPTION             |
| ------ | --------------------------- | ----------------------- |
| `GET`  | <b>api/v1/invoices</b>      | List all invoices       |
| `POST` | <b>api/v1/invoices/bulk</b> | Add a list of invoices  |
| `GET`  | <b>api/v1/invoices/{id}</b> | Show a specific invoice |

### User

| METHOD | ENDPOINT               | DESCRIPTION                            |
| ------ | ---------------------- | -------------------------------------- |
| `GET`  | <b>api/users</b>       | Show current user                      |
| `POST` | <b>api/v1/login</b>    | Create a new token for registered user |
| `POST` | <b>api/v1/register</b> | Create new user with access token      |
| `POST` | <b>api/v1/logout</b>   | Remove user's token                    |

### Query Parameters

| PARAM             | VALUE     | DESCRIPTION                              | SAMPLE                           |
| ----------------- | --------- | ---------------------------------------- | -------------------------------- |
| `[eq]`            | <b>=</b>  | Find equal to the value                  | `invoices?type[eq]=V`            |
| `[lt]`            | <b><</b>  | Find less than to the value              | `customers?postalCode[lt]=5000`  |
| `[lte]`           | <b><=</b> | Find less than or equal to the value     | `customers?postalCode[lte]=5000` |
| `[gt]`            | <b>></b>  | Find greater than to the value           | `invoices?amount[gt]=1000`       |
| `[gte]`           | <b>>=</b> | Find greater than or equal to the value  | `invoices?amount[gte]=1000`      |
| `[ne]`            | <b>!=</b> | Find not equal to the value              | `invoices?type[ne]=V`            |
| `includeInvoices` | NULL      | Show customers along with their invoices | `customer?includeInvoices`       |

> [!NOTE]
> Query parameters only work on get requests for customers and invoices

> [!NOTE]
> Multi query can work by adding & between queries: `type[eq]=V&amount[gte]=5000`

## <span id="usage"> API Usage</span>

### `POST` Register new user

#### Endpoint

```url
http://localhost:8000/api/v1/register
```

#### Request Sample

```json
{
    "name": "Admin",
    "email": "admin@gmail.com",
    "password": "password",
    "password_confirmation": "password"
}
```

#### Response Sample

```json
{
    "message": "User registered successfully.",
    "data": {
        "user": {
            "name": "Admin",
            "email": "admin@gmail.com",
            "updated_at": "2024-11-30T07:23:32.000000Z",
            "created_at": "2024-11-30T07:23:32.000000Z",
            "id": 2
        },
        "token": "2|ZGWCbZKmmvTn1LaPC3T54eTMFzbDON2zksFnKYW4e3ade510"
    }
}
```

### `POST` Logout user

#### Endpoint

```url
http://localhost:8000/api/v1/logout
```

#### Response Sample

```json
{
    "message": "User logged out successfully.",
    "data": null
}
```

### `POST` Login user (Must be registered to work)

#### Endpoint

```url
http://localhost:8000/api/v1/login
```

#### Request Sample

```json
{
    "email": "admin@gmail.com",
    "password": "password"
}
```

#### Response Sample

```json
{
    "message": "User logged in successfully.",
    "data": {
        "user": {
            "id": 3,
            "name": "Admin",
            "email": "admin@gmail.com",
            "email_verified_at": null,
            "created_at": "2024-11-30T07:25:47.000000Z",
            "updated_at": "2024-11-30T07:25:47.000000Z"
        },
        "token": "4|qsKVjuwixgbFvBynIsFto5cj5JeinKOUNEdRWpkTc2dc32aa"
    }
}
```

### `GET` Show all customer record

#### Endpoint

```url
http://localhost:8000/api/v1/customers
```

#### Request Sample

`No request just the bearer token`

#### Response Sample

```json
{
    "data": [
        {
            "id": 1,
            "name": "Luettgen Ltd",
            "type": "B",
            "email": "becker.erick@hotmail.com",
            "address": "749 Ashleigh Junctions\nLake Amarifort, UT 40576-9152",
            "city": "Judeton",
            "state": "Montana",
            "postalCode": "07449"
        },
        {
            "id": 2,
            "name": "Kuhlman, McLaughlin and Spencer",
            "type": "B",
            "email": "omitchell@pfeffer.biz",
            "address": "Test",
            "city": "Langworthfort",
            "state": "Alabama",
            "postalCode": "48670-9104"
        },
        {
            "id": 3,
            "name": "Kirstin Paucek",
            "type": "I",
            "email": "mireya85@gmail.com",
            "address": "88264 Kunze Trafficway Apt. 045\nJonesberg, FL 94504",
            "city": "South Brennonside",
            "state": "District of Columbia",
            "postalCode": "01873-1131"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/v1/customers?page=1",
        "last": "http://localhost:8000/api/v1/customers?page=16",
        "prev": null,
        "next": "http://localhost:8000/api/v1/customers?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 16,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=9",
                "label": "9",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=10",
                "label": "10",
                "active": false
            },
            {
                "url": null,
                "label": "...",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=15",
                "label": "15",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=16",
                "label": "16",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/customers?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/v1/customers",
        "per_page": 15,
        "to": 15,
        "total": 231
    }
}
```

### `GET` Show a specific customer record

#### Endpoint

```url
http://localhost:8000/api/v1/customers/231
```

#### Request Sample

`No request just the bearer token`

#### Response Sample

```json
{
    "data": {
        "id": 231,
        "name": "Test",
        "type": "I",
        "email": "test@gmailcom",
        "address": "123 Test St",
        "city": "Test City",
        "state": "Testy",
        "postalCode": "123242"
    }
}
```

### `POST` Create new customer record

#### Endpoint

```url
http://localhost:8000/api/v1/customers
```

#### Request Sample

```json
{
    "name": "Test",
    "type": "B",
    "email": "test@gmailcom",
    "address": "123 Test St",
    "city": "Test City",
    "state": "Testy",
    "postalCode": "123242"
}
```

#### Response Sample

```json
{
    "data": {
        "id": 231,
        "name": "Test",
        "type": "B",
        "email": "test@gmailcom",
        "address": "123 Test St",
        "city": "Test City",
        "state": "Testy",
        "postalCode": "123242"
    }
}
```

### `PATCH` Edit a specific customer record

#### Endpoint

```url
http://localhost:8000/api/v1/customers/231
```

#### Request Sample

```json
{
    "type": "I"
}
```

#### Response Sample

```json
{}
```

### `GET` Show all invoice

#### Endpoint

```url
http://localhost:8000/api/v1/invoices
```

#### Request Sample

`No request just the bearer token`

#### Response Sample

```json
{
    "data": [
        {
            "id": 1,
            "customerId": 1,
            "amount": 13538,
            "status": "V",
            "billedDate": "2018-03-22 16:02:20",
            "paidDate": null
        },
        {
            "id": 2,
            "customerId": 1,
            "amount": 16199,
            "status": "P",
            "billedDate": "2015-11-11 21:26:15",
            "paidDate": "2024-09-18 20:09:35"
        },
        {
            "id": 3,
            "customerId": 1,
            "amount": 16219,
            "status": "V",
            "billedDate": "2019-08-01 08:48:28",
            "paidDate": null
        },
        {
            "id": 4,
            "customerId": 1,
            "amount": 3957,
            "status": "V",
            "billedDate": "2019-07-09 04:08:41",
            "paidDate": null
        },
        {
            "id": 5,
            "customerId": 1,
            "amount": 4223,
            "status": "P",
            "billedDate": "2020-10-01 03:01:54",
            "paidDate": "2017-08-29 06:52:02"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/v1/invoices?page=1",
        "last": "http://localhost:8000/api/v1/invoices?page=137",
        "prev": null,
        "next": "http://localhost:8000/api/v1/invoices?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 137,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=9",
                "label": "9",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=10",
                "label": "10",
                "active": false
            },
            {
                "url": null,
                "label": "...",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=136",
                "label": "136",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=137",
                "label": "137",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/invoices?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/v1/invoices",
        "per_page": 15,
        "to": 15,
        "total": 2050
    }
}
```

### `GET` Show a specific invoice record

#### Endpoint

```url
http://localhost:8000/api/v1/invoices/1
```

#### Request Sample

`No request just the bearer token`

#### Response Sample

```json
{
    "data": {
        "id": 1,
        "customerId": 1,
        "amount": 13538,
        "status": "V",
        "billedDate": "2018-03-22 16:02:20",
        "paidDate": null
    }
}
```

### `POST` Insert invoice record

#### Endpoint

```url
http://localhost:8000/api/v1/invoices/bulk
```

#### Request Sample

```json
[
    {
        "customerId": 231,
        "amount": 13538,
        "status": "V",
        "billedDate": "2018-03-22 16:02:20",
        "paidDate": null
    },
    {
        "customerId": 231,
        "amount": 13538,
        "status": "V",
        "billedDate": "2018-03-22 16:02:20",
        "paidDate": null
    }
]
```

> [!NOTE]
> Request body must be enclosed in []

#### Response Sample

`No response aside from status`
