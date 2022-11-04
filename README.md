# war-tower

### Install

Make .env file and fill it

```bash 
cp ./.env.example ./.env
cp ./api/.env ./api/.env.local
```

### First start

To build the application for the first time you must run the script

```bash
make init
```

Open your browser and visit localhost: **[api.localhost](http://api.localhost)**.

### Run application

To start the application you must run the script

```bash
make start
```

Open your browser and visit localhost: **[api.localhost](http://api.localhost)**.

### Close application

To close the application you must run the script

```bash
make down
```

## Routes

| Route            | Description     |
|------------------|-----------------|
| [/api/recipes](http://api.localhost/api/recipes) | get all recipes |
