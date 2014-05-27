# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "hashicorp/precise64"

  # config.vm.network "forwarded_port", guest: 80, host: 8080

  config.vm.network "private_network", ip: "192.168.33.33"

  # config.vm.network "public_network"
  # config.ssh.forward_agent = true

  config.vm.synced_folder "~/Sites/mashtag", "/var/www/mashtag", :mount_options => ["dmode=777","fmode=666"]

  config.vm.provider "virtualbox" do |vb|
    vb.name = "Mashtag"
  #   # Don't boot with headless mode
  #   vb.gui = true
  #
  #   # Use VBoxManage to customize the VM. For example to change memory:
    vb.customize ["modifyvm", :id, "--memory", "512"]
  end

  config.vm.provision :shell, :path => "vagrant.sh"
end
