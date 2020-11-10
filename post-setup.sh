#!/usr/bin/env bash

set -e

echo 'Some custom post setup actions ...'

cd ${DAMP_WEB_APP}

mysql -V
sudo mysql -e 'show databases;'
