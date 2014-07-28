#!/usr/bin/env bash

# set proxy variables
#export http_proxy=http://proxy.example.com:8080
#export https_proxy=https://proxy.example.com:8080

# bootstarp ansible for convenience on the control box
apt-get update
apt-get -y install git python-dev python-pip
pip install ansible

# fix permissions on private key file
chmod 600 /home/vagrant/.ssh/id_rsa

# add web/database hosts to known_hosts (IP is defined in Vagrantfile)
ssh-keyscan -H 192.168.51.4 >> /home/vagrant/.ssh/known_hosts
ssh-keyscan -H 192.168.52.4 >> /home/vagrant/.ssh/known_hosts
chown vagrant:vagrant /home/vagrant/.ssh/known_hosts
