# FFM Enforce Two-Factor Authentication

## Description
This WordPress plugin redirects users without Two-Factor Authentication (2FA) enabled to their profile page to set it up. It works in conjunction with the Two-Factor plugin (https://github.com/WordPress/two-factor) and assumes it is installed and activated.

## Features
- Enforces 2FA for all users except administrators
- Redirects users without 2FA to their profile page
- Displays an admin notice on the profile page to inform users about enabling 2FA
- Excludes AJAX and REST API requests from the 2FA enforcement

## Installation
1. Upload the plugin files to the `/wp-content/plugins/ffm-wp-enforce-2fa` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Ensure that the Two-Factor plugin (https://github.com/WordPress/two-factor) is installed and activated

## Usage
Once activated, the plugin will automatically redirect users without 2FA enabled to their profile page. Users will need to set up 2FA before they can access other parts of the WordPress admin area.

## Requirements
- WordPress
- Two-Factor plugin (https://github.com/WordPress/two-factor)

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Author
Faith FM / Michael Engelbrecht

## Version
0.1

## Plugin URI
https://github.com/faithfm/ffm-wp-enforce-2fa
