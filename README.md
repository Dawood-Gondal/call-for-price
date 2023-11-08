# M2Commerce: Magento 2 Call for Price

## Description

On Product detail, category and search pages instead of ‘Add to Cart’ ‘Call For Price’ button will appear against products for which call for price attribute is enabled. Customer can request for product details through this extension and will provide his email and phone number to ensure the admin to contact him back shortly. On admin panel, admin will be provided with the list of users who have sent requests for product details.

### Features
1. Pop up to collect customers’ data on request form.
2. Admin grid to display list of requests.
3. Hide prices of products.
4. Available on product detail, category and search pages.
5. Supports all types of products.
6. Compatible with 2.3.x and 2.4.x versions.


## Installation
### Magento® Marketplace

This extension will also be available on the Magento® Marketplace when approved.

1. Go to Magento® 2 root folder
2. Require/Download this extension:

   Enter following commands to install extension.

   ```
   composer require m2commerce/call-for-price"
   ```

   Wait while composer is updated.

   #### OR

   You can also download code from this repo under Magento® 2 following directory:

    ```
    app/code/M2Commerce/CallForPrice
    ```    

3. Enter following commands to enable the module:

   ```
   php bin/magento module:enable M2Commerce_CallForPrice
   php bin/magento setup:upgrade
   php bin/magento setup:di:compile
   php bin/magento cache:clean
   php bin/magento cache:flush
   ```

4. If Magento® is running in production mode, deploy static content:

   ```
   php bin/magento setup:static-content:deploy
   ```
