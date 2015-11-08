bodas
=====

Para probarlo necesitaras tener vagrant instalado en tu máquina y estar conectado a internet.

En el directorio del proyecto:

- vagrant up
- vagrant ssh
- cd /vagrant
- php app/console doctrine:database:create
- php app/console doctrine:schema:update --force
- php app/console server:start 0.0.0.0:8000

En un navegador de tu máquina, ves a 10.10.10.10:8000
