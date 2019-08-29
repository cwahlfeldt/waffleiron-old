#!/bin/bash

set -e

# Set up our things
SSH_CONF="/etc/ssh"
SSH_DIRS=( "/lando/keys" "/user/.ssh" "/var/www/.ssh" )
SSH_KEYS=()
SSH_IDENTITIES=()

# Set defaults
: ${LANDO_WEBROOT_USER:='www-data'}
: ${LANDO_WEBROOT_GROUP:='www-data'}
: ${LANDO_HOST_USER:=$LANDO_WEBROOT_USER}
GROUP=$(getent group "$LANDO_HOST_GID" | cut -d: -f1)

# Make sure we have the system wide confdir
mkdir -p $SSH_CONF

# Ensure directories exists
for SSH_DIR in "${SSH_DIRS[@]}"; do
  mkdir -p "$SSH_DIR"
done

# We need to do some different magic on Windows because file sharing on windows
# does not let you chmod files that are mounted
if [ "$LANDO_HOST_OS" = "win32" ]; then
  echo "Creating a special not-mounted key directory for Windows"
  mkdir -p /lando_keys
  for SSH_DIR in "${SSH_DIRS[@]}"; do
    readarray -t SSH_KEYS < <(find "$SSH_DIR" -maxdepth 1 -not -name 'known_hosts' -type f)
    for SSH_KEY in "${SSH_KEYS[@]}"; do
      echo "Copying $SSH_KEY from $SSH_DIR to /lando_keys"
      cp -rfp "$SSH_KEY" /lando_keys
    done
  done
  chown -R $LANDO_WEBROOT_USER:$GROUP /lando_keys
  SSH_DIRS=( "/lando_keys" )
  SSH_KEYS=()
fi

# Scan the following directories for keys and filter out non-private keys
for SSH_DIR in "${SSH_DIRS[@]}"; do
  echo "Scanning $SSH_DIR for keys..."
  readarray -t SSH_CANDIDATES < <(find "$SSH_DIR" -maxdepth 1 -not -name '*.pub' -not -name 'known_hosts' -user $LANDO_WEBROOT_USER -group $GROUP -type f)
  echo "Found keys ${SSH_CANDIDATES[@]}"
  for SSH_CANDIDATE in "${SSH_CANDIDATES[@]}"; do
    echo "Ensuring permissions and ownership of $SSH_CANDIDATE..."
    chown -R $LANDO_WEBROOT_USER:$GROUP "$SSH_CANDIDATE"
    chmod 700 "$SSH_CANDIDATE"
    chmod 644 "$SSH_CANDIDATE.pub" || true
    echo "Checking whether $SSH_CANDIDATE is a private key..."
    if grep -L "PRIVATE KEY" "$SSH_CANDIDATE" &> /dev/null; then
      if command -v ssh-keygen >/dev/null 2>&1; then
        echo "Checking whether $SSH_CANDIDATE is formatted correctly..."
        if ssh-keygen -l -f "$SSH_CANDIDATE" &> /dev/null; then
          SSH_KEYS+=("$SSH_CANDIDATE")
          SSH_IDENTITIES+=("  IdentityFile $SSH_CANDIDATE")
        fi
      else
        SSH_KEYS+=($SSH_CANDIDATE)
        SSH_IDENTITIES+=("  IdentityFile $SSH_CANDIDATE")
      fi
    fi
  done
done

# Log
echo "Using the following keys: ${SSH_KEYS[@]}"

# Construct the ssh_config
OLDIFS="${IFS}"
IFS=$'\n'
cat > $SSH_CONF/ssh_config <<EOF
Host *
  User ${LANDO_HOST_USER}
  StrictHostKeyChecking no
  UserKnownHostsFile=/dev/null
  LogLevel=ERROR
${SSH_IDENTITIES[*]}
EOF
IFS="${OLDIFS}"

# Make it loose so other things can do stuff
chmod 777 "$SSH_CONF/ssh_config"
