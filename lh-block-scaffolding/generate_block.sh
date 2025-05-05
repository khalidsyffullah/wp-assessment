#!/bin/bash

# Check if a block name was provided
if [ $# -eq 0 ]; then
    echo "Please provide a block name as an argument."
    echo "Usage: ./generate_block.sh 'Your Block Name'"
    exit 1
fi

# Run the Node.js script with the provided block name
node ./lh-block-scaffolding/generateBlock.js "$$NAME"
