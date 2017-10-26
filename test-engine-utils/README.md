Goodler-Judge test engine documentation
=======================================

This document contains information for setting up Goodler-Judge test engine.

LXC setup
---------

LXC is used as a lightweight virtualization solution which allows
Goodler-Judge to safely run user submissions in a sandboxed environment.

To set up LXT on your machine Goodler-Judge provides a simple installation
script, so the only thing you need to do is run the following command:

`sudo ./lxt-install`

When LXC installs it will ask you to choose a linux distribution to use
on virtual environment.
After a couple of minutes LXT will install and you can start your virtual
environment with:

`./lxt-start`

If you whis to stop Goodler-Judge LXT container you can do that with

`./lxt-kill`

