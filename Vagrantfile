# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
    config.vm.box = "ubuntu/trusty64"


    # Begin Configuring
    config.vm.define "lamp" do|lamp|

    lamp.vm.hostname = "lamp" # Setting up hostname
    lamp.vm.network "forwarded_port", guest: 80, host: 8080
    lamp.vm.provision :shell, path: "script.sh" # Provisioning with script.sh
    end

    # End Configuring
end
