# SSH Keys

By default Lando will forward all the correctly formatted, owned, and permissioned `ssh` keys, including **PASSPHRASE PROTECTED** keys it finds in your `~/.ssh` and `lando.config.userConfRoot/keys` directories into each service. This means that you should be able to use your ssh keys like you were running commands natively on your machine.

Additionally Lando will set the default SSH user inside your services to whatever your host username is. You can also make use of the following ENVVARS which are injected into ever service.

```bash
LANDO_HOST_UID=501
LANDO_HOST_GID=20
LANDO_HOST_USER=me
```

Please note that `lando.config.userConfRoot/keys` is a location managed by Lando so it is recommended that you do not alter anything in this folder.

**NOTE:** Unless you've configured a custom `lando` bootstrap `lando.config.userConfRoot` should resolve to `$HOME/.lando`, this means by default your keys should be available on your host at `$HOME/.lando/keys`.

| Host Location | Managed |
| -- | -- |
| `~/.ssh` | `no` |
| `lando.config.userConfRoot/keys` | `yes` |

If you are unsure about what keys get loaded you can use the following commands for key discovery.

```bash
# Check out service logs for key loading debug output
# Obviously replace appserver with the service you are interested in
lando logs -s appserver

# Check the .ssh config for a given service
# Obviously replace appserver with the service you are interested in
lando ssh appserver -c "cat /etc/ssh/ssh_config"
```
