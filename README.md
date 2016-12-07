# mpay24-seamless-php-example
Unoffical example of seamless integration based on [mpay24-php](https://github.com/mpay24/mpay24-php) sdk

## Installation

The repository should be cloned recursive to get the dependency (mpay24-php sdk)

`git clone --recursive https://github.com/zirnipa/mpay24-seamless-php-example`

## Configuration

The PHP SDK should now be configured by adding the SOAP credentials to the mpay24-php configuration.
The `config.php` is located under `./mpay24-php/lib/config/config.php`
```
define("MERCHANT_ID", "9****");
define("SOAP_PASS", "**********");
```
The `MERCHANT_ID` should be entered without an u
