#!/bin/bash

if [[ $(/app/vendor/bin/concrete c5:is-installed) == "Concrete is installed" ]]; then
    $@
fi