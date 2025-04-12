# Laravel E-commerce Project:

## Main Features:

-   Authentication & Authoraization
-   Authentication with google account
-   User {Customer, Seller, Admin, and Sub admin}
-   Admin panel, seller panel
-   Product
-   Category and sub category
-   Store
-   Cart
-   Wishlist & favorites
-   Discount & coupons
-   Order managment
-   checkout & payment
-   Shipment managment
-   Rate & rivew
-   Search and filter
-   Order Invoices (PDF Generation)
-   Queue & Job System
-   Cache
-   Live Chat & Support System
-   AI-Powered Search & Recommendations
-   Notifications
-   Email verivication
-   Phone verivication
-   Reset password
-   Log

---

## API Documentation:

### Authentication:

#### Register

Endpoint: POST /api/register
Auth Required: No
Description: Creates a new user account with default role customer.

**Request Body**
**Field: Type, Required, Validation**
first_name: string, true, Required
last_name: string, true, Required
email: string, true, Must be a valid, unique email
phone: string, true, Min: 7, Max: 20, Unique
password: string, true, Min: 8, Max: 32
password_confirmation: string, true, Must match password
country: string, true, Required
**Example**
`{
  "first_name": "Jane",
  "last_name": "Doe",
  "email": "jane@example.com",
  "phone": "1234567890",
  "password": "secret123",
  "password_confirmation": "secret123",
  "country": "Germany"
}`
Response 201 Created

`json
{
  "message": "User account created successfully.",
  "data": {
    "id": 1,
    "first_name": "Jane",
    "last_name": "Doe",
    "email": "jane@example.com",
    ...
  }
}
`

---

#### Login

Endpoint: POST /api/login
Auth Required: No
Description: Authenticates user and returns a bearer token.

Request Body
Field: Type, Required, Validation

email: string, true, Must be a valid email

password: string, true, Min: 8, Max: 32

`json
{
  "email": "jane@example.com",
  "password": "secret123"
}
`
Response 200 OK

`json
{
  "message": "Logged in successfully",
  "data": {
    "id": 1,
    "first_name": "Jane",
    "last_name": "Doe",
    "email": "jane@example.com"
  },
  "token": "your_token_here",
  "token_type": "Bearer"
}`

Response 401 Unauthorized

`json
{
  "message": "The credentials are incorrect."
}`

---

#### Logout

Endpoint: POST /api/logout
Auth Required: ✅ Yes (Bearer Token)
Description: Logs out the user by revoking all active tokens.

Headers

Authorization: Bearer {token}

Response 200 OK

`json
{
  "message": "Logged out successfully"
}`
