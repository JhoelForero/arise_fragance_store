# Assignment2

This is a e-commerce platform with functionalities to users such as user management, product management, purchases, wish lists and personalized recommendations.

## Content table
1. [Prerequisites](#Prerequisites)
2. [Installation](#installation)
3. [project structure](#project-structure)
4. [Configuration](#Configuration)
5. [usage](#usage)
6. [Technologies Used](#Technologies-Used)

## Prerequisites
--Section to place all installations, versions and configurations.

## Installation
1. Set database backup on mysql:
    A. Go to Mysql and click on Data import/restore
    B. Click on "import from self-contained file" and select the subfolder "database" inside the parent folder "assignment2".
    C. Click on start import to save tables with data.
2. Set database user and password in php to connection
    A. Go to assignment2/server/db.php and under the comment //USER CREDENTIALS, write your own mysql credentials to connect to server.
3. Set client link to communicate with backend. 
    A. Inside assignment2 -> frontend, you will find connectionServer.js
    B. in the first like there is a code similar to this: const LOCALHOSTDIR = "http://localhost/assignment2";
    C. Change the link based on your folder structure: if you are charging project from localhost/projects/assignment2 then that line of code should be changed to that. the parent folder or "localhost" equals to the file htdocs in the xampp folder. So if:
    project path is like this: C:\xampp\htdocs\assignment2, LOCALHOSTDIR should be "http://localhost/assignment2".


## project-structure
/Assignment2/
├── frontend/                      # Frontend Content
│   ├── public/                    # Place to put static documents
│   └── src/                       # source files
│         ├── components/          # Reusable components
│         ├── pages/               # Pages section
│         ├── services/            # Logic to make API calls
│         └── styles/              # Section for styles
├── backend/                       # Backend microservices
│   ├── auth-service/              # Auth service section
│   ├── catalog-service/           # Catalog service section
│   ├── purchase-service/          # Purchase service section
│   └── recommendations-service/   # suggestions service section
├── database/                      # Database queries and documentation
└── README.md                      # This document

## Configuration
--Section to document configurations such as credentials for DB
--Here can be documented PORTS and base_urls used for each microservice.
APACHE uses defaults ports 80 (HTTP) & 443 (HTTPS)

## usage
--This part explains how to use application, which parts should be activated and how to make the program work

## Technologies-Used
--This section will describe technologies used and what was used for, ex:
--Java: used for connection with database
