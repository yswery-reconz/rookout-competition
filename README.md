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