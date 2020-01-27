# Events

Description

## Getting Started

Move to docker folder

```bash
$ cd docker
```

Build containers. Nginx, PHP, MySQL

```bash
$ docker> make build
```

Up containers

```bash
$ docker> make up
```

Install dependencies

```bash
$ docker> make init
```

Create tables in MySQL

```bash
$ docker> make init-db
```

See in browser http://events

## After install

Start docker containers

```bash
$ docker> make up
```

Down docker containers. Stop & remove containers

```bash
$ docker> make down
```

Stop running containers

```bash
$ docker> make stop
```