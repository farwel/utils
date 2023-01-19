#! /bin/bash

set -e

function dismount()
{
  if [ -d "$mount_point" ]; then
    veracrypt --text --dismount "$mount_point"
  fi
}

trap dismount ERR INT

volume_path="/media/albert/FlashDisk/Linux"
mount_point="/mnt/Backup"

veracrypt --text --mount --mount-options "readonly" --pim "0" --keyfiles "" --protect-hidden "no" "$volume_path" "$mount_point"

nautilus "$mount_point"

printf "Restore data and press enter"

read -r answer

dismount

printf "%s\n" "Done"
