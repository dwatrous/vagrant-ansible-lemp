vagrant-ansible-lemp
====================

In this project I use Vagrant and VirtualBox on Windows to create three Ubuntu Linux servers to explore ansible. I then use an Ansible playbook to install a Multi-server LEMP stack with an external and internal network

To run this, first prepare your system to use Vagrant based on these instructions:
http://software.danielwatrous.com/using-vagrant-to-explore-ansible/

Clone this repository and from a command line run

```
vagrant up
```

That will take several minutes but it will result in three new servers running in VirtualBox on your system. You will then want to login to the control box over SSH (watch the vagrant output to know on which port SSH is running). Then cd into the lemp directory inside the vagrant shared directory and run the ansible playbook.

```
cd /vagrant/lemp
ansible-playbook -i hosts site.yaml
```
