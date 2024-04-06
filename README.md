# Cafeteria Management System

Cafeteria is an online application created with HTML, CSS, JavaScript, Bootstrap 5, PHP and MySQL, specifically designed for the purpose of efficiently handling cafeteria orders. This project is divided into two primary sections: the Admin View and the User View.

## Features

- ### User View

  1. #### Login Page

     - Users have the option to access their accounts by entering their email and password.
     - In case users forget their password, they have the option to use the provided feature to be directed to a page prompting them to enter their email address. Once entered and it was registered in the database, a 6-digit key will be sent to their email for them to input and reset their password.

  2. #### Home Page

     - Users have the option to choose their desired items from a range of products.
     - By clicking on the product images, Users can conveniently add the items to their shopping cart.
     - Users have the flexibility to modify the quantity of products and include any specific notes for their order.
     - The selection of rooms can be made through a drop-down menu.
     - The total amount to be paid is clearly presented.
     - Users can finalize their orders by confirming them, and the orders will be submitted accordingly.
     - The most recent order is prominently displayed at the top of the page.

- ### Admin View

  1. #### Home Page

     - Admins have the ability to generate orders for users by selecting them from a dropdown menu.

  2. #### Order Tracking

     - Admins can view user orders and total prices within a specified date range.
     - Order statuses include "Processing," "Out for Delivery," and "Done."
     - Only orders with a "Processing" status can be canceled.
     - Clicking on an order displays its contents.

  3. #### Product Management

     - Admins have the ability to access a comprehensive list of products and make additions or deletions as necessary.
     - Products are systematically organized into categories, and admins possess the authority to introduce new categories into the system.

  4. #### User Management

     - Admins have the ability to view, modify, and remove users.
     - A form is provided to add new users.

  5. #### Checks

     - Admins have the ability to access all checks within a designated date range.
     - Checks are sortable by individual users.
     - By selecting a username, users can view their order details for the specified timeframe.

  6. #### Orders

     - Admins have the ability to review their existing orders that are awaiting processing.

## Installation

Thank you for selecting our PHP native project! To begin setting up the project, kindly follow the instructions provided below

### Requirements

Before you proceed, make sure that your system has the following software installed

- XAMPP: Our project is compatible with XAMPP, an Apache distribution that includes MariaDB, PHP, and Perl. If you haven't installed XAMPP yet, you can download it from the [official website](https://www.apachefriends.org/download.html).

### Setup

Follow the instructions below to install and execute the project on your personal computer:

1. ##### Clone the repository

   `git clone https://github.com/MohamedAbotalb/Cafateria_Management_System.git`

2. #### Move the project files

   Transfer the cloned project files to the `htdocs` folder within your XAMPP installation directory. This specific directory can usually be found at `C:\xampp\htdocs` on Windows.

3. #### Start XAMPP

   Start the XAMPP Control Panel and initiate the Apache server.

4. #### Database Import (if required)

   In case your project involves a database, it might be necessary to import it into your local database management system, such as phpMyAdmin. Please consult the project documentation for detailed guidelines on how to import the database.

## Usage

After the project has been established and is operational, you will be able to reach it through your web browser by visiting http://localhost/Cafeteria_Management_System/views/login.php.

## Supervision

This project is under the supervision of [Hend Samir](https://www.linkedin.com/in/hendsamiropensourcedeveloper/), a Teaching Assistant from the Open Source Department at the Information Technology Institute (ITI), Ministry of Communications and Information Technology.
