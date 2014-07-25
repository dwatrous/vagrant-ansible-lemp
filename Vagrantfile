# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"
PRIVATE_KEY_SOURCE      = 'C:\Users\watrous\.vagrant.d\insecure_private_key'
PRIVATE_KEY_DESTINATION = '/home/vagrant/.ssh/id_rsa'
WEB_IP                  = '192.168.51.4'
DATABASE_IP             = '192.168.52.4'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  
  # define ansible web box
  config.vm.define "web" do |web|
    web.vm.box = "ubuntu/trusty64"
    web.vm.network "public_network"
    web.vm.network "private_network", ip: WEB_IP
    web.vm.provider "virtualbox" do |v|
      v.name = "Ansible web"
      v.cpus = 1
      v.memory = 768
    end
    # copy private key so hosts can ssh using key authentication (the script below sets permissions to 600)
    web.vm.provision :file do |file|
      file.source      = PRIVATE_KEY_SOURCE
      file.destination = PRIVATE_KEY_DESTINATION
    end
    web.vm.network "forwarded_port", guest: 80, host: 8080
  end

  # define ansible database box
  config.vm.define "database" do |database|
    database.vm.box = "ubuntu/trusty64"
    database.vm.network "public_network"
    database.vm.network "private_network", ip: DATABASE_IP
    database.vm.provider "virtualbox" do |v|
      v.name = "Ansible database"
      v.cpus = 2
      v.memory = 512
    end
    # copy private key so hosts can ssh using key authentication (the script below sets permissions to 600)
    database.vm.provision :file do |file|
      file.source      = PRIVATE_KEY_SOURCE
      file.destination = PRIVATE_KEY_DESTINATION
    end
  end

  # define ansible control box (provision this last so it can add other hosts to known_hosts for ssh authentication*)
  config.vm.define "control" do |control|
    control.vm.box = "ubuntu/trusty64"
    control.vm.network "public_network"
    control.vm.network "private_network", ip: "192.168.50.4"
    control.vm.provider "virtualbox" do |v|
      v.name = "Ansible control"
      v.cpus = 1
      v.memory = 512
    end
    # copy private key so hosts can ssh using key authentication (the script below sets permissions to 600)
    control.vm.provision :file do |file|
      file.source      = PRIVATE_KEY_SOURCE
      file.destination = PRIVATE_KEY_DESTINATION
    end
    control.vm.provision :shell, path: "control.sh"
    control.vm.synced_folder ".", "/vagrant", :mount_options => ["dmode=755,fmode=644"]
  end
  
  # *consider using agent forwarding instead of manually copying the private key as I did above
  # config.ssh.forward_agent = true

end
