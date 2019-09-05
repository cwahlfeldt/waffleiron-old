# Installation

## System Requirements

Lando is designed to work on a wide range of computers. Here are some basic guidelines to ensure your Lando experience is as smooth as possible.

### Operating System

*   macOS 10.14 or newest
*   Windows 10 Pro+ or equivalent (eg Windows 10 Enterprise) [**with Hyper-V running**](https://msdn.microsoft.com/en-us/virtualization/hyperv_on_windows/quick_start/walkthrough_install)
*   Linux with kernel version 4.x or higher

### Docker Engine Requirements

Please also verify you meet the requirements needed to run our Docker engine backend. Note that the macOS and Windows Lando installer will install Docker for you if needed.

*   Linux Docker engine [requirements](https://docs.docker.com/engine/installation/linux)
*   Docker for Mac [requirements](https://docs.docker.com/docker-for-mac/#/what-to-know-before-you-install)
*   Docker for Windows [requirements](https://docs.docker.com/docker-for-windows/#/what-to-know-before-you-install)

## Hardware Requirements

::: warning Not for the faint of heart!
Note that Lando is basically a PaaS running on your computer and as such we don't recommend you use it [UNLESS YOU'VE GOT POWER!!!](https://www.youtube.com/watch?v=NowdrL6fvb4). Said another way this ain't your grandaddy's local dev environment.
:::

*   8-core processor
*   16GB+ RAM
*   100GB+ of available disk space

## Preflight Checks

1.  Verify that your system meets the [minimum system and hardware requirements](#system-requirements) to run Lando.
2.  Verify that you are connected to the internet.
3.  Verify that you have administrative access to your machine.

### Optional checks

1.  If you already have Docker installed it needs to be set to factory defaults.
2.  If you are also running VirtualBox on Windows check out [this](./../help/win-also-vb.md).

## MacOS

::: tip Do not fear the package size!
Note that our macOS installer _includes_ Docker Desktop and this accounts for it's large file size in comparison to our Linux packages.

When going through the installer you can choose to _not_ install Docker Desktop, although we recommend you use the version of Docker Desktop that we ship for compatibility and support reasons!
:::

### Install DMG via direct download

1.  Download the latest `.dmg` package from [GitHub](https://github.com/lando/lando/releases)
2.  Mount the DMG by double-clicking it
3.  Double-click on the `LandoInstaller.pkg`
4.  Go through the setup workflow
5.  Enter your username and password when prompted

### Install via [HomeBrew](https://brew.sh/)

*Please note that the version installed via Homebrew is community-maintained and may not be the latest version as provided by the `.dmg` package from [GitHub](https://github.com/lando/lando/releases).*

1. Ensure homebrew is installed and up-to-date.
2. Add the lando cask: `brew cask install lando`

## Linux

1. Install the [Docker Community Edition](https://docs.docker.com/engine/installation/) for your Linux version. Visit [https://get.docker.com](https://get.docker.com/) for the "quick & easy install" script. **(at least version 17.06.1-ce)**
2. Download the latest `.deb`, `.pacman` or `.rpm` package from [GitHub](https://github.com/lando/lando/releases)
3. Run the required package installation command for your os eg `sudo dpkg -i lando-stable.deb`, See below for defatails on each
4. Make sure you look at the caveats below and follow them appropriately


::: tip Install from source for other Linux distros
If your Linux distro does not support our `.deb`, `.pacman` or `.rpm` packages you can [install from source](#from-source)
:::

Note that you *may* also be able to just double click on the package and install via your distributions "Software Center" or equivalent.

### Debian

```bash
sudo dpkg -i lando-stable.deb
```

### Fedora

```bash
sudo dnf install lando-stable.rpm
```

### Arch

```bash
sudo pacman -U lando-stable.pacman
```

### Caveats

#### `docker-ce`

We set `docker-ce` as a hard dependency for our packages. This means if you have docker installed a different way it is likely installing the package will fail. You *may* be able to get around this if your package utility allows dependency ignorance

```bash
dpkg -i --ignore-depends=docker-ce lando-stable.deb
```

We are currently considering whether to support alternate means of installing Docker such as with [moby-engine](https://github.com/lando/lando/issues/1294)

#### Arch

Lando is also available on the AUR as [lando-git](https://aur.archlinux.org/packages/lando-git/), meaning it's built directly from source.

#### Additional Setup

Because each Linux distribution handles things differently, these considerations may or may not apply to you:

* If your distro uses a `docker` group, make sure your user is a member of it:

  ```
  sudo usermod -aG docker $USER
  ```

  You will need to log out for this change to take effect. Sometimes a reboot is necessary. See [this](https://docs.docker.com/install/linux/linux-postinstall/) for more details.

* If your distro uses SystemD, make sure that both `docker.service` and `docker.socket` daemons are running.

* If you are using Manjaro or another Arch-based distro, you may need to enable the [AUR repository](https://aur.archlinux.org/packages/) for dependencies.

## Windows

::: warning YOU MUST HAVE HYPER-V ENABLED
Make sure that [Hyper-V is enabled](https://msdn.microsoft.com/en-us/virtualization/hyperv_on_windows/quick_start/walkthrough_install) or lando will not work!
:::

::: tip Do not fear the package size!
Note that our Windows installer _includes_ Docker Desktop and this accounts for it's large file size in comparison to our Linux packages.

When going through the installer you can choose to _not_ install Docker Desktop, although we recommend you use the version of Docker Desktop that we ship for compatibility and support reasons!
:::

1.  Make sure you are using **at least** Windows 10 Professional with the latest updates installed.
2.  Download the latest Windows `.exe` installer from [GitHub](https://github.com/lando/lando/releases)
3.  Double-click on `lando.exe`
4.  Go through the setup workflow
5.  Approve various UAC prompts during install

## From source

To install from source you need to first make sure you've [installed the latest stable version of docker](https://docs.docker.com/engine/installation/) for your operating system and that it is using the factory defaults. You will also need...

* [the latest node 10](https://nodejs.org/en/download/)
* [the latest yarn](https://yarnpkg.com/lang/en/docs/install/)

On Linux you will also want to [download the latest stable docker compose binary](https://github.com/docker/compose/releases), make it executable and place it into `/usr/share/lando/bin`.

::: tip Or take things to lightspeed
If you are using macOS or a Debian flavored linux distro you can easily install Lando's dev requirements using [hyperdrive](https://github.com/lando/hyperdrive)
:::

Then do the following:

```bash
# Clone the Lando source
git clone https://github.com/lando/lando.git

# Install its dependencies
cd lando && yarn

# Optionally set up a symlink
sudo mkdir -p /usr/local/bin
sudo ln -s /absolute/path/to/above/repo/bin/lando.js /usr/local/bin/lando.dev

# Run lando from source
lando.dev
```

## Updating

Updating is fairly simple.

1.  Shutdown Lando eg `lando poweroff` and kill any running Lando processes.
2.  Turn off Docker.
3.  Follow the normal installation steps with the new version.

### Caveats

Lando has tried to maintain backwards compatibility as best as possible on it's road to a stable `3.0.0` release. However it has introduced breaking changes in a few Lando version. For these versions you will likely want to [uninstall](./uninstalling.md) and consult the relevant release notes for the breaking versions.

* [3.0.0-rc.2](https://github.com/lando/lando/releases/tag/v3.0.0-rc.2)
* [3.0.0-rc.1](https://github.com/lando/lando/releases/tag/v3.0.0-rc.1)
* [3.0.0-beta.41](https://github.com/lando/lando/releases/tag/v3.0.0-beta.41)

