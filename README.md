🛒 Laravel Order API - Postman Testing Guide
============================================

📦 Available API Endpoints:
---------------------------

1️⃣ List All In-Stock Products
------------------------------
GET /api/products

Response:
[
  {
    "id": 1,
    "name": "Apple iPhone 14",
    "price": 79900,
    "stock": 10
  },
  ...
]


2️⃣ Place an Order
-------------------
POST /api/orders

Request Body (JSON):
{
  "customer_name": "Jane Doe",
  "customer_email": "jane@example.com",
  "products": [
    { "id": 1, "quantity": 2 },
    { "id": 3, "quantity": 1 }
  ]
}

✅ This will:
- Create the order
- Reduce product stock
- Attach order-product relationships

Response:
{
  "success": true,
  "message": "Order placed successfully.",
  "order": {
    "id": 5,
    "customer_name": "Jane Doe",
    "products": [
      {
        "id": 1,
        "name": "Apple iPhone 14",
        "pivot": {
          "quantity": 2
        }
      }
    ]
  }
}


3️⃣ Generate Razorpay Order ID (Using Order ID)
-----------------------------------------------
GET /api/razorpay/order/{orderId}

Use the ID from the order response.

Example:
GET /api/razorpay/order/5

Response:
{
  "razorpay_order_id": "order_MZC1zFxFzRA8K8",
  "amount": 219700,
  "currency": "INR"
}


4️⃣ Generate Razorpay Order ID (Generic POST)
---------------------------------------------
POST /api/razorpay/order

Request Body (JSON):
{
  "amount": 149900  // in paise (₹1499.00)
}

Response:
{
  "razorpay_order_id": "order_MZABC123Xyz",
  "amount": 149900,
  "currency": "INR"
}

Use this when you want to create a Razorpay order without a Laravel order yet.

🧪 Testing Tips:
----------------
- Use Postman for API calls.
- Seed products before testing: `php artisan migrate:fresh --seed`
- Check DB tables: `orders`, `products`, and `order_product`
- View logs (if needed): `tail -f storage/logs/laravel.log`

Happy Testing! 🚀
