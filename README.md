## Running on local (must have docker)

```bash
# Go into the codebase dir
cd rookout-competition

# Copy the default config
# Dont forget to edit the variable you need
cp .env.example .env

# Bring up the docket containers
./vendor/bin/sail up

# Migrate and seed the database
./vendor/bin/sail artisan db:migrate --seed
```

You can now access the web app on `http://localhost`

## You can find assets in the following folders
```bash
resources/css/ # For all compiled CSS Files

resources/js/ # For all compiled JS Files

resources/view/ # For all view templates (Blade)
```

To recompile js/css you will need to run ` npm run dev`

## Running even generator
You will need to run the scheduler to which runs and executes all the events continually 
```bash

./vendor/bin/sail artisan schedule:run
```

To manually run the event generator you can issue the following command which will run one single cycle 
```bash
./vendor/bin/sail artisan rookout:send-debug-events
```

## Investigation App Endpoint
Since this application can deal with many investigation applications, it is all stored in DB
See the following files for the pre-populated data:
```bash
# The pre populated events 
database/migrations/2021_11_10_142134_create_debug_events_table.php

# The pre populated investigation app (Will probably need to change endpoint to suit)
database/migrations/2021_11_10_141904_create_investigation_apps_table.php
```