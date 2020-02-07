# Welcome to the Exchange Traded Fund Finder.

###### Getting started:

1. Clone the repo
2. Copy .env.example to .env
3. Add database credentials to .env
4. composer install
5. php artisan migrate
6. npm install
7. npm run dev

Should only take you a few minutes to setup.

---

## Backend Engineer Challenge

1. Parse ​ Top 10​ Holdings, Country Weights and Sector Weights, ETF name and fund
description information for all requested ​ SPDR ETFs (​ www.spdrs.com​ ) and store them in
a database. The information should be updated daily.

2. Create API using an authentication method of your choice. However, ​ non expirable
keys are not acceptable​ . Endpoints should include:

    a. Login authentication for API access
    
    b. List of available ETF symbol
    
    c. Get data for ETF by ticker
    
3. Provide a ​ Postman​ file for API documentation
