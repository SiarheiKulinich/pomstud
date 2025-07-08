# Simple PHP CRM

This repository contains a minimal CRM application written in PHP using SQLite. It allows listing, adding, editing and deleting customers.

## Requirements

* PHP 7.4 or later
* The `pdo_sqlite` extension enabled

## Usage

1. Run a PHP built-in server from the `src` directory:
   ```bash
   php -S localhost:8000 -t src
   ```
2. Open your browser at [http://localhost:8000](http://localhost:8000) to use the CRM.

The SQLite database file will be created automatically in `data/crm.sqlite` on first run.
